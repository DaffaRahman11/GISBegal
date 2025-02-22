<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'nama'=> 'Admin SIG',
            'email'=> 'admin@gisbegal.com',
            'password'=> Hash::make('123'),
            'email_verified_at'=>now(),
            'remember_token'=> Str::random(10),

        ]);
    }
}
