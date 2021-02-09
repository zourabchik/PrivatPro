<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::create([
            'title' => 'User'
        ]);
        $managerRole = Role::create([
            'title' => 'Manager'
        ]);

        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);
        $manager = User::find(4);

        $user1->roles()->attach($userRole->id);
        $user2->roles()->attach($userRole->id);
        $user3->roles()->attach($userRole->id);
        $manager->roles()->attach($managerRole->id);
    }
}
