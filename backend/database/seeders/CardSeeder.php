<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::find(1);
        $user1->cards()->create([
            'number' => '1111111111111111',
            'currency' => 'uah',
            'total' => '100',
        ]);
        $user1->cards()->create([
            'number' => '1111111111111112',
            'currency' => 'uah',
            'total' => '10000',
        ]);
        $user2 = User::find(2);
        $user2->cards()->create([
            'number' => '1111111111111113',
            'currency' => 'uah',
            'total' => '650',
        ]);
        $user2->cards()->create([
            'number' => '1111111111111114',
            'currency' => 'uah',
            'total' => '890',
        ]);
        $user3 = User::find(3);
        $user3->cards()->create([
            'number' => '1111111111111115',
            'currency' => 'uah',
            'total' => '650',
        ]);
        $user3->cards()->create([
            'number' => '1111111111111116',
            'currency' => 'uah',
            'total' => '890',
        ]);
    }
}
