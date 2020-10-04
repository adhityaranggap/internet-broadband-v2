<?php

use Illuminate\Database\Seeder;
use App\Package;
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
            'name'  =>  '100K 2M',
            'upload'  =>  '2',
            'download'  =>  '2',
            'upload_unit'  =>  'M',
            'download_unit'  =>  'M',
            'ip_gateway'  =>  '10.100.100.1',
            'ip_pool_start'  =>  '10.100.100.2',
            'ip_pool_end'  =>  '10.100.100.254',
            'price'  =>  '100000'
          ],
          [
            'name'  =>  '150K 4M',
            'upload'  =>  '4',
            'download'  =>  '4',
            'upload_unit'  =>  'M',
            'download_unit'  =>  'M',
            'ip_gateway'  =>  '10.150.150.1',
            'ip_pool_start'  =>  '10.150.150.2',
            'ip_pool_end'  =>  '10.150.150.254',
            'price'  =>  '150000'
          ],
          [
            'name'  =>  '200K 6M',
            'upload'  =>  '3',
            'download'  =>  '6',
            'upload_unit'  =>  'M',
            'download_unit'  =>  'M',
            'ip_gateway'  =>  '10.200.200.1',
            'ip_pool_start'  =>  '10.200.200.2',
            'ip_pool_end'  =>  '10.200.200.254',
            'price'  =>  '200000'
          ],
          [
            'name'  =>  '250K 8M',
            'upload'  =>  '4',
            'download'  =>  '8',
            'upload_unit'  =>  'M',
            'download_unit'  =>  'M',
            'ip_gateway'  =>  '10.250.250.1',
            'ip_pool_start'  =>  '10.200.200.2',
            'ip_pool_end'  =>  '10.200.200.254',            
            'price'  =>  '250000'
          ],
          [
            'name'  =>  '300K 10M',
            'upload'  =>  '5',
            'download'  =>  '10',
            'upload_unit'  =>  'M',
            'download_unit'  =>  'M',
            'ip_gateway'  =>  '10.300.300.1',
            'ip_pool_start'  =>  '10.200.200.2',
            'ip_pool_end'  =>  '10.200.200.254',            
            'price'  =>  '300000'
          ]
        ];

        foreach($arrUser as $data){
            Package::create($data);
        }
    }
}
