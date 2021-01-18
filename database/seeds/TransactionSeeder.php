<?php

use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();                      

        // DB::table('transactions')->insert([
        //     'users_has_packages_id'      =>  1,
        //     'notes'     => $faker->sentence($nbWords = 6, $variableNbWords = true),
        //     'expired_date' => '2020-06-05 00:00:00',
        //     'status' => '1',
        //     'price' => '150000',
        //     'paid' => 0,
        //     'fee' => 0,
        //     'transaction_has_modified_id' => 1
                
        //     ]);

        // $faker = Faker\Factory::create();                      
        for($i=0 ; $i<=1000; $i++){   

  
            DB::table('transactions')->insert([
            'users_has_packages_id'      =>  $i,
            'notes'     => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'expired_date' => $faker->dateTime(),
            'payment_date' => $faker->dateTime(),
            'status' => '1',
            'price' => '150000',
            'paid' => 0,
            'fee' => 0,
            'transaction_has_modified_id' => 0
                
            ]);
            }
    }
}

