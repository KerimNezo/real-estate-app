<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Seeder koji stvara agent permisije i rolu, the kreira 4 agenta i assigna im Agent role.
     */
    public function run(): void
    {
        $path = '/home/rimke/code/diplomski/realestate-app/public/photos';

        $agentPermissions = [
            'create property',
            'edit property',
            'delete property',
            'edit agent',
        ];

        $agentRole = Role::firstOrCreate(['name' => 'agent']);
        foreach ($agentPermissions as $permission) {
            $createdPermission = Permission::firstOrCreate(['name' => $permission]);
            $agentRole->givePermissionTo($createdPermission);
        }

        for ($x = 0; $x < 4; $x++) {
            $user = User::factory()->create();
            $user->assignRole($agentRole);
            $user->addMedia(''.$path.'/icons/realestateagent.png')
                ->preservingOriginal()
                ->toMediaCollection('agent-pfps');
        }
    }
}
