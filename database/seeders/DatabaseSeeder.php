<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use function Symfony\Component\String\b;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $permissions = [
            'create-properties',
            'edit-properties',
            'delete-properties',
            'view-properties',
            'validate-properties'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole->syncPermissions($permissions);
        $userRole->syncPermissions(['create-properties', 'view-properties', 'edit-properties', 'delete-properties']);

        $user = User::factory()->create([
            'name' => 'Edgar',
            'email' => 'test@example.com',
            'password' => bcrypt('123')
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123'),
        ]);

        $user->assignRole($userRole);
        $admin->assignRole($adminRole);

        $this->call([
            CategorySeeder::class,
            TransactionSeeder::class,
        ]);
    }
}
