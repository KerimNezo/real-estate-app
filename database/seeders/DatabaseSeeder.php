<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // List all table names that you want to clear
        $tables = [
            'permissions',
            'media',
            'model_has_permissions',
            'model_has_roles',
            'permissions',
            'properties',
            'role_has_permissions',
            'roles',
            'types',
            'users',
            // Add more tables as needed
        ];

        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        // Truncate all specified tables
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();

        //trebaš rijesiti problem nakon što obrišeš usere, ne briše se njihov zapis u model_has_roles
        //još uvijek ima njihova veza sa modelom

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
            'password' => Hash::make('judaspriest1970'),
        ]);

        $path = '/home/rimke/code/diplomski/realestate-app/public/photos';

        $admin->addMedia(''.$path.'/icons/adminPhoto.png')
            ->preservingOriginal()
            ->toMediaCollection('admin-pfp');

        $admin->assignRole($adminRole);

        $this->call(UserSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(PropertySeeder::class);

        // ovdje generiši nekoliko officea, kuća i apartmana

    }
}
