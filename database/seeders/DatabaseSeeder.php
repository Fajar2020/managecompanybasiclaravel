<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@grtech.com.my',
            'email_verified_at' => now(),
            'phone' => '',
            'gender'=> '',
            'dob'=>'',
            'user_type'=>'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@grtech.com.my',
            'email_verified_at' => now(),
            'phone' => '',
            'gender'=> '',
            'dob'=>'',
            'user_type'=>NULL,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        
    }
}
