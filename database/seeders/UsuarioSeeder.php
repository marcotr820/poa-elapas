<?php

namespace Database\Seeders;

use App\Models\Trabajadores;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'usuario' => '123',
            'password' => Hash::make('123'),
            'trabajador_id' => '1',
            'remember_token' => Str::random(10)
        ])->assignRole('Admin');

        Usuario::create([
            'usuario' => '456',
            'password' => Hash::make('123'),
            'trabajador_id' => '2',
            'remember_token' => Str::random(10)
        ])->assignRole('Planificador');

        Usuario::create([
            'usuario' => '789',
            'password' => Hash::make('123'),
            'trabajador_id' => '3',
            'remember_token' => Str::random(10)
        ])->assignRole('Trabajador');

        //despues de crear nuestro usuarios por defecto llamamos al factory para que se ejecute
        // Usuario::factory(1)->create();
    }
}
