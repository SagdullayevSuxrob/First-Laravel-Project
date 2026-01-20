<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Sukhrob',
            'email' => 'suxrob5@gmail.com',
            'password' => Hash::make('sekret'),
        ]);

        /* User::factory(10)->create();
        User::factory()->create([
            'email' => 'over@ride.com',
        ]); */
    }
}
