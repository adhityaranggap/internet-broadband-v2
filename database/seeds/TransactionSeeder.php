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
        for($i=0 ; $i<=100; $i++){   

  
            DB::table('transactions')->insert([
            'user_has_package_id'      =>  $i,
            'notes'     => $faker->sentence($nbWords = 6, $variableNbWords = true),
            'transaction_has_modified_id' => $i,
            'expired_date' => '2020-06-05 00:00:00',
            'status' => '1',
            'price' => '150000',
            'paid' => 0,
            'fee' => 0
                
            ]);
            }
    }
}

