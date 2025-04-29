<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach([
            [
                'type' => 'Casa',
                'sub_type' => 'Germinada',
                'title' => 'Casa',
                'description' => 'Casa germinada em Santo Tirso',
                'status' => 'Disponível',
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
                'image_path' => 'images/casa1.jpg'
            ],
            [
                'type' => 'Apartamento',
                'sub_type' => null,
                'title' => 'Apartamento',
                'description' => 'Apartamento em Lisboa',
                'status' => 'Disponível',
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
                'image_path' => 'images/casa2.jpg'
            ],
            [
                'type' => 'Terreno',
                'sub_type' => null,
                'title' => 'Terreno',
                'description' => 'Terreno em Lisboa',
                'status' => 'Disponível',
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
                'image_path' => 'images/terreno1.jpg'
            ]
        ] as $properties)

        Property::create($properties);
    }
}
