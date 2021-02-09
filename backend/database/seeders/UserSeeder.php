<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'first_name' => 'Ольга',
            'last_name' => 'Сидорченко',
            'middle_name' => 'Вікторівна',
            'phone' => '380666783389',
            'email' => 'user1@test.com',
            'password' => Hash::make('user1@test.com'),
            'birth' => Carbon::parse("26.06.1980"),
        ]);
        $user2 = User::create([
            'first_name' => 'Олександр',
            'last_name' => 'Данильченко',
            'middle_name' => 'Ігорович',
            'phone' => '380993633462',
            'email' => 'user2@test.com',
            'password' => Hash::make('user2@test.com'),
            'birth' => Carbon::parse("20.06.2002"),
        ]);
        $user3 = User::create([
            'first_name' => 'Олексій',
            'last_name' => 'Крилов',
            'middle_name' => 'Богданович',
            'phone' => '380950145195',
            'email' => 'user3@test.com',
            'password' => Hash::make('user3@test.com'),
            'birth' => Carbon::parse("16.04.2002"),
        ]);
        $manager = User::create([
            'first_name' => 'Поліна',
            'last_name' => 'Фролова',
            'middle_name' => 'Олександрівна',
            'phone' => '380509656795',
            'email' => 'manager@test.com',
            'password' => Hash::make('manager@test.com'),
            'birth' => Carbon::parse("02.11.1999"),
        ]);
    }
}
