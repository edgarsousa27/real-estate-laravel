<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach([
            [
                'category_id' => 1,
                'transaction_id' => 1,
                'description' => 'Casa germinada em Santo Tirso',
                'price' => 250000,
                'square_meters' => 100,
                'year' => 2020,
                'address' => null,
                'city' => 'Santo Tirso',
                'country' => null,
                'bathrooms' => 2,
                'bedrooms' => 3,
                'kitchens' => 1,
                'garages' => 1,
                'parking_spaces' => 1,
                'floors' => 1,
                'image_path' => 'images/casa1.jpg',
                'created_at' => Carbon::now()->subMinutes(rand(1, 1440)),
            ],
            [
                'category_id' => 2,
                'transaction_id' => 1,
                'description' => 'Apartamento em Lisboa',
                'price' => 500000,
                'square_meters' => 70,
                'year' => 2023,
                'address' => null,
                'city' => 'Lisboa',
                'country' => null,
                'bathrooms' => 2,
                'bedrooms' => 3,
                'kitchens' => 1,
                'garages' => 1,
                'parking_spaces' => 1,
                'floors' => 1,
                'image_path' => 'images/casa2.jpg',
                'created_at' => Carbon::now()->subMinutes(rand(1, 1440)),
            ],
            [
                'category_id' => 3,
                'transaction_id' => 1,
                'description' => 'Terreno em Lisboa',
                'price' => 90000,
                'square_meters' => 70,
                'year' => null,
                'address' => null,
                'city' => 'Lisboa',
                'country' => null,
                'bathrooms' => null,
                'bedrooms' => null,
                'kitchens' => null,
                'garages' => null,
                'parking_spaces' => null,
                'floors' => null,
                'image_path' => 'images/terreno1.jpg',
                'created_at' => Carbon::now()->subMinutes(rand(1, 1440)),
            ],
            [
                'category_id' => 2,
                'transaction_id' => 2,
                'description' => 'Apartamento no Porto',
                'price' => 800,
                'square_meters' => 70,
                'year' => 2023,
                'address' => null,
                'city' => 'Porto',
                'country' => null,
                'bathrooms' => 2,
                'bedrooms' => 3,
                'kitchens' => 1,
                'garages' => 1,
                'parking_spaces' => 1,
                'floors' => 1,
                'image_path' => 'images/casa2.jpg',
                'created_at' => Carbon::now()->subMinutes(rand(1, 1440)),
            ],
            [
                'category_id' => 1,
                'transaction_id' => 2,
                'description' => 'Casa germinada no Porto',
                'price' => 1500,
                'square_meters' => 100,
                'year' => 2020,
                'address' => null,
                'city' => 'Porto',
                'country' => null,
                'bathrooms' => 2,
                'bedrooms' => 3,
                'kitchens' => 1,
                'garages' => 1,
                'parking_spaces' => 1,
                'floors' => 1,
                'image_path' => 'images/casa1.jpg',
                'created_at' => Carbon::now()->subMinutes(rand(1, 1440)),
            ],
            [
                'category_id' => 3,
                'transaction_id' => 2,
                'description' => 'Terreno em Roriz',
                'price' => 150,
                'square_meters' => 70,
                'year' => null,
                'address' => null,
                'city' => 'Roriz',
                'country' => null,
                'bathrooms' => null,
                'bedrooms' => null,
                'kitchens' => null,
                'garages' => null,
                'parking_spaces' => null,
                'floors' => null,
                'image_path' => 'images/terreno1.jpg',
                'created_at' => Carbon::now()->subMinutes(rand(1, 1440)),
            ],
        ] as $properties)

        Property::create($properties);
    }
}
