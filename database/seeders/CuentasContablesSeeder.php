<?php

namespace Database\Seeders;

use App\Models\CuentasCorriente;
use Illuminate\Database\Seeder;

class CuentasContablesSeeder extends Seeder
{
    public function run(): void
    {
// Nivel 1
        $cuenta1 = CuentasCorriente::create([
            'codigo' => '001',
            'title' => 'Cuenta Nivel 1',
            'nivel' => 1,
            'principal' => true,
            'estilo' => 'estilo1'
        ]);

        // Nivel 2
        $cuenta2 = CuentasCorriente::create([
            'codigo' => '001-001',
            'title' => 'Cuenta Nivel 2',
            'nivel' => 2,
            'principal' => false,
            'estilo' => 'estilo2',
            'parent_id' => $cuenta1->id
        ]);

        // Nivel 3
        $cuenta3 = CuentasCorriente::create([
            'codigo' => '001-001-001',
            'title' => 'Cuenta Nivel 3',
            'nivel' => 3,
            'principal' => false,
            'estilo' => 'estilo3',
            'parent_id' => $cuenta2->id,
            'grandparent_id' => $cuenta1->id
        ]);

        // Nivel 4
        $cuenta4 = CuentasCorriente::create([
            'codigo' => '001-001-001-001',
            'title' => 'Cuenta Nivel 4',
            'nivel' => 4,
            'principal' => false,
            'estilo' => 'estilo4',
            'parent_id' => $cuenta3->id,
            'grandparent_id' => $cuenta2->id,
            'great_grandparent_id' => $cuenta1->id
        ]);
    }
}
