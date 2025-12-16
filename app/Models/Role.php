<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description',
        'is_system',
    ];

    protected $casts = [
        'is_system' => 'boolean',
    ];

    /**
     * Get the permissions for the role.
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }

    /**
     * Get the users who have this role.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_role');
    }

    /**
     * Give permission to the role.
     */
    public function givePermissionTo(Permission|string $permission): self
    {
        $permission = is_string($permission) 
            ? Permission::where('name', $permission)->first() 
            : $permission;

        if ($permission && !$this->permissions->contains($permission->id)) {
            $this->permissions()->attach($permission);
        }

        return $this;
    }

    /**
     * Revoke permission from the role.
     */
    public function revokePermissionTo(Permission|string $permission): self
    {
        $permission = is_string($permission) 
            ? Permission::where('name', $permission)->first() 
            : $permission;

        if ($permission) {
            $this->permissions()->detach($permission);
        }

        return $this;
    }

    /**
     * Check if role has a specific permission.
     */
    public function hasPermission(string $permission): bool
    {
        return $this->permissions()->where('name', $permission)->exists();
    }

    /**
     * Sync permissions for the role (replace all existing with new).
     */
    public function syncPermissions(array $permissions): self
    {
        $permissionIds = Permission::whereIn('name', $permissions)
            ->orWhereIn('id', $permissions)
            ->pluck('id')
            ->toArray();

        $this->permissions()->sync($permissionIds);

        return $this;
    }

    /**
     * Scope to filter out system roles.
     */
    public function scopeWhereNotSystem($query)
    {
        return $query->where('is_system', false);
    }
}
