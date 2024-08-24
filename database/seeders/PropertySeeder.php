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
        // 1 - office, 2 - house, 3 - appartement
        // moram jos uraditi da se storea više slika po nekretnini i treba naći slike
        $propertyType = [1, 2, 3];
        $propertyName = ['Business Center', 'Modern 3 bedroom house', '2 bedroom appartement'];
        $propertyPhoto = ['office', 'house', 'appartement'];
        $propertyCity = ['Zenica', 'Sarajevo', 'Mostar', 'Banja Luka'];

        foreach ($propertyType as $type) {
            for ($x = 0; $x < 4; $x++) {
                $street = ($x % 2 == 0) ? 'Mejdandžik 11' : 'Adolfa Goldberga 5';

                $property = Property::factory()->create([
                    'name' => $propertyName[$type - 1],
                    'user_id' => User::factory()->create(),
                    'type_id' => Type::firstWhere('id', '=', $type),
                    'country' => 'Bosnia & Herzegovina',
                    'city' => $propertyCity[$x],
                    'street' => $street,
                ])->addMedia('/home/rimke/code/diplomski/realestate-app/public/photos/'.$propertyPhoto[$type - 1].'.jpg')
                    ->preservingOriginal()
                    ->toMediaCollection('property-photos');
            }
        }
    }
}
