<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace Database\Seeders;

use App\Models\Regency;
use Illuminate\Database\Seeder;
use AzisHapidin\IndoRegion\RawDataGetter;
use Illuminate\Support\Facades\DB;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class IndoRegionRegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @deprecated
     *
     * @return void
     */
    public function run()
    {
        // Get Data
        $regencies = RajaOngkir::kota()->all();

        // Insert Data to Database
        foreach($regencies as $regency){
            Regency::create([
                'id' => $regency['city_id'],
                'province_id' => $regency['province_id'],
                'name' => $regency['type'].' '.$regency['city_name'],
            ]);
        }
    }
}
