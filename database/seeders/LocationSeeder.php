<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Http;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');

        if ($response->successful()) {
            foreach ($response->json() as $province) {
                Location::create([
                    'name' => $province['name'],
                    'type' => 'province',
                    'parent_id' => null,
                ]);
            }
        }
    }
}
