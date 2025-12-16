<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    // Define available modules
    const MODULES = [
        'procurement' => 'Procurement Management',
        'publications' => 'Publications Management',
        'news' => 'News Management',
        'flood-data' => 'Flood Data Management',
        'data-requests' => 'Data Requests Management',
        'users' => 'User Management',
        'roles' => 'Role & Permission Management',
    ];

    // Define available actions
    const ACTIONS = [
        'view' => 'View/List',
        'create' => 'Create',
        'edit' => 'Edit/Update',
        'delete' => 'Delete',
    ];

    protected $fillable = [
        'module',
        'action',
        'name',
        'description',
    ];

    /**
     * Get the roles that have this permission.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    /**
     * Get permissions grouped by module.
     */
    public static function getGroupedByModule(): array
    {
        $permissions = self::orderBy('module')->orderBy('action')->get();
        
        $grouped = [];
        foreach ($permissions as $permission) {
            $grouped[$permission->module][] = $permission;
        }

        return $grouped;
    }

    /**
     * Create permissions for a specific module.
     */
    public static function createForModule(string $module, ?string $moduleLabel = null): void
    {
        $moduleLabel = $moduleLabel ?? (self::MODULES[$module] ?? ucfirst($module));

        foreach (self::ACTIONS as $action => $actionLabel) {
            self::updateOrCreate(
                ['name' => "{$module}.{$action}"],
                [
                    'module' => $module,
                    'action' => $action,
                    'description' => "{$actionLabel} {$moduleLabel}",
                ]
            );
        }
    }

    /**
     * Get permission by module and action.
     */
    public static function findByModuleAndAction(string $module, string $action): ?self
    {
        return self::where('module', $module)->where('action', $action)->first();
    }
}
