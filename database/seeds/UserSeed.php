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
        // $arrUser =[
        //   [
        //     'name'  =>  'Aditya',
        //     'username'  =>  'adit',
        //     'password'  =>  bcrypt('12345678'),
        //     'email'     =>  'aditya@gmail.com',
        //     'contact_person'    =>  '087787878',
        //     'address'   =>  'Vilmut',
        //     'role_id'   =>  1,    
        //   ]        
        // ];

        // foreach($arrUser as $user){
        //     User::create($user);
        // }

        //faker
        $faker = Faker\Factory::create();                      
        for($i=0 ; $i<=100; $i++){   
            $username = $faker->unique()->username;

            User::create([
                'name'      =>  $faker->name,
                'username'  =>  $faker->unique()->username,
                'password'  =>  bcrypt('12345678'),
                'email'     =>  $faker->unique()->email,
                'contact_person'    =>  $faker->unique()->e164PhoneNumber,
                'address'   =>  $faker->address,
                'role_id'   =>  Role::ROLE_CUSTOMER,   
            ]);

        }    
    }
}
