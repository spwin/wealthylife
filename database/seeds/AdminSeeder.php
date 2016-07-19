<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserData;
use App\Images;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user = new User();
        $user->fill([
            'type' => 'admin',
            'email' => 'spwinwk@gmail.com',
            'password' => bcrypt('spwin0411'),
            'super' => 1,
            'status' => 1,
            'email_confirmed' => 1
        ]);
        $user->save();

        $image = new Images();
        $image->fill([
            'filename' => 'user2-160x160.jpg',
            'path' => '/images/avatars/'
        ]);
        $image->save();

        $user_data = new UserData();
        $user_data->fill([
            'user_id' => $user->id,
            'image_id' => $image->id,
            'first_name' => 'Stanislav',
            'last_name' => 'Markevic',
            'gender' => 'male',
            'weight' => 70,
            'height' => 190,
            'about' => 'Just admin..'
        ]);
        $user_data->save();
    }
}
