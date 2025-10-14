<?php

namespace Database\Seeders\Client;

use App\Models\Profile\ClientProfile\ClientProfile;
use App\Models\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $cliente = User::create([
            'document' => "2332423-7",
            'password' => Hash::make('Breyner.051207'),
        ]);

        $cliente->assignRole('Cliente');

        ClientProfile::create([
            'user_id' => $cliente->id,
            'company_name' => "Alpha Ltda.",
            'address' => "Calle 123 #14-40",
            'first_name' => 'Alexis',
            'last_name' => 'Sandoval',
            'phone_number' => 3026632486,
            'email' => 'alphaltda@gmail.com',
            'arl_id' => 1,
            'gender_id' => 1,
            'city_id' => 1,
        ]);
    }
}
