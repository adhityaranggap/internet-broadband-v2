<?php

use Illuminate\Database\Seeder;
use App\UserHasPackage;
class UserHasPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //faker
        $faker = Faker\Factory::create();                      
        for($i=0 ; $i<=100; $i++){   
            // $user_id = $i;

            UserHasPackage::create([
                'user_id'      =>  $i,
                'package_id'  =>  $faker->numberBetween(1,2,3),
                'verification'  =>  'First Month',
                'status'     =>  'Active',
                'notes'    =>  '.',
            ]);

        }    
    }
}
