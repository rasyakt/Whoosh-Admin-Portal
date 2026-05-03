<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@whoossh.id',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => 1,
            ],
            [
                'name' => 'Manager Operasional',
                'email' => 'manager@whoossh.id',
                'password' => Hash::make('manager123'),
                'role' => 'manager',
                'is_active' => 1,
            ],
        ];

        foreach ($admins as $admin) {
            $exists = DB::connection('sqlsrv')
                ->table('admin_users')
                ->where('email', $admin['email'])
                ->exists();

            if (!$exists) {
                DB::connection('sqlsrv')->table('admin_users')->insert($admin);
            }
        }

        // Seed trains
        $trains = [
            ['name' => 'Whoosh Set 1', 'train_code' => 'G1101', 'capacity' => 601, 'class_type' => 'Mixed', 'status' => 'active', 'description' => 'EMU KCIC Set 1 - Operational'],
            ['name' => 'Whoosh Set 2', 'train_code' => 'G1201', 'capacity' => 601, 'class_type' => 'Mixed', 'status' => 'active', 'description' => 'EMU KCIC Set 2 - Operational'],
            ['name' => 'Whoosh Set 3', 'train_code' => 'G1301', 'capacity' => 601, 'class_type' => 'Mixed', 'status' => 'active', 'description' => 'EMU KCIC Set 3 - Operational'],
            ['name' => 'Whoosh Set 4', 'train_code' => 'G1401', 'capacity' => 601, 'class_type' => 'Mixed', 'status' => 'active', 'description' => 'EMU KCIC Set 4 - Operational'],
            ['name' => 'Whoosh Set 5', 'train_code' => 'G1501', 'capacity' => 601, 'class_type' => 'Mixed', 'status' => 'maintenance', 'description' => 'EMU KCIC Set 5 - Under Maintenance'],
        ];

        foreach ($trains as $train) {
            $exists = DB::connection('sqlsrv')
                ->table('trains')
                ->where('train_code', $train['train_code'])
                ->exists();

            if (!$exists) {
                DB::connection('sqlsrv')->table('trains')->insert($train);
            }
        }

        // Seed pricing rules
        $routes = [
            ['Tegalluar', 'Halim'], ['Halim', 'Tegalluar'],
            ['Tegalluar', 'Padalarang'], ['Padalarang', 'Tegalluar'],
            ['Tegalluar', 'Karawang'], ['Karawang', 'Tegalluar'],
            ['Padalarang', 'Halim'], ['Halim', 'Padalarang'],
            ['Padalarang', 'Karawang'], ['Karawang', 'Padalarang'],
            ['Karawang', 'Halim'], ['Halim', 'Karawang'],
        ];

        $classPricing = [
            'Ekonomi' => ['base' => 150000, 'peak' => 200000, 'off_peak' => 100000],
            'Bisnis' => ['base' => 300000, 'peak' => 350000, 'off_peak' => 250000],
            'First Class' => ['base' => 600000, 'peak' => 750000, 'off_peak' => 500000],
        ];

        foreach ($routes as [$origin, $destination]) {
            foreach ($classPricing as $class => $prices) {
                $exists = DB::connection('sqlsrv')
                    ->table('pricing_rules')
                    ->where('origin_station', $origin)
                    ->where('destination_station', $destination)
                    ->where('coach_class', $class)
                    ->exists();

                if (!$exists) {
                    DB::connection('sqlsrv')->table('pricing_rules')->insert([
                        'origin_station' => $origin,
                        'destination_station' => $destination,
                        'coach_class' => $class,
                        'base_price' => $prices['base'],
                        'peak_price' => $prices['peak'],
                        'off_peak_price' => $prices['off_peak'],
                        'effective_from' => '2026-01-01',
                        'effective_until' => '2026-12-31',
                        'is_active' => 1,
                    ]);
                }
            }
        }
    }
}
