<?php

namespace Database\Seeders;

use App\Enums\StatusEnum;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin']);

        $permissions = [
            'view_role', 'view_any_role', 'create_role', 'update_role', 'delete_role', 'delete_any_role',
            'view_admin', 'view_any_admin', 'create_admin', 'update_admin', 'delete_admin', 'delete_any_admin',
        ];

        foreach ($permissions as $permission) {
            $perm = Permission::create(['name' => $permission]);
            $superAdminRole->givePermissionTo($perm);
        }

        $superAdmin = Admin::factory()->create([
            'name' => 'Admin',
            'phone' => '0180000000',
            'email' => 'admin@example.com',
            'password' => '$2y$10$jXVY75E1KZJuxHFU.08k6udGe36z0jcwdGuoqGq0BQ/QFBoWCOAKC', // 12345678
            'designation' => 'Software Engineer',
            'status' => StatusEnum::Active,
            'admin_type' => 'SYSTEM_ADMIN',
        ]);


        $superAdmin->assignRole('super-admin');

        Admin::factory()->count(20)->create();
    }
}
