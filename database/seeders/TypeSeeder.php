<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propertyTypes = [
            'office',
            'house',
            'appartement',
        ];

        foreach ($propertyTypes as $type) {
            Type::create([
                'name' => $type,
            ]);
        }
    }
}
