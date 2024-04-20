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
            array('mes' => 'Enero', 'Cantidad' => '2344'),
            array('mes' => 'Febrero', 'Cantidad' => '4444'),
            array('mes' => 'Marzo', 'Cantidad' => '33'),
            array('mes' => 'Abril', 'Cantidad' => '0'),
            array('mes' => 'Mayo', 'Cantidad' => '5555'),
            array('mes' => 'Junio', 'Cantidad' => '66'),
            array('mes' => 'Julio', 'Cantidad' => '0'),
            array('mes' => 'Agosto', 'Cantidad' => '22'),
            array('mes' => 'Septiembre', 'Cantidad' => '0'),
            array('mes' => 'Octubre', 'Cantidad' => '4234'),
            array('mes' => 'Noviembre', 'Cantidad' => '23423'),
            array('mes' => 'Diciembre', 'Cantidad' => '42'),
        ];
        MesCantidad::insert($data);
    }
}
