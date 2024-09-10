<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = '/home/rimke/code/diplomski/realestate-app/public/photos';
        // 1 - office, 2 - house, 3 - appartement
        // moram jos uraditi da se storea više slika po nekretnini i treba naći slike
        $propertyType = [1, 2, 3];
        $propertyName = ['Business Center', 'Modern 3 Bedroom House', '2 Bedroom Appartement'];
        $propertyPhoto = ['office', 'house', 'appartement'];
        $propertyCity = ['Zenica', 'Sarajevo', 'Mostar', 'Banja Luka'];

        foreach ($propertyType as $type) {
            for ($x = 0; $x < 4; $x++) {
                $street = ($x % 2 == 0) ? 'Mejdandžik 11' : 'Adolfa Goldberga 5';
                $lease = ($x % 2 == 0) ? 5 : null; // ili ce lease duraiton biti 5 ili null
                $elevator = ($type != 2 && $x % 2 == 0) ? 1 : null;
                $keycard = ($type != 2 && $x % 2 == 0) ? 1 : null;
                $floors = ($type == 2 || $type % 2 == 0) ? 2 : null;
                $garden = ($type == 2 || $type % 2 == 0) ? 1 : 0;
                $rooms = ($type == 2 || $type == 3) ? $type + 1 : null;
                $garage = ($x % 2 == 0) ? 2 : null;
                $bedrooms = ($type == 2 || $type == 3) ? $type + 1 : null;

                $toilets = match ($type) {
                    1 => 5,
                    2 => 2,
                    default => 1,
                };

                $property = Property::factory()->create([
                    'name' => $propertyName[$type - 1],
                    'lease_duration' => $lease,
                    'user_id' => User::factory()->create(),
                    'type_id' => Type::firstWhere('id', '=', $type),
                    'country' => 'Bosnia & Herzegovina',
                    'city' => $propertyCity[$x],
                    'toilets' => $toilets,
                    'bedrooms' => $bedrooms,
                    'furnished' => $rooms,
                    'garage' => $garage,
                    'rooms' => $rooms,
                    'floors' => $floors,
                    'garden' => $garden,
                    'keycard_entry' => $keycard,
                    'elevator' => $elevator,
                    'video_intercom' => $elevator,
                    'street' => $street,
                    'description' => "If you have older kids or frequent guests, this home is meant for you. A spacious loft at the top of the stairs adjoins two bedrooms with walk-in closets and a shared bath, providing just the right amount of privacy for everyone.With an open-concept layout in the great room, kitchen and casual dining, there's plenty of space and seating to bring the whole family together. Stream your favorite videos. Adjust the lighting. Check the front door without leaving your comfy seat. Our HomeSmart features are included and connect tech to your device.",
                ]);

                // dodajemo prvu sliku na nekretninu
                $property->addMedia(''.$path.'/'.$propertyPhoto[$type - 1].'s/'.$propertyPhoto[$type - 1].'0.jpg')
                    ->preservingOriginal()
                    ->toMediaCollection('property-photos');

                // dodajemo na nekretninu još po 5 slika
                for ($y = 1; $y < 6; $y++) {
                    $property->addMedia(''.$path.'/'.$propertyPhoto[$type - 1].'s/'.$propertyPhoto[$type - 1].''.$y.'.jpg')
                        ->preservingOriginal()
                        ->toMediaCollection('property-photos');

                }
            }
        }
    }
}
