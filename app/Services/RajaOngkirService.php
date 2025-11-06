<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RajaOngkirService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.rajaongkir.api_key');
        $this->baseUrl = config('services.rajaongkir.base_url');
    }

    /**
     * Search for domestic destinations (cities/districts)
     * Direct search method for autocomplete
     */
    public function searchDomesticDestination($search, $limit = 10, $offset = 0)
    {
        try {
            $cacheKey = "rajaongkir_search_{$search}_{$limit}_{$offset}";
            
            return Cache::remember($cacheKey, 300, function () use ($search, $limit, $offset) {
                $response = Http::withHeaders([
                    'key' => $this->apiKey,
                ])->get("{$this->baseUrl}/destination/domestic-destination", [
                    'search' => $search,
                    'limit' => $limit,
                    'offset' => $offset,
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                Log::error('RajaOngkir search error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return null;
            });
        } catch (\Exception $e) {
            Log::error('RajaOngkir search exception', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Calculate shipping cost
     */
    public function calculateCost($origin, $destination, $weight, $courier)
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey,
            ])->post("{$this->baseUrl}/domestic/cost", [
                'origin' => $origin,
                'originType' => 'subdistrict',
                'destination' => $destination,
                'destinationType' => 'subdistrict',
                'weight' => $weight,
                'courier' => $courier,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('RajaOngkir cost calculation error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('RajaOngkir cost calculation exception', ['message' => $e->getMessage()]);
            return null;
        }
    }

    /**
     * Get available couriers
     */
    public function getAvailableCouriers()
    {
        return [
            'jne' => 'JNE',
            'pos' => 'POS Indonesia',
            'tiki' => 'TIKI',
            'jnt' => 'J&T Express',
            'sicepat' => 'SiCepat',
            'anteraja' => 'AnterAja',
            'ninja' => 'Ninja Express',
            'lion' => 'Lion Parcel',
            'pcp' => 'PCP Express',
            'jet' => 'JET Express',
        ];
    }

    /**
     * Track waybill/resi
     */
    public function trackWaybill($waybill, $courier)
    {
        try {
            $response = Http::withHeaders([
                'key' => $this->apiKey,
            ])->post("{$this->baseUrl}/waybill", [
                'waybill' => $waybill,
                'courier' => $courier,
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('RajaOngkir waybill tracking error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('RajaOngkir waybill tracking exception', ['message' => $e->getMessage()]);
            return null;
        }
    }
}
