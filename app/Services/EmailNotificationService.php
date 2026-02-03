<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailNotificationService
{
    protected string $notificationEmail;

    public function __construct()
    {
        // Read recipient email from JSON config
        $json = @file_get_contents(config_path('api_gmail.json'));
        if ($json) {
            $config = json_decode($json, true);
            $this->notificationEmail = $config['notification_settings']['notification_email'] ?? config('mail.from.address');
        } else {
            $this->notificationEmail = config('mail.from.address');
        }
    }

    /**
     * Send low stock alert email
     */
    public function sendLowStockAlert($sparepart): array
    {
        try {
            Mail::send('emails.low-stock', ['sparepart' => $sparepart], function ($message) use ($sparepart) {
                $message->to($this->notificationEmail)
                    ->subject('🚨 ALERT: Stok Rendah - ' . $sparepart->nama_sparepart);
            });

            Log::info('Low stock email sent', ['sparepart' => $sparepart->nama_sparepart]);

            return ['success' => true, 'message' => 'Email terkirim'];
        } catch (\Exception $e) {
            Log::error('Email failed: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Send bulk low stock alert for multiple spareparts (RECOMMENDED - prevents spam)
     */
    public function sendBulkLowStockAlert($spareparts): array
    {
        if ($spareparts->isEmpty()) {
            return ['success' => false, 'message' => 'Tidak ada item stok rendah'];
        }

        try {
            Mail::send('emails.bulk-low-stock', ['spareparts' => $spareparts], function ($message) use ($spareparts) {
                $message->to($this->notificationEmail)
                    ->subject('⚠️ Peringatan: ' . $spareparts->count() . ' Item Stok Rendah');
            });

            Log::info('Bulk low stock email sent', ['item_count' => $spareparts->count()]);

            return ['success' => true, 'message' => 'Email peringatan bulk stok rendah terkirim'];
        } catch (\Exception $e) {
            Log::error('Bulk email failed: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Send transaction notification email
     */
    public function sendTransactionNotification($transaction): array
    {
        try {
            Mail::send('emails.transaction', ['transaction' => $transaction], function ($message) use ($transaction) {
                $type = $transaction->type === 'in' ? 'Barang Masuk' : 'Barang Keluar';
                $message->to($this->notificationEmail)
                    ->subject('📦 Notifikasi: ' . $type . ' - ' . $transaction->sparepart->nama_sparepart);
            });

            Log::info('Transaction email sent', ['transaction_id' => $transaction->id]);

            return ['success' => true, 'message' => 'Email terkirim'];
        } catch (\Exception $e) {
            Log::error('Email failed: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Send inventory report
     */
    public function sendInventoryReport($spareparts): array
    {
        try {
            $lowStockCount = $spareparts->filter(fn($s) => $s->stok < 10)->count();
            $totalValue = $spareparts->sum(fn($s) => $s->stok * $s->harga);

            Mail::send('emails.inventory-report', [
                'spareparts' => $spareparts,
                'lowStockCount' => $lowStockCount,
                'totalValue' => $totalValue,
            ], function ($message) {
                $message->to($this->notificationEmail)
                    ->subject('📊 Laporan Inventori - ' . date('d/m/Y'));
            });

            Log::info('Inventory report sent');

            return ['success' => true, 'message' => 'Laporan terkirim'];
        } catch (\Exception $e) {
            Log::error('Report failed: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /**
     * Test email connection
     */
    public function testEmail(): array
    {
        try {
            Mail::raw(
                "✅ TEST EMAIL BERHASIL\n\nKoneksi Gmail berhasil!\nSistem notifikasi Gudang Sparepart siap digunakan.\n\n" . date('d/m/Y H:i:s'),
                function ($message) {
                    $message->to($this->notificationEmail)
                        ->subject('✅ Test Email - Gudang Sparepart');
                }
            );

            return ['success' => true, 'message' => 'Test email terkirim ke ' . $this->notificationEmail];
        } catch (\Exception $e) {
            Log::error('Test email failed: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
