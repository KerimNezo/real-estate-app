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
use Illuminate\Support\Facades\Auth;

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
            'actions',
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
            'view actions',
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

        $admin->addMedia(public_path('photos/icons/adminPhoto.png'))
            ->preservingOriginal()
            ->toMediaCollection('admin-pfp');

        $admin->assignRole($adminRole);

        Auth::login($admin);

        $this->call(UserSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(PropertySeeder::class);

        /**
         * Promijeniti im created_at
         * Editovati ih da ima raznih statusa i prodanih ovakvih onakvih.
         * Srediti akcije da budu kako treba
         */

        // ovdje sad treba napraviti seeder neki koji edituje podatke propertya. Ili vidjeti može li se to uraditi odma tamo.
        // mogu to uraditi u property seederu, da im created_at manipulišem.

        Auth::logout();
    }
}
