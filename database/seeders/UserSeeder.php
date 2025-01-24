<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea un usuario con credenciales predefinidas
        User::create([
            'name'     => 'Admin',
            'email'    => 'angel@angel.com',
            //encriptar la contraseña!
            'password' => Hash::make('angel'),
        ]);
    }
}
