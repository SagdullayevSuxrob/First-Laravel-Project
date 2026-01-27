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
        $user = User::create([
            'name' => 'Sukhrob',
            'email' => 'suxrob571@gmail.com',
            'password' => Hash::make('sekret'),
        ]);
        $user->roles()->attach([1, 3]);


        $user2 = User::create([
            'name' => 'Sagdullayev Suxrob',
            'email' => 'suxrobsagdullayev5@gmail.com',
            'password' => Hash::make('sekret'),
        ]);
        $user2->roles()->attach([2]);

        /* User::factory(10)->create();
        User::factory()->create([
            'email' => 'over@ride.com',
        ]); */
    }
}
