<?php

namespace Database\Seeders\ServiceOrder;

use App\Models\Activity\Activity;
use App\Models\ServiceOrder\ServiceOrder;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceOrder::create([
            'client_id' => User::find(3)->id,
            'professional_id' => User::find(2)->id,
            'activity_id' => Activity::find(1)->id,
            'date' => Carbon::now(),
            'hours' => 2,
            'observations' => "Prioritario",
            'status_id' => 3,
        ]);
    }
}
