<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the roles assigned to the user.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role')->withTimestamps();
    }

    /**
     * Assign a role to the user.
     */
    public function assignRole(Role|string $role): self
    {
        $role = is_string($role) 
            ? Role::where('name', $role)->first() 
            : $role;

        if ($role && !$this->roles->contains($role->id)) {
            $this->roles()->attach($role);
        }

        return $this;
    }

    /**
     * Remove a role from the user.
     */
    public function removeRole(Role|string $role): self
    {
        $role = is_string($role) 
            ? Role::where('name', $role)->first() 
            : $role;

        if ($role) {
            $this->roles()->detach($role);
        }

        return $this;
    }

    /**
     * Sync roles for the user (replace all existing with new).
     */
    public function syncRoles(array $roles): self
    {
        $roleIds = Role::whereIn('name', $roles)
            ->orWhereIn('id', $roles)
            ->pluck('id')
            ->toArray();

        $this->roles()->sync($roleIds);

        return $this;
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole(string|array $role): bool
    {
        if (is_array($role)) {
            return $this->roles()->whereIn('name', $role)->exists();
        }

        return $this->roles()->where('name', $role)->exists();
    }

    /**
     * Check if user has a specific permission.
     */
    public function hasPermission(string $permission): bool
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permission) {
                $query->where('name', $permission);
            })
            ->exists();
    }

    /**
     * Check if user has any of the given permissions.
     */
    public function hasAnyPermission(array $permissions): bool
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permissions) {
                $query->whereIn('name', $permissions);
            })
            ->exists();
    }

    /**
     * Check if user has all of the given permissions.
     */
    public function hasAllPermissions(array $permissions): bool
    {
        $userPermissions = $this->getAllPermissions()->pluck('name')->toArray();

        foreach ($permissions as $permission) {
            if (!in_array($permission, $userPermissions)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get all permissions for the user through their roles.
     */
    public function getAllPermissions()
    {
        return Permission::whereHas('roles', function ($query) {
            $query->whereIn('roles.id', $this->roles->pluck('id'));
        })->get();
    }

    /**
     * Simplified permission check by module and action.
     */
    public function canAccess(string $action, string $module): bool
    {
        return $this->hasPermission("{$module}.{$action}");
    }

    /**
     * Check if user is a super admin (has all permissions).
     */
    public function isSuperAdmin(): bool
    {
        return $this->hasRole('Super Admin');
    }
}
