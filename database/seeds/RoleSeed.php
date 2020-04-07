<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrRole =[
            [
              'role'  =>  'Customer',             
            ]        
          ];
  
          foreach($arrRole as $role){
              Role::create($role);
          }
    }
}
