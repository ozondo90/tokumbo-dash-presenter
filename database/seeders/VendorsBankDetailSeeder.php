<?php

namespace Database\Seeders;

use App\Models\VendorsBankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsBankDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorsBankDetailRecords = [
            [
              'vendor_id' => '1',
              'account_holder_name' => 'John Akossa',
              'account_number' => '4562798521265',
              'bank_name' => 'UBA',
              'bank_ifsc_code' => 'ADGU95',
            ]
        ];

        VendorsBankDetail::insert($vendorsBankDetailRecords);
    }
}
