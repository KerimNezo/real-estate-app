<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1 - office, 2 - house, 3 - appartement
        $propertyType = [1, 2, 3];
        $propertyName = ['Business Center', 'Modern 3 Bedroom House', '2 Bedroom Appartement'];
        $propertyPhoto = ['office', 'house', 'appartement'];
        $propertyCity = ['Zenica', 'Sarajevo', 'Mostar', 'Banja Luka'];

        $currentDate = Carbon::now();
        $monthsToSeed = 12; // Seed data for the past 12 months

        foreach ($propertyType as $type) {
            for ($i = 0; $i < 3; $i++){
                for ($x = 0; $x < $monthsToSeed; $x++) {
                    // Setting up different dates going up to 12 months back to save at created_at
                    $date = $currentDate->copy()->subMonths($x);
                    $formattedDate = $date->toDateTimeString();

                    // Setting other data inputs we'll use in create function
                    $street = ($x % 2 == 0) ? 'Mejdandžik 11' : 'Adolfa Goldberga 5';
                    $lease = ($x % 2 == 0) ? 1 : 0;
                    if ($lease === 1 && $i === 0) {
                        $lease = 0;
                    } elseif ($lease === 0 && $i === 0) {
                        $lease = 1;
                    }
                    $elevator = ($type != 2 && $x % 2 == 0) ? 1 : null;
                    $keycard = ($type != 2 && $x % 2 == 0) ? 1 : null;
                    $floors = ($type == 2 || $type % 2 == 0) ? 2 : null;
                    $garden = ($type == 2 || $type % 2 == 0) ? 1 : 0;
                    $rooms = ($type == 2 || $type == 3) ? $type + 1 : null;
                    $garage = ($x % 2 == 0) ? 2 : null;
                    $bedrooms = ($type == 2 || $type == 3) ? $type + 1 : null;
                    $price = ($lease == 1) ? round(rand(2000, 12000), -1) : round(rand(60000, 150000), -2);
                    $toilets = match ($type) {
                        1 => 3,
                        2 => 2,
                        default => 1,
                    };
    
                    // Setting default status values for properties.
                    $status = ($x % 4 === 0 || $x % 4 === 3)
                        ? 'Unavailable'
                        : 'Available';
    
                    // Creating property with data generated above
                    $property = Property::factory()->create([
                        'name' => $propertyName[$type - 1],
                        'price' => $price,
                        'lease_duration' => $lease,
                        'user_id' => $x % 4 + 2,
                        'type_id' => Type::firstWhere('id', '=', $type),
                        'country' => 'Bosnia & Herzegovina',
                        'city' => $propertyCity[$x % 4],
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
                        'status' => $status,
                        'created_at' => $formattedDate,
                    ]);
    
                    // Adding first property photo
                    $property->addMedia(public_path('photos/' . $propertyPhoto[$type - 1] . 's/' . $propertyPhoto[$type - 1] . '0.webp'))
                        ->preservingOriginal()
                        ->toMediaCollection('property-photos');
    
                    // Adding rest of property photos
                    for ($y = 1; $y < 6; $y++) {
                        $property->addMedia(public_path('photos/' . $propertyPhoto[$type - 1] . 's/' . $propertyPhoto[$type - 1] . $y . '.webp'))
                            ->preservingOriginal()
                            ->toMediaCollection('property-photos');
                    }

                    // Setting transaction_at to some properties 
                    if ($i === 0 || $i === 2) {
                        $property->transaction_at = $date->copy()->addHour();
                        if ($property->lease_duration > 0) {
                            $property->status = "Rented";

                            $property->save();
                        } else {
                            $property->status = "Sold";
                             
                            $property->save();
                        }
                    }
                }
            }
        }
    }
}

