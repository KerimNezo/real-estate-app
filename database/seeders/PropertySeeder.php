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
        $propertyType = [1, 2, 3];
        $propertyName = ['Business Center', 'Modern 3 bedroom house', '2 bedroom appartement'];

        foreach ($propertyType as $type) {
            for ($x = 0; $x < 4; $x++) {
                $property = Property::factory()->create([
                    'name' => $propertyName[$type - 1],
                    'user_id' => User::factory()->create(),
                    'type_id' => Type::firstWhere('id', '=', $type),
                ]);
                // ->addMedia('/home/rimke/Desktop/slike/le-code.jpg')
                // ->preservingOriginal()
                // ->toMediaCollection('logos');
            }
        }
    }
}
