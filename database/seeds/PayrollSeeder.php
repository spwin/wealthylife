<?php

use Illuminate\Database\Seeder;
use App\Payroll;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payroll')->delete();

        $payroll = new Payroll();
        $payroll->fill([
            'starts_at' => date('Y-m-d H:i:s', time()),
            'ends_at' => '',
            'paid_at' => '',
            'current' => 1
        ]);
        $payroll->save();
    }
}
