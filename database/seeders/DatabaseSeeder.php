<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(VendorSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(VendorsBankDetailSeeder::class);
        $this->call(VendorsBusinessDetailSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(CategorySeeder::class);




        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
