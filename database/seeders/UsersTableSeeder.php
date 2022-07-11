<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([            
            'email' => 'guilherme.bodelon@spasaude.org.br',
            'password' => Hash::make('123'),
            'nome' => 'Guilherme Bodelon',
            'cargo' => 'Desenvolvedor Web - Fullstack',
            'fk_setor' => '13',            
        ],
        [
            'email' => 'sistema@sistema.com.br',
            'password' => Hash::make('123'),
            'nome' => 'Sistema',
            'cargo' => 'Admin',
            'fk_setor' => '13',
        ]);
    }
}