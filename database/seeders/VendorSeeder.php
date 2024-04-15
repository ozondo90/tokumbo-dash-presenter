<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorRecords = [
            [
                'name' => 'John Akossa',
                'address' => 'C452 dandji',
                'city' => 'Cotonou',
                'state' => 'Litoral',
                'country' => 'Benin',
                'pin_code' => '00229',
                'mobile' => '62182207' ,
                'email' => 'vendor1@gmail.com',
                'status' => 0,
            ]
        ];

        Vendor::insert($vendorRecords);
    }
}
