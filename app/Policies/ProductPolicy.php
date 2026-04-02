<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability): bool|null
    {
        // Admin role (both from spatie and from legacy role column) bypasses all checks
        if ($user->hasRole('admin') || $user->role === 'admin') {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('manage_own_products') || $user->role === 'vendor';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        $vendorId = optional($user->vendor)->id;
        $hasPermission = $user->hasPermissionTo('manage_own_products') || $user->role === 'vendor';
        // Use loose comparison (==) to handle int/string type differences
        return $vendorId && $hasPermission && $vendorId == $product->vendor_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        $vendorId = optional($user->vendor)->id;
        $hasPermission = $user->hasPermissionTo('manage_own_products') || $user->role === 'vendor';
        // Use loose comparison (==) to handle int/string type differences
        return $vendorId && $hasPermission && $vendorId == $product->vendor_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return false;
    }
}
