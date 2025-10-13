<?php

namespace Database\Seeders\ARL;

use App\Models\ARL\ARL;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ARLSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $arls = [
      ['name' => 'ARL SURA', 'nit' => '830091773-4', 'email' => 'contacto@sura.com.co'],
      ['name' => 'ARL POSITIVA', 'nit' => '860000190-4', 'email' => 'contacto@positiva.gov.co'],
      ['name' => 'ARL COLMENA', 'nit' => '800113555-9', 'email' => 'info@colmenaseguros.com'],
      ['name' => 'ARL COLPATRIA', 'nit' => '860300228-7', 'email' => 'contacto@axacolpatria.co'],
      ['name' => 'ARL SEGUROS BOLÍVAR', 'nit' => '890901024-0', 'email' => 'info@segurosbolivar.com'],
    ];

    foreach ($arls as $arl) {
      ARL::create([
        'name' => $arl['name'], 
        'nit' => $arl['nit'],
        'email' => $arl['email']
        ]
      );
    }
  }
}
