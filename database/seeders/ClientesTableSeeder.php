<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            'cif' => '47854962A',
            'nombre' => 'Eugenio',
            'telefono' => 959784162,
            'correo' => 'eugenio@prueba.com',
            'cuenta_corriente' => 'XXXX-XX-XXXX-XXXXXX-XX',
            'pais_id' => 3,
            'moneda' => '$',
            'cuota_mensual' => 2,
        ]);
        Cliente::create([
            'cif' => '58741291B',
            'nombre' => 'Jacinta',
            'telefono' => 955478126,
            'correo' => 'jacinta@prueba.com',
            'cuenta_corriente' => 'XXXX-XX-XXXX-XXXXXX-XX',
            'pais_id' => 14,
            'moneda' => '€',
            'cuota_mensual' => 5,
        ]);
        Cliente::create([
            'cif' => '68149572A',
            'nombre' => 'Pepe',
            'telefono' => 954147852,
            'correo' => 'pepe@prueba.com',
            'cuenta_corriente' => 'XXXX-XX-XXXX-XXXXXX-XX',
            'pais_id' => 6,
            'moneda' => '$',
            'cuota_mensual' => 10,
        ]);
    }
                // $table->integer('id')->primary();
                // $table->string('cif', 15);
                // $table->string('nombre', 50);
                // $table->integer('telefono');
                // $table->string('correo', 50);
                // $table->string('cuenta_corriente', 100);
                // $table->unsignedSmallInteger('pais_id')->index('fk_clientes_paises1_idx');
                // $table->string('moneda', 10);
                // $table->integer('cuota_mensual');
}
