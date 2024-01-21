<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Position;
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
        User::create([
            "firstName" => 'Samuel',
            'lastName'=> 'Zakaria',
            'email' => 'samuelzakaria28@gmail.com',
            'phone' => '+6281370309604',
            'isAdmin' => 1,
            'password'=> Hash::make('NightFURY28'),
        ]);
        User::create([
            "firstName" => 'admin',
            'email' => 'admin@gmail.com',
            'isAdmin' => 1,
            'phone' => "admin",
            'password'=> Hash::make('admin'),
        ]);
        Position::create([
            "desc" => 'Student',
        ]);
        Position::create([
            "desc" => 'Doctor',
        ]);
        Position::create([
            "desc" => 'Specialist',
        ]);
        Position::create([
            "desc" => 'Specialist-1 Program / PPDS',
        ]);
        Position::create([
            "desc" => 'Consultant',
        ]);
        Position::create([
            "desc" => 'Nurse',
        ]);
        Position::create([
            "desc" => 'Midwife',
        ]);
        Prices::factory(10)->create();
    }
}
