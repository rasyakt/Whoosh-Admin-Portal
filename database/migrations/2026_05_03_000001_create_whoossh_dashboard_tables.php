<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    protected $connection = 'sqlsrv';

    public function up(): void
    {
        // Create admin_users table
        DB::connection('sqlsrv')->statement("
            IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'admin_users')
            BEGIN
                CREATE TABLE admin_users (
                    id INT IDENTITY(1,1) PRIMARY KEY,
                    name NVARCHAR(100) NOT NULL,
                    email NVARCHAR(150) NOT NULL UNIQUE,
                    password NVARCHAR(255) NOT NULL,
                    role NVARCHAR(20) NOT NULL DEFAULT 'admin',
                    avatar NVARCHAR(255) NULL,
                    is_active BIT NOT NULL DEFAULT 1,
                    remember_token NVARCHAR(100) NULL,
                    created_at DATETIME DEFAULT GETDATE(),
                    updated_at DATETIME DEFAULT GETDATE()
                );
            END
        ");

        // Create trains table
        DB::connection('sqlsrv')->statement("
            IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'trains')
            BEGIN
                CREATE TABLE trains (
                    id INT IDENTITY(1,1) PRIMARY KEY,
                    name NVARCHAR(100) NOT NULL,
                    train_code NVARCHAR(20) NOT NULL,
                    capacity INT NOT NULL DEFAULT 200,
                    class_type NVARCHAR(30) NOT NULL DEFAULT 'Economy',
                    status NVARCHAR(20) NOT NULL DEFAULT 'active',
                    description NVARCHAR(500) NULL
                );
            END
        ");

        // Create schedules table (referenced in API but not in original setup)
        DB::connection('sqlsrv')->statement("
            IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'schedules')
            BEGIN
                CREATE TABLE schedules (
                    id INT IDENTITY(1,1) PRIMARY KEY,
                    train_id INT NULL,
                    train_code NVARCHAR(20) NOT NULL,
                    origin_station_id INT NOT NULL,
                    destination_station_id INT NOT NULL,
                    departure_time NVARCHAR(10) NOT NULL,
                    is_active BIT NOT NULL DEFAULT 1,
                    FOREIGN KEY (train_id) REFERENCES trains(id),
                    FOREIGN KEY (origin_station_id) REFERENCES stations(id),
                    FOREIGN KEY (destination_station_id) REFERENCES stations(id)
                );
            END
        ");

        // Create pricing_rules table
        DB::connection('sqlsrv')->statement("
            IF NOT EXISTS (SELECT * FROM sys.tables WHERE name = 'pricing_rules')
            BEGIN
                CREATE TABLE pricing_rules (
                    id INT IDENTITY(1,1) PRIMARY KEY,
                    origin_station NVARCHAR(100) NOT NULL,
                    destination_station NVARCHAR(100) NOT NULL,
                    coach_class NVARCHAR(20) NOT NULL,
                    base_price INT NOT NULL DEFAULT 0,
                    peak_price INT NOT NULL DEFAULT 0,
                    off_peak_price INT NOT NULL DEFAULT 0,
                    effective_from NVARCHAR(50) NULL,
                    effective_until NVARCHAR(50) NULL,
                    is_active BIT NOT NULL DEFAULT 1
                );
            END
        ");

        // Add is_cancelled column to bookings if not exists
        DB::connection('sqlsrv')->statement("
            IF NOT EXISTS (SELECT * FROM sys.columns WHERE object_id = OBJECT_ID('bookings') AND name = 'is_cancelled')
            BEGIN
                ALTER TABLE bookings ADD is_cancelled BIT NOT NULL DEFAULT 0;
            END
        ");

        // Add location and facilities to stations if not exists
        DB::connection('sqlsrv')->statement("
            IF NOT EXISTS (SELECT * FROM sys.columns WHERE object_id = OBJECT_ID('stations') AND name = 'location')
            BEGIN
                ALTER TABLE stations ADD location NVARCHAR(200) NULL;
            END
        ");

        DB::connection('sqlsrv')->statement("
            IF NOT EXISTS (SELECT * FROM sys.columns WHERE object_id = OBJECT_ID('stations') AND name = 'facilities')
            BEGIN
                ALTER TABLE stations ADD facilities NVARCHAR(500) NULL;
            END
        ");
    }

    public function down(): void
    {
        DB::connection('sqlsrv')->statement("IF OBJECT_ID('pricing_rules', 'U') IS NOT NULL DROP TABLE pricing_rules");
        DB::connection('sqlsrv')->statement("IF OBJECT_ID('schedules', 'U') IS NOT NULL DROP TABLE schedules");
        DB::connection('sqlsrv')->statement("IF OBJECT_ID('trains', 'U') IS NOT NULL DROP TABLE trains");
        DB::connection('sqlsrv')->statement("IF OBJECT_ID('admin_users', 'U') IS NOT NULL DROP TABLE admin_users");
    }
};
