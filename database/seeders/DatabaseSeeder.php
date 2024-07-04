<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'kerim.nezo@gmail.com',
        //     'phone_number' => '+387 61 034 357',
        //     'password' => Hash::make('judaspriest'),
        // ]);

        $this->call(UserSeeder::class);

    }
}
