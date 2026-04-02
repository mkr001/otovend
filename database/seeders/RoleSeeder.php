<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view_admin_dashboard',
            'view_vendor_dashboard',
            'manage_users',
            'manage_all_products',
            'manage_own_products',
            'buy_products',
            'leave_reviews',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign created permissions
        
        // Admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Vendor
        $vendorRole = Role::firstOrCreate(['name' => 'vendor']);
        $vendorRole->givePermissionTo([
            'view_vendor_dashboard',
            'manage_own_products',
            'buy_products',
            'leave_reviews',
        ]);

        // Customer
        $customerRole = Role::firstOrCreate(['name' => 'customer']);
        $customerRole->givePermissionTo([
            'buy_products',
            'leave_reviews',
        ]);

        // Assign roles to existing seeded users
        $adminUser = User::where('email', 'admin@otovend.com')->first();
        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }

        $vendors = User::where('role', 'vendor')->get();
        foreach ($vendors as $vendor) {
            $vendor->assignRole($vendorRole);
        }

        $customers = User::where('role', 'customer')->get();
        foreach ($customers as $customer) {
            $customer->assignRole($customerRole);
        }
    }
}
