@extends('admin/frame')
@section('content-header')
    <h1>
        User profile
        <small>USER</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ action('AdminController@index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Users</li>
        <li><a href="{{ action('AdminController@listUsers') }}">Users</a></li>
        <li class="active">Profile</li>
    </ol>
@stop
@section('content')
    <div class="row">
        @if (Session::has('flash_notification.message'))
            <div class="col-xs-12">
                <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('flash_notification.message') }}
                </div>
            </div>
        @endif
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ $user->userData()->first()->image()->first() ? URL::to('/').$user->userData()->first()->image()->first()->path.$user->userData()->first()->image()->first()->filename : URL::to('/').'/images/avatars/no_image.png'}}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{ $user->userData()->first()->first_name }} {{ $user->userData()->first()->last_name }}</h3>

                    <p class="text-muted text-center">{{ $user->email }}</p>

                    {!! Form::open([
                    'method' => 'POST',
                    'target' => '_blank',
                    'action' => ['AdminController@forceLoginUser']
                    ]) !!}
                    {!! Form::hidden('id', $user->id) !!}
                    <p class="text-center">
                        <button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Login as this user</button>
                    </p>
                    {!! Form::close() !!}

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>ID</b> <span class="pull-right">#{{ $user->id }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Account</b> <span class="badge bg-{{ $user->disable == 1 ? 'red' : 'green' }} pull-right">{{ $user->disable == 1 ? 'suspended' : 'active' }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Balance</b> <span class="pull-right">£ {{ $user->points }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Created</b> <span class="pull-right">{{ date('d/m/Y', strtotime($user->created_at)) }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Confirmed</b> <span class="badge bg-{{ $econf['color'] }} pull-right">{{ $econf['status'] }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Status</b> <span class="badge bg-{{ $user->status == 1 ? 'green' : 'red' }} pull-right">{{ $user->status == 1 ? 'active' : 'dormant' }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Asked</b> <span class="badge bg-light-blue pull-right">{{ $user->questions() && $user->questions()->first() ? $user->questions()->where('status', '>', 0)->count() : 0 }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Articles</b> <span class="badge bg-light-blue pull-right">{{ $user->articles() && $user->articles()->first() ? $user->articles()->where('status', '>', 0)->count() : 0 }}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Referrals</b> <span class="badge bg-light-blue pull-right">{{ $user->referrals ? count($user->referrals) : 0 }}</span>
                        </li>
                    </ul>
                    <div class="text-center">
                        {!! Form::open([
                        'method' => 'DELETE',
                        'action' => ['AdminController@destroyUser', $user->id],
                        'onclick'=> 'return confirm("Are you sure?")',
                        'class' => 'push-left inline-block'
                        ]) !!}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete profile</button>
                        {!! Form::close() !!}

                        {!! Form::open([
                        'method' => 'POST',
                        'action' => ['AdminController@disableUser', $user->id, $user->disable ? 0 : 1],
                        'class' => 'push-right inline-block'
                        ]) !!}
                        @if($user->disable)
                            <button type="submit" class="btn btn-success">Activate</button>
                        @else
                            <button type="submit" class="btn btn-warning"><i class="fa fa-ban"></i> Suspend</button>
                        @endif
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li {{ $tab == '1' ? 'class=active' : '' }}><a href="#general" data-toggle="tab">General</a></li>
                    <li {{ $tab == '2' ? 'class=active' : '' }}><a href="#password" data-toggle="tab">Login details</a></li>
                    <li {{ $tab == '3' ? 'class=active' : '' }}><a href="#social" data-toggle="tab">Social</a></li>
                    <li {{ $tab == '4' ? 'class=active' : '' }}><a href="#notifications" data-toggle="tab">Notifications</a></li>
                    <li {{ $tab == '5' ? 'class=active' : '' }}><a href="#balance" data-toggle="tab">Balance</a></li>
                    <li {{ $tab == '6' ? 'class=active' : '' }}><a href="#referrals" data-toggle="tab">Referrals</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane {{ $tab == '1' ? 'active' : '' }}" id="general">
                        {!! Form::model($user_data, [
                            'role' => 'form',
                            'url' => action('AdminController@updateUserData', ['id' => $user->id]),
                            'files' => true,
                            'method' => 'POST'
                        ]) !!}
                            <div class="form-group {{ $errors->first('first_name', 'has-error') }}"><span class="text-danger">*</span>
                                {!! Form::label('first_name', 'First Name') !!}
                                {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First name']) !!}
                                <span class="help-block">{{ $errors->first('first_name') }}</span>
                            </div>
                            <div class="form-group {{ $errors->first('last_name', 'has-error') }}"><span class="text-danger">*</span>
                                {!! Form::label('last_name', 'Last name') !!}
                                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last name']) !!}
                                <span class="help-block">{{ $errors->first('last_name') }}</span>
                            </div>
                            <div class="form-group">
                                {!! Form::label('gender', 'Gender') !!}
                                <div class="input-group">
                                    <label class="cursor-pointer mr-15px">
                                        <input type="radio" name="gender" value="male" class="minimal" {{ $user_data->gender == 'male' ? 'checked' : '' }}>
                                        Male
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="gender" value="female" class="minimal" {{ $user_data->gender == 'female' ? 'checked' : '' }}>
                                        Female
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('weight', 'Weight') !!}
                                <div class="input-group">
                                    {!! Form::text('weight', null, ['class' => 'form-control', 'placeholder' => 'Weight']) !!}
                                    <span class="input-group-addon">kg</span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('height', 'Height') !!}
                                <div class="input-group">
                                    {!! Form::text('height', null, ['class' => 'form-control', 'placeholder' => 'Height']) !!}
                                    <span class="input-group-addon">cm</span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('birth_date', 'Date of birth') !!}
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    {!! Form::text('birth_date', $user_data->birth_date && $user_data->birth_date != '0000-00-00' ? date('d/m/Y', strtotime($user_data->birth_date)) : '00/00/0000', ['class' => 'form-control pull-right', 'id' => 'datepicker']) !!}
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group {{ $errors->first('image', 'has-error') }}">
                                {!! Form::label('image', 'Change Photo') !!}
                                {!! Form::file('image') !!}
                                <span class="help-block">{{ $errors->first('image') }}</span>
                                <p class="help-block text-black">Max file size 5Mb</p>
                            </div>
                            <div class="form-group">
                                {!! Form::label('about', 'About') !!}
                                {!! Form::textarea('about', null, ['class' => 'form-control', 'placeholder' => 'Enter ...', 'rows' => '3']) !!}
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane {{ $tab == '2' ? 'active' : '' }}" id="password">
                        {!! Form::model($user, [
                            'role' => 'form',
                            'url' => action('AdminController@updateUserLogin', ['id' => $user->id, 'type' => 'email']),
                            'method' => 'POST'
                        ]) !!}
                            <div class="form-group {{ $errors->first('email', 'has-error') }}"><span class="text-danger">*</span>
                                {!! Form::label('email', 'E-Mail Address') !!}
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email']) !!}
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Change email</button>
                        </div>
                        {!! Form::close() !!}
                        {!! Form::model($user, [
                            'role' => 'form',
                            'url' => action('AdminController@updateUserLogin', ['id' => $user->id, 'type' => 'pass']),
                            'method' => 'POST'
                        ]) !!}
                            <div class="form-group {{ $errors->first('password', 'has-error') }}"><span class="text-danger">*</span>
                                {!! Form::label('password', 'New Password') !!}
                                {!! Form::input('password', 'password', '', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="form-group {{ $errors->first('password_confirmation', 'has-error') }}"><span class="text-danger">*</span>
                                {!! Form::label('password_confirmation', 'Repeat New Password') !!}
                                {!! Form::input('password', 'password_confirmation', '', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Change password</button>
                            </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="tab-pane {{ $tab == '3' ? 'active' : '' }}" id="social">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Provider</th>
                                <th>User ID</th>
                                <th>Social profile</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-facebook"></i> Facebook</td>
                                <td>{{ $user->social()->first() && $user->social()->where(['provider' => 'facebook'])->count() > 0  ? $user->social()->where(['provider' => 'facebook'])->first()->social_id : 'none'}}</td>
                                <td>
                                    @if($user->social()->first() && $user->social()->where(['provider' => 'facebook'])->count() > 0)
                                        <a href="https://www.facebook.com/{{ $user->social()->where(['provider' => 'facebook'])->first()->social_id }}" target="_blank" class="btn btn-success">See profile</a>
                                    @else
                                        <a href="#" class="btn btn-success disabled">See profile</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-google"></i> Google</td>
                                <td>{{ $user->social()->first() && $user->social()->where(['provider' => 'google'])->count() > 0  ? $user->social()->where(['provider' => 'google'])->first()->social_id : 'none'}}</td>
                                <td>
                                    @if($user->social()->first() && $user->social()->where(['provider' => 'google'])->count() > 0)
                                        <a href="https://plus.google.com/{{ $user->social()->where(['provider' => 'google'])->first()->social_id }}" target="_blank" class="btn btn-success">See profile</a>
                                    @else
                                        <a href="#" class="btn btn-success disabled">See profile</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-twitter"></i> Twitter</td>
                                <td>{{ $user->social()->first() && $user->social()->where(['provider' => 'twitter'])->count() > 0  ? $user->social()->where(['provider' => 'twitter'])->first()->social_id : 'none'}}</td>
                                <td>
                                    @if($user->social()->first() && $user->social()->where(['provider' => 'twitter'])->count() > 0)
                                        <a href="https://twitter.com/intent/user?user_id={{ $user->social()->where(['provider' => 'twitter'])->first()->social_id }}" target="_blank" class="btn btn-success">See profile</a>
                                    @else
                                        <a href="#" class="btn btn-success disabled">See profile</a>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane {{ $tab == '4' ? 'active' : '' }}" id="notifications">
                        <div class="box-header">
                            <i class="fa fa-envelope"></i>
                            <h3 class="box-title">Send Notification</h3>
                        </div>
                        <div class="box-body">
                            {!! Form::open([
                            'method' => 'POST',
                            'action' => ['AdminController@sendNotification', $user->id]
                            ]) !!}
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" name="type" placeholder="Type" value="admin">
                                </div>
                                <div class="form-group">
                                    <label for="importance">Importance</label>
                                    <input type="number" class="form-control" name="importance" placeholder="Importance" value="1">
                                </div>
                                <div class="form-group">
                                    {!! Form::checkbox('email', null, null, ['id' => 'email-notification']) !!}
                                    <label for="email-notification">Send email</label>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Notification</label>
                                    <input type="text" class="form-control" name="subject" placeholder="Subject">
                                </div>
                                <div>
                                    <textarea name="body" class="textarea" placeholder="Notification" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                                <div>
                                <button type="submit" class="btn btn-default" id="sendEmail">Send
                                    <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="box-footer clearfix">
                            <table id="pending-questions" class="table table-bordered table-hover scripted-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Subject</th>
                                    <th>Body</th>
                                    <th class="w60px">Date</th>
                                    <th class="w100px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($user->notifications() && $user->notifications()->count() > 0)
                                    @foreach($user->notifications()->get() as $notification)
                                        <tr>
                                            <td class="w40px">#{{ $notification->id }}</td>
                                            <td class="w100px">{{ $notification->type }}</td>
                                            <td>{{ implode(' ', array_slice(explode(' ', $notification->subject), 0, 5)) }}</td>
                                            <td>{{ implode(' ', array_slice(explode(' ', $notification->body), 0, 5)).'...' }}</td>
                                            <td>{{ date('d M, Y H:i', strtotime($notification->created_at)) }}</td>
                                            <td class="w100px"><a href="{{ action('AdminController@showNotification', $notification->id) }}" class="btn btn-primary">Show details</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane {{ $tab == '5' ? 'active' : '' }}" id="balance">
                        {!! Form::open([
                            'role' => 'form',
                            'url' => action('AdminController@addProfileBalance', ['id' => $user->id]),
                            'files' => true,
                            'method' => 'POST'
                        ]) !!}
                            <div class="form-group {{ $errors->first('credits', 'has-error') }}"><span class="text-danger">*</span>
                                {!! Form::label('credits', 'Credits amount') !!}
                                {!! Form::input('number','credits', old('credits'), ['class' => 'form-control']) !!}
                                <span class="help-block">{{ $errors->first('credits') }}</span>
                            </div>
                            <button type="submit" class="btn btn-primary">Add to balance</button>
                        {!! Form::close() !!}
                        <table class="table table-bordered table-hover mt-15px">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Before</th>
                                <th>After</th>
                                <th>Credits</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($balance = $user->balance)
                                @foreach($balance as $bal)
                                    <tr>
                                        <td>#{{ $bal->id }}</td>
                                        <td>{{ date('d M, Y H:i', strtotime($bal->created_at)) }}</td>
                                        <td>{{ $bal->before }}</td>
                                        <td>{{ $bal->after }}</td>
                                        <td>{{ $bal->credits }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane {{ $tab == '6' ? 'active' : '' }}" id="referrals">
                        <div class="box-header">
                            @if($user->referral)
                                <h3 class="box-title">Registration referred to: <a href="{{ action('AdminController@detailsUser', ['id' => $user->referral->id]) }}">{{ $user->referral->email }}</a></h3>
                            @else
                                <h3 class="box-title">Registered without refer</h3>
                            @endif
                        </div>
                        <table class="table table-bordered table-hover mt-15px">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Registered</th>
                                <th>Confirmed</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($user->referrals as $refer)
                                    <tr>
                                        <td>#{{ $refer->id }}</td>
                                        <td><a href="{{ action('AdminController@detailsUser', ['id' => $refer->id]) }}">{{ $refer->email }}</a></td>
                                        <td>{{ date('d M, Y H:i', strtotime($refer->created_at)) }}</td>
                                        <td>{{ $refer->referral_rewarded ? 'YES' : 'NO' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>

    <div id="questions-section" class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Questions</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#questions_1" data-toggle="tab" aria-expanded="true">
                                    Pending
                                    @if($user->questions() && $user->questions()->where(['status' => 1])->count() > 0)
                                        (<span class="numbers">{{ $user->questions()->where(['status' => 1])->count() }}</span>)
                                    @endif
                                </a>
                            </li>
                            <li class="">
                                <a href="#questions_2" data-toggle="tab" aria-expanded="false">
                                    Answered
                                    @if($user->questions() && $user->questions()->where(['status' => 2])->count() > 0)
                                        (<span class="numbers">{{ $user->questions()->where(['status' => 2])->count() }}</span>)
                                    @endif
                                </a>
                            </li>
                            <li class="">
                                <a href="#questions_3" data-toggle="tab" aria-expanded="false">
                                    Drafts
                                    @if($user->questions() && $user->questions()->where(['status' => 0])->count() > 0)
                                        (<span class="numbers">{{ $user->questions()->where(['status' => 0])->count() }}</span>)
                                    @endif
                                </a>
                            </li>
                            <li class="">
                                <a href="#questions_4" data-toggle="tab" aria-expanded="false">
                                    Rejected
                                    @if($user->questions() && $user->questions()->where(['status' => 3])->count() > 0)
                                        (<span class="numbers">{{ $user->questions()->where(['status' => 3])->count() }}</span>)
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="questions_1">
                                <table id="pending-questions" class="table table-bordered table-hover scripted-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Question</th>
                                            <th class="w60px">Date</th>
                                            <th class="w100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($user->questions() && $user->questions()->where(['status' => 1])->count() > 0)
                                        @foreach($user->questions()->where(['status' => 1])->get() as $question)
                                            <tr>
                                                <td class="w40px">#{{ $question->id }}</td>
                                                <td class="w300px">
                                                    @if(count($question->images) > 0)
                                                        @foreach($question->images as $image)
                                                            <img class="admin-user-questions" src="{{ url()->to('/').'/photo/100x100/'.$image->filename }}">
                                                        @endforeach
                                                    @else
                                                        <img class="admin-user-questions" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                    @endif
                                                </td>
                                                <td>{{ $question->question }}</td>
                                                <td>{{ date('d M, Y', strtotime($question->asked_at)) }}</td>
                                                <td class="w100px"><a href="#" class="btn btn-primary">Answer</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="questions_2">
                                <table id="answered-questions" class="table table-bordered table-hover scripted-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Question</th>
                                        <th class="w60px">Date</th>
                                        <th class="w100px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($user->questions() && $user->questions()->where(['status' => 2])->count() > 0)
                                        @foreach($user->questions()->where(['status' => 2])->get() as $question)
                                            <tr>
                                                <td class="w40px">#{{ $question->id }}</td>
                                                <td class="w300px">
                                                    @if(count($question->images) > 0)
                                                        @foreach($question->images as $image)
                                                            <img class="admin-user-questions" src="{{ url()->to('/').'/photo/100x100/'.$image->filename }}">
                                                        @endforeach
                                                    @else
                                                        <img class="admin-user-questions" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                    @endif
                                                </td>
                                                <td>{{ $question->question }}</td>
                                                <td>{{ date('d M, Y', strtotime($question->asked_at)) }}</td>
                                                <td class="w100px"><a href="#" class="btn btn-success">View answer</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="questions_3">
                                <table id="questions-drafts" class="table table-bordered table-hover scripted-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Question</th>
                                        <th class="w60px">Date</th>
                                        <th class="w100px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($user->questions() && $user->questions()->where(['status' => 0])->count() > 0)
                                        @foreach($user->questions()->where(['status' => 0])->get() as $question)
                                            <tr>
                                                <td class="w40px">#{{ $question->id }}</td>
                                                <td class="w300px">
                                                    @if(count($question->images) > 0)
                                                        @foreach($question->images as $image)
                                                            <img class="admin-user-questions" src="{{ url()->to('/').'/photo/100x100/'.$image->filename }}">
                                                        @endforeach
                                                    @else
                                                        <img class="admin-user-questions" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                    @endif
                                                </td>
                                                <td>{{ $question->question }}</td>
                                                <td>{{ date('d M, Y', strtotime($question->created_at)) }}</td>
                                                <td class="w100px"><a href="{{ action('AdminController@markPaidQuestion', ['id' => $question->id, 'user_id' => $user->id]) }}" class="btn btn-warning">Mark as paid</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="questions_4">
                                <table id="questions-rejected" class="table table-bordered table-hover scripted-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Question</th>
                                        <th class="w60px">Date</th>
                                        <th class="w100px">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($user->questions() && $user->questions()->where(['status' => 3])->count() > 0)
                                        @foreach($user->questions()->where(['status' => 3])->get() as $question)
                                            <tr>
                                                <td class="w40px">#{{ $question->id }}</td>
                                                <td class="w300px">
                                                    @if(count($question->images) > 0)
                                                        @foreach($question->images as $image)
                                                            <img class="admin-user-questions" src="{{ url()->to('/').'/photo/100x100/'.$image->filename }}">
                                                        @endforeach
                                                    @else
                                                        <img class="admin-user-questions" src="{{ url()->to('/').'/images/avatars/no_image.png' }}">
                                                    @endif
                                                </td>
                                                <td>{{ $question->question }}</td>
                                                <td>{{ date('d M, Y', strtotime($question->asked_at)) }}</td>
                                                <td class="w100px"><a href="{{ action('AdminController@showRejection', ['id' => $question->id]) }}" class="btn btn-warning">Check reason</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@stop
@push('scripts')
<script src="{{ URL::to('/') }}/js/admin/jquery.dataTables.min.js"></script>
<script src="{{ URL::to('/') }}/js/admin/dataTables.bootstrap.min.js"></script>
<script>
    $(function() {
        //Date picker
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        });

        $('input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        $('.scripted-table').each(function(){
            $(this).DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    });
</script>
@endpush