<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $members = [
            [
                'name' => 'Member 1',
                'email' => 'member1@example.com',
                'password' => Hash::make('password'),
                'role' => 'member',
            ],
            [
                'name' => 'Member 2',
                'email' => 'member2@example.com',
                'password' => Hash::make('password'),
                'role' => 'member',
            ],
        ];

        foreach ($members as $member) {
            User::create($member);
        }
    }
}
