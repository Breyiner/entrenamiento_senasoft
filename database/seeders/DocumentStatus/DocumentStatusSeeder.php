<?php

namespace Database\Seeders\DocumentStatus;

use App\Models\DocumentStatus\DocumentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run()
  {
    $statuses = [
      ['name' => 'Cargado'],
      ['name' => 'Aprobado'],
      ['name' => 'Rechazado'],
      ['name' => 'Archivado'],
    ];

    foreach ($statuses as $status) {
      DocumentStatus::create($status);
    }
  }
}
