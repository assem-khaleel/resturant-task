<?php

namespace Tests\Feature;

use App\Models\Product;
use Tests\TestCase;

class ResturantTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test if a product is duplicated.
     */
    public function test_product_duplication()
    {

        $product1 = Product::make([

            'name' => 'bread',
            'quantity' => 5
        ]);

        $product2 = Product::make([

            'name' => 'chicken',
            'quantity' => 30
        ]);

        $this->assertTrue($product1 != $product2);

    }

    /**
     * Test if table ingredients has truth data in name column.
     */
    public function test_database()
    {
        $this->assertDatabaseHas('ingredients', [
            'name' => 'Beef',

        ]);
    }

    /**
     * Test if table ingredients has wrong data in name column.
     */
    public function test_database_missing()
    {
        $this->assertDatabaseMissing('ingredients', [
            'name' => 'Bread',

        ]);
    }

    /**
     * Test if seeding work for IngredientSeeder file that we created .
     */
    public function test_if_seeders_works()
    {
        $this->seed(); // php artisan db:seed
    }
}
