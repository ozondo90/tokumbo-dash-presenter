<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectionRecords = [
            [
                'name' => 'Vêtements',
                'status' => 1,
            ],
            [
                'name' => 'Électronique',
                'status' => 1,
            ],
            [
                'name' => 'Maison',
                'status' => 1,
            ],
            [
                'name' => 'Sports',
                'status' => 1,
            ],
            [
                'name' => 'Automobiles',
                'status' => 1,
            ],
            [
                'name' => 'Loisirs',
                'status' => 1,
            ],
            [
                'name' => 'Jardins',
                'status' => 1,
            ],
            [
                'name' => 'Education',
                'status' => 1,
            ],
            [
                'name' => 'Beauté',
                'status' => 1,
            ],
            [
                'name' => 'Santé',
                'status' => 1,
            ],
            [
                'name' => 'Educations',
                'status' => 1,
            ],
            [
                'name' => 'Gadgets',
                'status' => 1,
            ],
            [
                'name' => 'Bricollage',
                'status' => 1,
            ]
        ];

        Section::insert($sectionRecords);
    }
}
