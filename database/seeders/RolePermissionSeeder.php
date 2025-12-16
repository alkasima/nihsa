<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create all permissions for each module
        $modules = [
            'procurement' => 'Procurement Management',
            'publications' => 'Publications Management',
            'news' => 'News Management',
            'flood-data' => 'Flood Data Management',
            'data-requests' => 'Data Requests Management',
            'users' => 'User Management',
            'roles' => 'Role & Permission Management',
        ];

        $actions = [
            'view' => 'View/List',
            'create' => 'Create',
            'edit' => 'Edit/Update',
            'delete' => 'Delete',
        ];

        // Create permissions
        foreach ($modules as $module => $moduleLabel) {
            foreach ($actions as $action => $actionLabel) {
                Permission::updateOrCreate(
                    ['name' => "{$module}.{$action}"],
                    [
                        'module' => $module,
                        'action' => $action,
                        'description' => "{$actionLabel} {$moduleLabel}",
                    ]
                );
            }
        }

        // Create roles
        $superAdmin = Role::updateOrCreate(
            ['name' => 'Super Admin'],
            [
                'description' => 'Has full access to all features',
                'is_system' => true,
            ]
        );

        $admin = Role::updateOrCreate(
            ['name' => 'Admin'],
            [
                'description' => 'Can manage most content and users',
                'is_system' => true,
            ]
        );

        $editor = Role::updateOrCreate(
            ['name' => 'Editor'],
            [
                'description' => 'Can create and edit content',
                'is_system' => false,
            ]
        );

        $viewer = Role::updateOrCreate(
            ['name' => 'Viewer'],
            [
                'description' => 'Can only view content',
                'is_system' => false,
            ]
        );

        // Assign permissions to Super Admin (all permissions)
        $allPermissions = Permission::all();
        $superAdmin->permissions()->sync($allPermissions);

        // Assign permissions to Admin (all except role management)
        $adminPermissions = Permission::where('module', '!=', 'roles')->get();
        $admin->permissions()->sync($adminPermissions);

        // Assign permissions to Editor (create, edit, view for content modules)
        $editorPermissions = Permission::whereIn('module', ['procurement', 'publications', 'news', 'flood-data'])
            ->whereIn('action', ['view', 'create', 'edit'])
            ->get();
        $editor->permissions()->sync($editorPermissions);

        // Assign permissions to Viewer (view only)
        $viewerPermissions = Permission::where('action', 'view')->get();
        $viewer->permissions()->sync($viewerPermissions);

        // Assign Super Admin role to the first user (if exists)
        $firstUser = User::first();
        if ($firstUser) {
            $firstUser->syncRoles(['Super Admin']);
            $this->command->info("Super Admin role assigned to: {$firstUser->email}");
        }

        $this->command->info('Roles and permissions seeded successfully!');
        $this->command->info("Total Permissions: {$allPermissions->count()}");
        $this->command->info("Roles created: Super Admin, Admin, Editor, Viewer");
    }
}
