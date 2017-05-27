<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'paypal_mode'         => 'sandbox',
            'client_id'           => 'AavFGcKNS6oMwIKmeSDv5FQaYyaRMqDVrKAF3f9DFBnCePc09Pp21sBkPlzwfS-YsspLR4eHe3YL4x81',
            'secret_id'           => 'EAbobyjnoqz3mBhDlAPZ9JrZ3To_Qw0sSt082OnAPgomjregWTwvmRzvxksrAsu6gaz05E3F2EOGT5r4',
            'num_of_questions'    => 3,
            'time_for_questions'  => 5
        ]);
    }
}
