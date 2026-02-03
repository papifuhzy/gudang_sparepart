<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmailNotificationService;
use App\Models\Sparepart;

class NotificationController extends Controller
{
    protected EmailNotificationService $emailService;

    public function __construct(EmailNotificationService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * Display notification settings
     */
    public function settings()
    {
        // Load from JSON
        $json = @file_get_contents(config_path('api_gmail.json'));
        $config = $json ? json_decode($json, true) : [];
        
        $notification_email = $config['notification_settings']['notification_email'] ?? config('mail.from.address');
        
        return view('notifications.settings', [
            'notification_email' => $notification_email,
            'threshold' => 10,
        ]);
    }

    /**
     * Test email connection
     */
    public function testEmail()
    {
        $result = $this->emailService->testEmail();

        if ($result['success']) {
            return redirect()->back()->with('success', '✅ ' . $result['message']);
        }

        return redirect()->back()->with('error', '❌ ' . $result['message']);
    }

    /**
     * Send manual inventory report
     */
    public function sendReport()
    {
        $spareparts = Sparepart::orderBy('nama_sparepart')->get();
        $result = $this->emailService->sendInventoryReport($spareparts);

        if ($result['success']) {
            return redirect()->back()->with('success', '✅ ' . $result['message']);
        }

        return redirect()->back()->with('error', '❌ ' . $result['message']);
    }

    /**
     * Check all low stock items
     */
    public function checkLowStock()
    {
        $lowStockItems = Sparepart::where('stok', '<', 10)->get();

        if ($lowStockItems->isEmpty()) {
            return redirect()->back()->with('info', 'ℹ️ Tidak ada item dengan stok rendah');
        }

        // Send ONE bulk email instead of multiple individual emails
        $result = $this->emailService->sendBulkLowStockAlert($lowStockItems);

        if ($result['success']) {
            return redirect()->back()->with('success', '✅ Email peringatan stok rendah berhasil dikirim untuk ' . $lowStockItems->count() . ' item!');
        }

        return redirect()->back()->with('error', '❌ Gagal mengirim email: ' . $result['message']);
    }
}
