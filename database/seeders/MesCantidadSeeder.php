<?php

namespace Database\Seeders;

use App\Models\MesCantidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class MesCantidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            array('mes' => 'Enero', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Febrero', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Marzo', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Abril', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Mayo', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Junio', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Julio', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Agosto', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Septiembre', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Octubre', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Noviembre', 'Cantidad' => 0, 'Compras' => 0),
            array('mes' => 'Diciembre', 'Cantidad' => 0, 'Compras' => 0),
        ];
        MesCantidad::insert($data);
    }
}
