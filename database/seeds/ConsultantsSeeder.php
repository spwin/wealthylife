<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserData;
use App\Images;

class ConsultantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->createUser('consultant', 'caragh@stylesensei.co.uk', 'simpleAs-583', 'caragh.jpg', 'Caragh', 'Logan', 'female');
        $this->createUser('consultant', 'jamilah@stylesensei.co.uk', 'simpleAs-842', 'jamilah.jpg', 'Jamilah', 'Estrianna Toni', 'female');
        $this->createUser('consultant', 'esohe@stylesensei.co.uk', 'simpleAs-224', 'esohe.jpg', 'Esohe', 'Ebohon', 'female');

    }

    private function createUser($type, $email, $password, $photo, $name, $surname, $gender){
        $user = new User();
        $user->fill([
            'type' => $type,
            'email' => $email,
            'password' => bcrypt($password),
            'super' => 0,
            'status' => 1,
            'email_confirmed' => 1,
            'timetable' => '{"mon":[{"from":"10:00","to":"12:00"}],"tue":[],"wed":[],"thu":[],"fri":[{"from":"10:00","to":"12:00"}],"sat":[],"sun":[]}'
        ]);
        $user->save();

        $image = new Images();
        $image->fill([
            'filename' => $photo,
            'path' => '/images/avatars/'
        ]);
        $image->save();

        $user_data = new UserData();
        $user_data->fill([
            'user_id' => $user->id,
            'image_id' => $image->id,
            'first_name' => $name,
            'last_name' => $surname,
            'gender' => $gender
        ]);
        $user_data->save();
    }
}
