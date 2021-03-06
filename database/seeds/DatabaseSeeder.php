<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(ConsultantsSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(PayrollSeeder::class);
        $this->call(PriceSchemesSeeder::class);
        $this->call(PhrasesSeeder::class);
    }
}
