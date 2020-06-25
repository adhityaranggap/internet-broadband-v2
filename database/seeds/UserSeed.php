<?php

use Illuminate\Database\Seeder;
use App\User, App\Role;
class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //faker
        // $faker = Faker\Factory::create();                      
        // for($i=0 ; $i<=1000; $i++){   
        //     $username = $faker->unique()->username;

        //     User::create([
        //         'name'      =>  $faker->name,
        //         'username'  =>  $faker->unique()->username,
        //         'password'  =>  bcrypt('12345678'),
        //         'email'     =>  $faker->unique()->email,
        //         'contact_person'    =>  $faker->unique()->e164PhoneNumber,
        //         'address'   =>  $faker->address,
        //         'role_id'   =>  Role::ROLE_CUSTOMER,   
        //     ]);

        // }    

        $arrUser =[
          [
            'name'  =>  'Rangga Cust',
            'username'  =>  'rangga',
            'password'  =>  bcrypt('12345678'),
            'email'     =>  'rangga@gmail.com',
            'contact_person'    =>  '087787878',
            'address'   =>  'Vilmut',
            'role_id'   =>  1,    
          ]        
        ];

        foreach($arrUser as $user){
            User::create($user);
        }

        
    }
}
