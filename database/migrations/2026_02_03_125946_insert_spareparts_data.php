<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $spareparts = [
            ["nama_sparepart"=>"RAM DDR4 8GB","stok"=>35,"harga"=>450000],
            ["nama_sparepart"=>"RAM DDR4 16GB","stok"=>28,"harga"=>820000],
            ["nama_sparepart"=>"RAM DDR5 16GB","stok"=>20,"harga"=>1250000],
            ["nama_sparepart"=>"SSD NVMe 256GB","stok"=>40,"harga"=>420000],
            ["nama_sparepart"=>"SSD NVMe 512GB","stok"=>30,"harga"=>750000],
            ["nama_sparepart"=>"SSD NVMe 1TB","stok"=>22,"harga"=>1350000],
            ["nama_sparepart"=>"SSD SATA 256GB","stok"=>38,"harga"=>380000],
            ["nama_sparepart"=>"SSD SATA 512GB","stok"=>26,"harga"=>680000],
            ["nama_sparepart"=>"HDD Internal 1TB","stok"=>33,"harga"=>550000],
            ["nama_sparepart"=>"HDD Internal 2TB","stok"=>25,"harga"=>850000],

            ["nama_sparepart"=>"Motherboard B450","stok"=>18,"harga"=>1250000],
            ["nama_sparepart"=>"Motherboard B550","stok"=>15,"harga"=>1850000],
            ["nama_sparepart"=>"Motherboard Z690","stok"=>10,"harga"=>4200000],
            ["nama_sparepart"=>"Processor Intel i3","stok"=>20,"harga"=>1800000],
            ["nama_sparepart"=>"Processor Intel i5","stok"=>18,"harga"=>3200000],
            ["nama_sparepart"=>"Processor Intel i7","stok"=>12,"harga"=>5200000],
            ["nama_sparepart"=>"Processor Ryzen 3","stok"=>22,"harga"=>1700000],
            ["nama_sparepart"=>"Processor Ryzen 5","stok"=>19,"harga"=>3100000],
            ["nama_sparepart"=>"Processor Ryzen 7","stok"=>11,"harga"=>5100000],
            ["nama_sparepart"=>"CPU Cooler Stock","stok"=>40,"harga"=>120000],

            ["nama_sparepart"=>"CPU Cooler Tower","stok"=>25,"harga"=>350000],
            ["nama_sparepart"=>"Liquid Cooler 240mm","stok"=>12,"harga"=>1250000],
            ["nama_sparepart"=>"VGA GTX 1650","stok"=>14,"harga"=>2800000],
            ["nama_sparepart"=>"VGA RTX 2060","stok"=>10,"harga"=>4800000],
            ["nama_sparepart"=>"VGA RTX 3060","stok"=>8,"harga"=>6200000],
            ["nama_sparepart"=>"VGA RTX 4070","stok"=>6,"harga"=>11000000],
            ["nama_sparepart"=>"Power Supply 500W","stok"=>30,"harga"=>650000],
            ["nama_sparepart"=>"Power Supply 650W","stok"=>24,"harga"=>850000],
            ["nama_sparepart"=>"Power Supply 750W","stok"=>18,"harga"=>1100000],
            ["nama_sparepart"=>"Power Supply Modular 850W","stok"=>10,"harga"=>1800000],

            ["nama_sparepart"=>"Casing ATX","stok"=>22,"harga"=>750000],
            ["nama_sparepart"=>"Casing Micro ATX","stok"=>26,"harga"=>650000],
            ["nama_sparepart"=>"Casing Mini ITX","stok"=>15,"harga"=>850000],
            ["nama_sparepart"=>"Fan Casing 120mm","stok"=>60,"harga"=>45000],
            ["nama_sparepart"=>"Fan RGB 120mm","stok"=>40,"harga"=>95000],
            ["nama_sparepart"=>"Thermal Paste","stok"=>55,"harga"=>35000],
            ["nama_sparepart"=>"Monitor 19 Inch","stok"=>18,"harga"=>1350000],
            ["nama_sparepart"=>"Monitor 24 Inch","stok"=>14,"harga"=>2150000],
            ["nama_sparepart"=>"Monitor 27 Inch","stok"=>10,"harga"=>3250000],
            ["nama_sparepart"=>"Keyboard Mechanical","stok"=>28,"harga"=>450000],

            ["nama_sparepart"=>"Keyboard Office","stok"=>40,"harga"=>120000],
            ["nama_sparepart"=>"Mouse Gaming","stok"=>35,"harga"=>250000],
            ["nama_sparepart"=>"Mouse Office","stok"=>50,"harga"=>85000],
            ["nama_sparepart"=>"Headset Gaming","stok"=>22,"harga"=>350000],
            ["nama_sparepart"=>"Webcam HD","stok"=>18,"harga"=>420000],
            ["nama_sparepart"=>"LAN Card PCIe","stok"=>20,"harga"=>180000],
            ["nama_sparepart"=>"WiFi Adapter USB","stok"=>25,"harga"=>150000],
            ["nama_sparepart"=>"Sound Card","stok"=>12,"harga"=>320000],
            ["nama_sparepart"=>"Flashdisk 32GB","stok"=>60,"harga"=>85000],
            ["nama_sparepart"=>"Flashdisk 64GB","stok"=>48,"harga"=>120000],

            ["nama_sparepart"=>"Flashdisk 128GB","stok"=>35,"harga"=>180000],
            ["nama_sparepart"=>"External HDD 1TB","stok"=>18,"harga"=>950000],
            ["nama_sparepart"=>"External SSD 512GB","stok"=>14,"harga"=>1250000],
            ["nama_sparepart"=>"UPS 650VA","stok"=>12,"harga"=>720000],
            ["nama_sparepart"=>"UPS 1200VA","stok"=>8,"harga"=>1450000],
            ["nama_sparepart"=>"Printer Inkjet","stok"=>10,"harga"=>1850000],
            ["nama_sparepart"=>"Printer Laser","stok"=>6,"harga"=>3250000],
            ["nama_sparepart"=>"Toner Printer","stok"=>20,"harga"=>420000],
            ["nama_sparepart"=>"Cartridge Printer","stok"=>25,"harga"=>280000],
            ["nama_sparepart"=>"Kabel HDMI","stok"=>70,"harga"=>45000],

            ["nama_sparepart"=>"Kabel VGA","stok"=>55,"harga"=>35000],
            ["nama_sparepart"=>"Kabel LAN Cat6","stok"=>80,"harga"=>25000],
            ["nama_sparepart"=>"Adaptor Laptop Universal","stok"=>18,"harga"=>320000],
            ["nama_sparepart"=>"Baterai Laptop","stok"=>12,"harga"=>650000],
            ["nama_sparepart"=>"Charger Laptop Original","stok"=>15,"harga"=>480000],
            ["nama_sparepart"=>"Bracket Monitor","stok"=>10,"harga"=>420000],
            ["nama_sparepart"=>"Cooling Pad Laptop","stok"=>22,"harga"=>180000],
            ["nama_sparepart"=>"Docking HDD","stok"=>14,"harga"=>350000],
            ["nama_sparepart"=>"Card Reader USB","stok"=>30,"harga"=>65000],
            ["nama_sparepart"=>"Bluetooth Adapter USB","stok"=>28,"harga"=>85000],
        ];

        // Add timestamps
        $now = now();
        foreach ($spareparts as &$sparepart) {
            $sparepart['created_at'] = $now;
            $sparepart['updated_at'] = $now;
        }

        // Insert data
        DB::table('spareparts')->insert($spareparts);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Delete all spareparts inserted by this migration
        DB::table('spareparts')->whereIn('nama_sparepart', [
            'RAM DDR4 8GB', 'RAM DDR4 16GB', 'RAM DDR5 16GB',
            'SSD NVMe 256GB', 'SSD NVMe 512GB', 'SSD NVMe 1TB',
            // Add more if needed for rollback
        ])->delete();
    }
};
