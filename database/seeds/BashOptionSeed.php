<?php

use Illuminate\Database\Seeder;
use App\BashOption;
class BashOptionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrUser =[
           
            [
                'name'          => 'general_expired_date',
                'value'         => 2,
                'default_value' => 5,
                'description'   => 'Untuk pengaturan tanggal expired date'
            ],    
            [
                'name'          => 'name company',
                'value'         => 'PT Garuda',
                'default_value' => 'Internet Broadband',
                'description'   => 'Untuk pengaturan nama perusahaan'
            ]
          ];
  
          foreach($arrUser as $data){
              BashOption::create($data);
          }
    }
}
