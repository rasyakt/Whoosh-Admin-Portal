<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class FixBookingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "🔧 Fixing booking statuses...\n\n";

        // Fix 1: Bookings that are used should not be cancelled
        $fixedUsed = Booking::where('is_used', 1)
            ->where('is_cancelled', 1)
            ->update(['is_cancelled' => 0, 'is_paid' => 1]);

        echo "✓ Fixed {$fixedUsed} completed bookings (removed cancelled status and marked as paid)\n";

        // Fix 2: Bookings that are paid but not used and not cancelled
        $fixedPaid = Booking::where('is_paid', 1)
            ->where('is_used', 0)
            ->where('is_cancelled', 1)
            ->update(['is_cancelled' => 0]);

        echo "✓ Fixed {$fixedPaid} paid bookings (removed cancelled status)\n";

        // Count statistics
        $stats = [
            'total' => Booking::count(),
            'paid' => Booking::paid()->count(),
            'unpaid' => Booking::unpaid()->count(),
            'completed' => Booking::completed()->count(),
            'cancelled' => Booking::cancelled()->count(),
            'revenue' => Booking::paid()->sum('total_price'),
        ];

        echo "\n📊 Current Statistics:\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
        echo "Total Bookings: {$stats['total']}\n";
        echo "Paid: {$stats['paid']}\n";
        echo "Unpaid: {$stats['unpaid']}\n";
        echo "Completed: {$stats['completed']}\n";
        echo "Cancelled: {$stats['cancelled']}\n";
        echo "Total Revenue: Rp " . number_format($stats['revenue']) . "\n";
        echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    }
}
