<?php

namespace Database\Seeders;

use Database\Seeders\City\CitySeeder;
use Database\Seeders\Gender\GenderSeeder;
use Database\Seeders\Role\RoleSeeder;
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
      UserSeeder::class,
      CitySeeder::class,
      GenderSeeder::class,

    ]);
  }
}
