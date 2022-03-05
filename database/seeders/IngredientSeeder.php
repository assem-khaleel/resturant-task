<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Beef','stock'=>20],
            ['id' => 2, 'name' => 'Cheese','stock'=>5],
            ['id' => 3, 'name' => 'Onion','stock'=>1],
        ];

        foreach ($items as $item) {
            Ingredient::create($item);
        }
    }
}
