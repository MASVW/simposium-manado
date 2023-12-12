<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Jobs;
use Illuminate\Database\Seeder;

use App\Models\Buckets;
use App\Models\Events;
use App\Models\History;
use App\Models\Info;
use App\Models\Payment;
use App\Models\Prices;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Events::factory(2)->create();
        Info::factory(1)->create();
        Prices::factory(10)->create();
        User::create([
            "firstName" => 'Samuel',
            'lastName'=> 'Zakaria',
            'email' => 'samuelzakaria28@gmail.com',
            'password'=> Hash::make('NightFURY28'),
        ]);
        Jobs::create([
            "desc" => 'Student',
        ]);
        Jobs::create([
            "desc" => 'Doctor',
        ]);
        Jobs::create([
            "desc" => 'Specialist',
        ]);
        Jobs::create([
            "desc" => 'Specialist-1 Program / PPDS',
        ]);
        Jobs::create([
            "desc" => 'Consultant',
        ]);
        Jobs::create([
            "desc" => 'Nurse',
        ]);
        Jobs::create([
            "desc" => 'Midwife',
        ]);
    }
}
