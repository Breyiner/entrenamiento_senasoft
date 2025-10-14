<?php

namespace Database\Seeders;

use Database\Seeders\Activity\ActivitySeeder;
use Database\Seeders\ARL\ARLSeeder;
use Database\Seeders\City\CitySeeder;
use Database\Seeders\Client\ClientSeeder;
use Database\Seeders\DocumentStatus\DocumentStatusSeeder;
use Database\Seeders\Gender\GenderSeeder;
use Database\Seeders\OrderStatus\OrderStatusSeeder;
use Database\Seeders\Role\RoleSeeder;
use Database\Seeders\ServiceOrder\ServiceOrderSeeder;
use Database\Seeders\User\UserSeeder;
use Database\Seeders\UserStatus\UserStatusSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {

    $this->call([

      UserStatusSeeder::class,
      RoleSeeder::class,
      CitySeeder::class,
      GenderSeeder::class,
      ARLSeeder::class,
      UserSeeder::class,
      ClientSeeder::class,
      ActivitySeeder::class,
      OrderStatusSeeder::class,
      ServiceOrderSeeder::class,
      DocumentStatusSeeder::class,

    ]);
  }
}
