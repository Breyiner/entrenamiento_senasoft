<?php

namespace Database\Seeders\OrderStatus;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus\OrderStatus;

class OrderStatusSeeder extends Seeder
{
  public function run()
  {
    $statuses = [
      ['name' => 'Sin programar'],
      ['name' => 'Por confirmar'],
      ['name' => 'Programada'],
      ['name'=> 'Aplazada'],
      ['name' => 'Ejecutada'],
      ['name' => 'Pendiente Soporte'],
      ['name' => 'Por facturar'],
    ];

    foreach ($statuses as $status) {
      OrderStatus::create($status);
    }
  }
}
