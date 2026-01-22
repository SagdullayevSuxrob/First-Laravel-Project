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
        $users = [
            [
            'name' => 'Sukhrob',
            'email' => 'suxrob571@gmail.com',
            'password' => Hash::make('sekret'),
            ],
            [
            'name' => 'Sukhrob',
            'email' => 'suxrob541@gmail.com',
            'password' => Hash::make('sekret'),
            ],
            [
            'name' => 'Sukhrob',
            'email' => 'suxrob5321@gmail.com',
            'password' => Hash::make('sekret'),
            ],
            [
            'name' => 'Sukhrob',
            'email' => 'suxrob521@gmail.com',
            'password' => Hash::make('sekret'),
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
        

        /* User::factory(10)->create();
        User::factory()->create([
            'email' => 'over@ride.com',
        ]); */
    }
}
