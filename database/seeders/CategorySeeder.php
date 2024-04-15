<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryRecords = [
            [

                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Homme',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'homme',
                'url' => 'homme',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],

            [
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Femmes',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Femmes',
                'url' => 'femmes',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],

            [
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Enfants',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Enfants',
                'url' => 'enfants',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],

            [
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'Chaussures',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Chaussures',
                'url' => 'chaussures',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],

            [
                'parent_id' => 1,
                'section_id' => 1,
                'category_name' => 'Chemises',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Chemises',
                'url' => 'chemises',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 1,
                'section_id' => 1,
                'category_name' => 'T-shirts',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'T-shirts',
                'url' => 't-shirts',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 1,
                'section_id' => 1,
                'category_name' => 'Pulls',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Pulls',
                'url' => 'pulls',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 2,
                'section_id' => 1,
                'category_name' => 'Sacs à main',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Sacs à main',
                'url' => 'sacs-à-main',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 1,
                'section_id' => 1,
                'category_name' => 'Ceintures',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Ceintures',
                'url' => 'ceintures',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 0,
                'section_id' => 2,
                'category_name' => 'Téléphones',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Téléphones',
                'url' => 'telephones',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 0,
                'section_id' => 2,
                'category_name' => 'Tablettes',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Tablettes',
                'url' => 'tablettes',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 0,
                'section_id' => 2,
                'category_name' => 'Ordinateurs',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Ordinateurs',
                'url' => 'ordinateurs',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 3,
                'section_id' => 2,
                'category_name' => 'Laptop',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Laptop',
                'url' => 'laptop',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 3,
                'section_id' => 2,
                'category_name' => 'Desktop',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Desktop',
                'url' => 'desktop',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 3,
                'section_id' => 2,
                'category_name' => 'Desktop',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Desktop',
                'url' => 'desktop',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 0,
                'section_id' => 11,
                'category_name' => 'Livres scolaires',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Livres scolaires',
                'url' => 'livres-scolaires',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 0,
                'section_id' => 11,
                'category_name' => 'Tableaux',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Tableaux',
                'url' => 'tableaux',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 0,
                'section_id' => 11,
                'category_name' => 'Jeux éducatifs',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Jeux éducatifs',
                'url' => 'jeux-educatifs',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 0,
                'section_id' => 5,
                'category_name' => 'Auto',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Auto',
                'url' => 'auto',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 0,
                'section_id' => 5,
                'category_name' => 'Moto',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Moto',
                'url' => 'moto',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 19,
                'section_id' => 5,
                'category_name' => 'Pièces détachées',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Pièces détachées',
                'url' => 'pièces-detachees',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],
            [
                'parent_id' => 20,
                'section_id' => 5,
                'category_name' => 'Outils et Équipement',
                
                'category_icon' => '',
                'category_discount' => '0',
                'description' => 'Outils et Équipement',
                'url' => 'Outils et Équipement',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => '1',
            ],


        ];

        Category::insert($categoryRecords);
    }
}
