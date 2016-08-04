<?php

use Illuminate\Database\Seeder;
use App\Settings;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();

        $option = new Settings();
        $option->fill([
            'name' => 'question_price',
            'value' => '20'
        ]);
        $option->save();

        $option = new Settings();
        $option->fill([
            'name' => 'gross_consultant',
            'value' => '10'
        ]);
        $option->save();

        $option = new Settings();
        $option->fill([
            'name' => 'email',
            'value' => env('EMAIL')
        ]);
        $option->save();
    }
}
