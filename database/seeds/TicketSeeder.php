<?php

use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
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

  
            DB::table('tickets')->insert([
            'users_has_packages_id'      =>  $i,
            'subject'                    => $faker->realText($maxNbChars =  10, $indexSize = 2),
            'description'                => $faker->realText($maxNbChars = 200, $indexSize = 2),
            'departement'                => $faker->randomElement(['Support', 'Billing','Sales']),
            'attachment'                 => '-',
            'status'                     => $faker->numberBetween($min = 0, $max = 3), // 0123
            'priority'                   => $faker->numberBetween($min = 0, $max = 2),
            'ticket_number'              => $faker->unique()->numberBetween($min = 1000, $max = 9000), // 8567
            'created_at'                 => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
            ]);
            }
    }
}

