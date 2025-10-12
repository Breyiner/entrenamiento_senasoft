<?php

namespace Database\Seeders\City;

use App\Models\City\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    City::create(['name' => 'Bucaramanga']);
    City::create(['name' => 'Floridablanca']);
    City::create(['name' => 'Girón']);
    City::create(['name' => 'Piedescuesta']);
    City::create(['name' => 'San Gil']);
    City::create(['name' => 'Lebrija']);
  }
}
