<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'slug' => 'automat-vendingowy',
                'name_pl' => 'Automaty vendingowe',
                'name_en' => 'Vending Machines',
                'icon' => 'vending',
            ],
            [
                'slug' => 'ekspres-na-ziarno',
                'name_pl' => 'Ekspresy na ziarno',
                'name_en' => 'Coffee Machines',
                'icon' => 'coffee',
            ],
            [
                'slug' => 'schodolazy',
                'name_pl' => 'Schodołazy',
                'name_en' => 'Stairclimbers',
                'icon' => 'stairclimber',
            ],
            [
                'slug' => 'wrzutnik',
                'name_pl' => 'Wrzutniki',
                'name_en' => 'Coin Mechanisms',
                'icon' => 'parts',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
