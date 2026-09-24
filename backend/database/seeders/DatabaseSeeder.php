<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Market;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'username'      => 'admin',
            'email'         => 'admin@marketlink.com',
            'password_hash' => Hash::make('admin123'),
            'role'          => 'admin',
            'is_active'     => true,
            'is_approved'   => true,
        ]);

        // Categories
        foreach (['Vegetables', 'Fruits', 'Dairy', 'Bakery', 'Meat', 'Honey'] as $cat) {
            Category::create(['name' => $cat]);
        }

        // Markets
        Market::create([
            'market_name'    => 'Central Farmers Market',
            'address'        => 'MG Road, Delhi',
            'latitude'       => 28.6139,
            'longitude'      => 77.2090,
            'operating_days' => 'Mon,Wed,Fri',
            'timings'        => '6AM-12PM',
        ]);
        Market::create([
            'market_name'    => 'Green Valley Market',
            'address'        => 'Sector 15, Noida',
            'latitude'       => 28.5355,
            'longitude'      => 77.3910,
            'operating_days' => 'Tue,Thu,Sat',
            'timings'        => '7AM-1PM',
        ]);
    }
} 