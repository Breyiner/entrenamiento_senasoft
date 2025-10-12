<?php

namespace Database\Seeders\UserStatus;

use App\Models\UserStatus\UserStatus;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    UserStatus::create(['name' => 'Activo']);
    UserStatus::create(['name' => 'Inactivo']);
  }
}
