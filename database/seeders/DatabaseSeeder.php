<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //trebaš rijesiti problem nakon što obrišeš usere, ne briše se njihov zapis u model_has_roles
        //još uvijek ima njihova veza sa modelom
        //User::truncate(); - ovo briše sve zapise iz users tabele

        $adminPermissions = [
            'create agent',
            'edit agent',
            'delete agent',
            'edit property',
            'delete property',
        ];

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        foreach ($adminPermissions as $permission) {
            $createdPermission = Permission::firstOrCreate(['name' => $permission]);
            $adminRole->givePermissionTo($createdPermission);
        }

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'kerim.nezo@gmail.com',
            'phone_number' => '+387 61 034 357',
            'password' => Hash::make('judaspriest'),
        ]);

        $admin->assignRole($adminRole);

        $this->call(UserSeeder::class);

    }
}
