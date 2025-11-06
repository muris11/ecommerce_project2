<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RajaOngkirService;

class SearchRajaOngkirLocation extends Command
{
    protected $signature = 'rajaongkir:search {city}';
    protected $description = 'Search RajaOngkir location by city name';

    public function handle(RajaOngkirService $rajaOngkir)
    {
        $city = $this->argument('city');
        
        $this->info("🔍 Searching for: {$city}...\n");
        
        $response = $rajaOngkir->searchDomesticDestination($city, 20, 0);
        
        if ($response && isset($response['data'])) {
            $results = $response['data'];
            
            if (count($results) === 0) {
                $this->error("❌ No results found for '{$city}'");
                return;
            }
            
            $this->info("✅ Found " . count($results) . " locations:\n");
            
            $tableData = [];
            foreach ($results as $index => $result) {
                $tableData[] = [
                    $index + 1,
                    $result['id'] ?? '-',
                    $result['district_name'] ?? '-',
                    $result['subdistrict_name'] ?? '-',
                    $result['city_name'] ?? '-',
                    $result['province_name'] ?? '-',
                    $result['zip_code'] ?? '-',
                ];
            }
            
            $this->table(
                ['#', 'ID', 'Kecamatan', 'Desa/Kelurahan', 'Kota', 'Provinsi', 'Kode Pos'],
                $tableData
            );
            
            $this->newLine();
            $this->info("💡 Cara pakai:");
            $this->warn("   1. Pilih ID yang sesuai dengan lokasi toko Anda");
            $this->warn("   2. Update di: app/Livewire/CheckoutPage.php");
            $this->warn("   3. Ganti: \$origin = 'ID_ANDA';");
            $this->newLine();
            
        } else {
            $this->error("❌ Failed to fetch data from RajaOngkir API");
            if (isset($response['message'])) {
                $this->error("Error: " . $response['message']);
            }
        }
    }
}
