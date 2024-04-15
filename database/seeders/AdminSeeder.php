<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRecords = [
            [
                'name' => 'Tokumbo SuperAdmin',
                'type' => 'superadmin',
                'vendor_id' => '0',
                'mobile' => '62182206',
                'email' => 'superadmin@tokunbo.com',
                'password' => Hash::make('123456789'),
                'image' => 'admin-profil.jpg',
                'status' => 1,
                'email_verified_at' => Carbon::now()
            ],
            [
                'name' => 'John Akossa',
                'type' => 'vendor',
                'vendor_id' => '1',
                'mobile' => '62182207',
                'email' => 'vendor1@gmail.com',
                'password' => Hash::make('123456789'),
                'image' => 'vendor-1-profil.jpg',
                'status' => 0,
                'email_verified_at' => Carbon::now()
            ]
        ];

        Admin::insert($adminRecords);
    }
}
