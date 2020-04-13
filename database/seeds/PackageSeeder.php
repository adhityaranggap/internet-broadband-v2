<?php

use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
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
            'name'  =>  '150K 4M',
            'speed'  =>  '4Mbps',
            'price'  =>  '150000'
          ],
          [
            'name'  =>  '200K 6M',
            'speed'  =>  '6Mbps',
            'price'  =>  '200000'
          ],
          [
            'name'  =>  '300K 10M',
            'speed'  =>  '10Mbps',
            'price'  =>  '300000'
          ]

        ];

        foreach($arrUser as $data){
            Package::create($data);
        }
    }
}
