<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminUser;
use App\Models\Station;
use App\Models\Train;
use App\Models\PricingRule;

class RestoreDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        AdminUser::create([
            'name' => 'Admin',
            'email' => 'admin@whoosh.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => 1,
        ]);

        // Create Stations
        $stations = [
            ['name' => 'Stasiun Halim', 'code' => 'HLM', 'city' => 'Jakarta', 'is_active' => 1],
            ['name' => 'Stasiun Tegalluar', 'code' => 'TGL', 'city' => 'Bandung', 'is_active' => 1],
            ['name' => 'Stasiun Padalarang', 'code' => 'PDL', 'city' => 'Bandung Barat', 'is_active' => 1],
            ['name' => 'Stasiun Karawang', 'code' => 'KRW', 'city' => 'Karawang', 'is_active' => 1],
        ];

        foreach ($stations as $station) {
            Station::create($station);
        }

        // Create Trains
        $trains = [
            [
                'name' => 'Whoosh Set 1',
                'train_code' => 'G1101',
                'capacity' => 601,
                'class_type' => 'Mixed',
                'status' => 'active',
                'description' => 'EMU KCIC Set 1 - Operational'
            ],
            [
                'name' => 'Whoosh Set 2',
                'train_code' => 'G1201',
                'capacity' => 601,
                'class_type' => 'Mixed',
                'status' => 'active',
                'description' => 'EMU KCIC Set 2 - Operational'
            ],
            [
                'name' => 'Whoosh Set 3',
                'train_code' => 'G1301',
                'capacity' => 601,
                'class_type' => 'Mixed',
                'status' => 'active',
                'description' => 'EMU KCIC Set 3 - Operational'
            ],
            [
                'name' => 'Whoosh Set 4',
                'train_code' => 'G1401',
                'capacity' => 601,
                'class_type' => 'Mixed',
                'status' => 'active',
                'description' => 'EMU KCIC Set 4 - Operational'
            ],
            [
                'name' => 'Whoosh Set 5',
                'train_code' => 'G1501',
                'capacity' => 601,
                'class_type' => 'Mixed',
                'status' => 'maintenance',
                'description' => 'EMU KCIC Set 5 - Under Maintenance'
            ],
        ];

        foreach ($trains as $train) {
            Train::create($train);
        }

        // Create Pricing Rules
        $routes = [
            ['origin' => 'Tegalluar', 'destination' => 'Halim'],
            ['origin' => 'Halim', 'destination' => 'Tegalluar'],
            ['origin' => 'Tegalluar', 'destination' => 'Padalarang'],
            ['origin' => 'Padalarang', 'destination' => 'Tegalluar'],
            ['origin' => 'Tegalluar', 'destination' => 'Karawang'],
            ['origin' => 'Karawang', 'destination' => 'Tegalluar'],
            ['origin' => 'Padalarang', 'destination' => 'Halim'],
            ['origin' => 'Halim', 'destination' => 'Padalarang'],
            ['origin' => 'Padalarang', 'destination' => 'Karawang'],
            ['origin' => 'Karawang', 'destination' => 'Padalarang'],
            ['origin' => 'Karawang', 'destination' => 'Halim'],
            ['origin' => 'Halim', 'destination' => 'Karawang'],
        ];

        $classes = [
            ['class' => 'Ekonomi', 'base' => 150000, 'peak' => 200000, 'off_peak' => 100000],
            ['class' => 'Bisnis', 'base' => 300000, 'peak' => 350000, 'off_peak' => 250000],
            ['class' => 'First Class', 'base' => 600000, 'peak' => 750000, 'off_peak' => 500000],
        ];

        foreach ($routes as $route) {
            foreach ($classes as $class) {
                PricingRule::create([
                    'origin_station' => $route['origin'],
                    'destination_station' => $route['destination'],
                    'coach_class' => $class['class'],
                    'base_price' => $class['base'],
                    'peak_price' => $class['peak'],
                    'off_peak_price' => $class['off_peak'],
                    'is_active' => 1,
                ]);
            }
        }

        $this->command->info('Data restored successfully!');
        $this->command->info('Admin login: admin@whoosh.com / password');
    }
}
