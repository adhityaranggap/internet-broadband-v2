<?php

use Illuminate\Database\Seeder;

class Access extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $akun = [
            [
                'username'=> 'me@adhityarp.com',
                'password'=>'12345678',
                'customer'
            ],
        ];
    }
}
