<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Dark Chocolate Truffles',
                'description' => 'Premium handcrafted dark chocolate truffles with 70% cocoa',
                'price' => 15.99,
                'stock' => 100,
                'category' => 'Chocolate',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gummy Bears',
                'description' => 'Colorful fruity gummy bears in assorted flavors',
                'price' => 5.99,
                'stock' => 200,
                'category' => 'Gummy',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rainbow Lollipops',
                'description' => 'Rainbow swirl lollipops with a sweet fruity taste',
                'price' => 2.99,
                'stock' => 150,
                'category' => 'Candy',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Milk Chocolate Bar',
                'description' => 'Creamy milk chocolate bar made with premium ingredients',
                'price' => 8.99,
                'stock' => 120,
                'category' => 'Chocolate',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Strawberry Toffee',
                'description' => 'Sweet strawberry flavored toffee candies',
                'price' => 6.99,
                'stock' => 80,
                'category' => 'Toffee',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sour Gummy Worms',
                'description' => 'Tangy sour gummy worms with a sugar coating',
                'price' => 4.99,
                'stock' => 180,
                'category' => 'Gummy',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Caramel Candies',
                'description' => 'Soft buttery caramel candies wrapped individually',
                'price' => 7.49,
                'stock' => 90,
                'category' => 'Candy',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'White Chocolate Bar',
                'description' => 'Smooth and creamy white chocolate bar',
                'price' => 9.99,
                'stock' => 110,
                'category' => 'Chocolate',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mint Toffee',
                'description' => 'Refreshing mint flavored toffee candies',
                'price' => 6.49,
                'stock' => 70,
                'category' => 'Toffee',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Assorted Jelly Beans',
                'description' => 'Colorful jelly beans in 20 different flavors',
                'price' => 3.99,
                'stock' => 220,
                'category' => 'Candy',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('products')->truncate();
    }
};
