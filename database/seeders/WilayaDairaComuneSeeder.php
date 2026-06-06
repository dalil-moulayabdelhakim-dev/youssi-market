<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\Daira;
use App\Models\Wilaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WilayaDairaComuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('data/algeria.json'));
        $data = json_decode($json, true);

        foreach ($data as $item) {
            // Wilaya
            $wilaya = Wilaya::firstOrCreate(
                ['name' => $item['wilaya_name_ascii'], 'ar_name' => $item['wilaya_name']]
            );

            // Daira
            $daira = Daira::firstOrCreate(
                ['name' => $item['daira_name_ascii'], 'ar_name' => $item['daira_name'], 'wilaya_id' => $wilaya->id]
            );

            // Commune
            Commune::firstOrCreate(
                ['name' => $item['commune_name_ascii'], 'ar_name' => $item['commune_name'], 'daira_id' => $daira->id]
            );
        }
    }
}
