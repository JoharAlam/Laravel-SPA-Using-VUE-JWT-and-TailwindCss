<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        //seeding user in database
        $user = User::create([
            'name' => 'Johar Alam',
            'email' => 'johar@glowlogix.com',
            'password' => Hash::make(123456)
        ]);
        $user->save();
    }
}
