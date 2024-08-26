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
        $propertyName = ['Business Center', 'Modern 3 bedroom house', '2 bedroom appartement'];
        $propertyPhoto = ['office', 'house', 'appartement'];
        $propertyCity = ['Zenica', 'Sarajevo', 'Mostar', 'Banja Luka'];

        foreach ($propertyType as $type) {
            for ($x = 0; $x < 4; $x++) {
                $street = ($x % 2 == 0) ? 'Mejdandžik 11' : 'Adolfa Goldberga 5';
                $lease = ($x % 2 == 0) ? 5 : null; // ili ce lease duraiton biti 5 ili null

                $property = Property::factory()->create([
                    'name' => $propertyName[$type - 1],
                    'lease_duration' => $lease,
                    'user_id' => User::factory()->create(),
                    'type_id' => Type::firstWhere('id', '=', $type),
                    'country' => 'Bosnia & Herzegovina',
                    'city' => $propertyCity[$x],
                    'street' => $street,
                ]);

                $property->addMedia(''.$path.'/'.$propertyPhoto[$type - 1].'s/'.$propertyPhoto[$type - 1].'0.jpg')
                    ->preservingOriginal()
                    ->toMediaCollection('property-photos');

                // ovako dodajemo samo na nekretninu svaku još po 5 slika, ne onako kao prije
                for ($y = 1; $y < 6; $y++) {
                    $property->addMedia(''.$path.'/'.$propertyPhoto[$type - 1].'s/'.$propertyPhoto[$type - 1].''.$y.'.jpg')
                        ->preservingOriginal()
                        ->toMediaCollection('property-photos');

                }
            }
        }
    }
}
