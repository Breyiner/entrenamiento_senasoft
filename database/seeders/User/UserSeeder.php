<?php

namespace Database\Seeders\User;


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

    User::create([
      'document' => 1095305335,
      'password' => Hash::make('Breyner.051207'),
    ]);
  }
}
