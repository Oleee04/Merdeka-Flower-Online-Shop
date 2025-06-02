<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    /**
     * Ambil daftar provinsi dari API RajaOngkir
     */
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get(env('RAJAONGKIR_BASE_URL') . '/province');

        $data = $response->json();

        if ($response->failed()) {
            return response()->json([
                'error' => 'Gagal mengambil data provinsi',
                'details' => $data
            ], $response->status());
        }

        return response()->json($data['rajaongkir']['results']);
    }

    /**
     * Ambil daftar kota berdasarkan ID provinsi dari API RajaOngkir
     */
    public function getCities(Request $request)
    {
        $provinceId = $request->input('province_id');

        if (!$provinceId) {
            return response()->json([
                'error' => 'province_id diperlukan'
            ], 400);
        }

        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->get(env('RAJAONGKIR_BASE_URL') . '/city', [
            'province' => $provinceId
        ]);

        $data = $response->json();

        if ($response->failed()) {
            return response()->json([
                'error' => 'Gagal mengambil data kota',
                'details' => $data
            ], $response->status());
        }

        return response()->json($data['rajaongkir']['results']);
    }

    /**
     * Hitung ongkir berdasarkan asal, tujuan, berat, dan kurir
     */
    public function getCost(Request $request)
    {
        $validated = $request->validate([
            'origin' => 'required|integer',
            'destination' => 'required|integer',
            'weight' => 'required|integer|min:1',
            'courier' => 'required|string'
        ]);

        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY')
        ])->post(env('RAJAONGKIR_BASE_URL') . '/cost', [
            'origin' => $validated['origin'],
            'destination' => $validated['destination'],
            'weight' => $validated['weight'],
            'courier' => $validated['courier']
        ]);

        $data = $response->json();

        if ($response->failed()) {
            return response()->json([
                'error' => 'Gagal menghitung ongkir',
                'details' => $data
            ], $response->status());
        }

        return response()->json($data['rajaongkir']['results']);
    }
}
