<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
        public function run(): void
    {
        // Vérifie si l'admin existe déjà
        $admin = User::where('email', 'admin@stageapp.com')->first();

        if (!$admin) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@stageapp.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
        }
    }

}
