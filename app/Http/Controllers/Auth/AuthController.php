<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    protected $guard = 'user';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => ['getLogout','getUserLogout', 'getAdminLogout', 'getConsultantLogout', 'postLogin']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function redirectPath(){
        $url = Auth::guard($this->getGuard())->user()->type;
        if($url == 'user'){
            $url = $this->redirectTo;
        };
        return '/'.$url;
    }

    public function getConsultantLogout(){
        $this->getLogout('consultant');
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    public function getAdminLogout(){
        $this->getLogout('admin');
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }

    public function getUserLogout(){
        $this->getLogout('user');
        return redirect('/');
    }

    public function getLogout($type = 'user')
    {
        $this->guard = $this->redirectAfterLogout = $type;
        Auth::guard($this->getGuard())->logout();
    }

    public function postLogin(\Illuminate\Http\Request $request, $type = 'user')
    {
        if (method_exists($this, 'beforeLogin')) {
            $this->beforeLogin();
        }
        return $this->login($request, $type);
    }

    public function login(\Illuminate\Http\Request $request, $type)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request, $type);
        $this->guard = $type;

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request, $type);
    }

    protected function handleUserWasAuthenticated(\Illuminate\Http\Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        return redirect()->intended($this->redirectPath());
    }

    protected function getCredentials(\Illuminate\Http\Request $request, $type)
    {
        $credentials = $request->only($this->loginUsername(), 'password');
        $credentials = array_add($credentials, 'type', $type);
        $credentials = array_add($credentials, 'email_confirmed', 1);
        return $credentials;
    }

    protected function sendFailedLoginResponse(\Illuminate\Http\Request $request, $type = 'user')
    {
        $errors = [$this->loginUsername() => $this->getFailedLoginMessage($request, $type)];
        if($type == 'user'){
            $request->session()->flash('modal', 'login');
        }
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors($errors, $type == 'user' ? 'login' : 'default');
    }

    protected function getFailedLoginMessage($request, $type)
    {
        $user = User::where(['email' => $request->email])->first();
        $message = Lang::get('auth.failed');
        if($user && $user->email_confirmed == 0 && $user->type == $type){
            if(Hash::check($request->password, $user->password)){
                $message = Lang::get('auth.email-confirmation');
            } elseif($providers = $user->social()->get()) {
                $providers_list = array();
                foreach($providers as $provider){
                    $providers_list[] = ucfirst($provider->provider);
                }
                $message = Lang::get('auth.only-providers');
                $message .= implode(', ', $providers_list);
                $message .= Lang::get('auth.use-providers-or-register');
            }
        }
        return $message;
    }
}
