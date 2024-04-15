<?php

namespace Database\Seeders;

use App\Models\VendorsBusinessDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsBusinessDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorBusinessDetailRecors = [
            [
                'vendor_id' => '1',
                'shop_name' => 'Vetement second choix',
                'shop_address' => 'Cotonou dantokpa',
                'shop_city' => 'cotonou',
                'shop_state' => 'litoral',
                'shop_country' => 'benin',
                'shop_pinCode' => '00229',
                'shop_mobile' => '62182206',
                'shop_website' => 'http://www.google.com',
                'address_proof' => 'ID CARD',
                'address_proof_image' => 'idcard.png',
                'business_licence_number' => '455JJE887G99',
                'business_registration_number' => '455JJE887G99',
                'pan_number' => '455JJE887G99',
            ]
        ];

        VendorsBusinessDetail::insert($vendorBusinessDetailRecors);

    }
}
