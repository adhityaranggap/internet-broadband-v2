<?php

use Illuminate\Database\Seeder;

class TransactionHasModifiedSeeder extends Seeder
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

  
            DB::table('transaction_has_modified')->insert([
            'transaction_id'      =>  $i,
            'modified_by'  =>  $faker->numberBetween($min = 1, $max = 2) 
                
            ]);
            }
        }
    }
    