<?php

namespace Database\Seeders\User;

use App\Models\Profile\Profile;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {

    $superAdmin = User::create([
      'document' => 1095305335,
      'password' => Hash::make('Breyner.051207'),
    ]);

    $superAdmin->assignRole('Super Administrador');

    Profile::create([
      'user_id' => $superAdmin->id,
      'first_name' => 'Breyner Alexis',
      'last_name' => 'Acosta Sandoval',
      'phone_number' => 3232397875,
      'email' => 'breyneracosta7@gmail.com',
      'gender_id' => 1,
      'city_id' => 1,
    ]);

    $profesional = User::create([
      'document' => "1097491862",
      'password' => Hash::make('Breyner.051207'),
    ]);

    $profesional->assignRole('Profesional');

    Profile::create([
      'user_id' => $profesional->id,
      'first_name' => 'Kevin Andrey',
      'last_name' => 'Paez Garces',
      'phone_number' => 3138527072,
      'email' => 'kevinpaez1314@gmail.com',
      'gender_id' => 1,
      'city_id' => 1,
    ]);
  }
}
