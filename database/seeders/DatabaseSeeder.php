<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@otovend.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        $vendorUser1 = User::create([
            'name' => 'Vending Master',
            'email' => 'vending@otovend.com',
            'password' => bcrypt('password'),
            'role' => 'vendor'
        ]);

        $vendor1 = \App\Models\Vendor::create([
            'user_id' => $vendorUser1->id,
            'shop_name' => 'Vending Solutions Polska'
        ]);

        $vendorUser2 = User::create([
            'name' => 'Coffee Tech',
            'email' => 'coffee@otovend.com',
            'password' => bcrypt('password'),
            'role' => 'vendor'
        ]);

        $vendor2 = \App\Models\Vendor::create([
            'user_id' => $vendorUser2->id,
            'shop_name' => 'Kawa i Serwis'
        ]);

        $products = [
            // Automat vendingowy
            [
                'name' => 'Necta Opera Vending Machine',
                'price' => 12500.00,
                'description' => 'Excellent condition, fully refurbished. Ready to use with current coins.',
                'category' => 'Automat vendingowy',
                'location' => 'Warszawa',
                'condition' => 'used',
                'year' => 2021,
                'image' => 'https://images.unsplash.com/photo-1575294319520-2f957077a935?auto=format&fit=crop&q=80&w=600'
            ],
            // Ekspres na ziarno
            [
                'name' => 'Saeco Royal Professional',
                'price' => 2200.00,
                'description' => 'Perfect for small offices. Built-in grinder and milk frother.',
                'category' => 'Ekspres na ziarno',
                'location' => 'Kraków',
                'condition' => 'used',
                'year' => 2019,
                'image' => 'https://images.unsplash.com/photo-1517668808822-9ebb02f2a0e6?auto=format&fit=crop&q=80&w=600'
            ],
            // Schodołazy
            [
                'name' => 'Stairclimber T09 Roby',
                'price' => 8900.00,
                'description' => 'Mobile stair climber for wheelchairs. Certified and safe.',
                'category' => 'Schodołazy',
                'location' => 'Poznań',
                'condition' => 'new',
                'year' => 2024,
                'image' => 'https://images.unsplash.com/photo-1540339832863-4745579f071a?auto=format&fit=crop&q=80&w=600'
            ],
            // Wrzutnik
            [
                'name' => 'Coin Acceptor NRI G-13',
                'price' => 450.00,
                'description' => 'Reliable coin mechanism for various vending machines.',
                'category' => 'Wrzutnik',
                'location' => 'Wrocław',
                'condition' => 'new',
                'year' => 2023,
                'image' => 'https://images.unsplash.com/photo-1621944190310-e3cca1564bd7?auto=format&fit=crop&q=80&w=600'
            ],
            // Złączki JOHN GUEST
            [
                'name' => 'John Guest Speedfit Connector 1/4"',
                'price' => 15.00,
                'description' => 'High quality push-fit connector for water filtration systems.',
                'category' => 'Złączki JOHN GUEST',
                'location' => 'Gdańsk',
                'condition' => 'new',
                'year' => 2024,
                'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&q=80&w=600'
            ],
            // Ekspres na kapsułki
            [
                'name' => 'Nespresso Zenius Business',
                'price' => 1800.00,
                'description' => 'Compact and professional capsule machine for office use.',
                'category' => 'Ekspres na kapsułki',
                'location' => 'Łódź',
                'condition' => 'new',
                'year' => 2023,
                'image' => 'https://images.unsplash.com/photo-1510511459019-5dee99c43dbf?auto=format&fit=crop&q=80&w=600'
            ],
        ];

        foreach($products as $p) {
            if ($p['category'] === 'Automat vendingowy' || $p['category'] === 'Wrzutnik') {
                $vendor1->products()->create($p);
            } else {
                $vendor2->products()->create($p);
            }
        }

        User::create([
            'name' => 'Sample Customer',
            'email' => 'customer@otovend.com',
            'password' => bcrypt('password'),
            'role' => 'customer'
        ]);
    }
}
