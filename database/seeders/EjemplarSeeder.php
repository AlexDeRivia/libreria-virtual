<?php

namespace Database\Seeders;

use App\Models\Ejemplar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EjemplarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ejemplares = [
            [
                'libro_id' => '1',
                'idioma_id' => '1',
                'numero_ejemplar' => '1001',
                'precio' => '39.99',
                'stock' => '15',
            ],
            [
                'libro_id' => '1',
                'idioma_id' => '2',
                'numero_ejemplar' => '1002',
                'precio' => '34.99',
                'stock' => '50',
            ],
            [
                'libro_id' => '2',
                'idioma_id' => '1',
                'numero_ejemplar' => '3001',
                'precio' => '29.99',
                'stock' => '30',
            ],
            [
                'libro_id' => '2',
                'idioma_id' => '2',
                'numero_ejemplar' => '3002',
                'precio' => '29.99',
                'stock' => '40',
            ],
            [
                'libro_id' => '3',
                'idioma_id' => '1',
                'numero_ejemplar' => '8101',
                'precio' => '34.99',
                'stock' => '10',
            ],
            [
                'libro_id' => '3',
                'idioma_id' => '3',
                'numero_ejemplar' => '8105',
                'precio' => '34.99',
                'stock' => '80',
            ],
            [
                'libro_id' => '4',
                'idioma_id' => '1',
                'numero_ejemplar' => '7901',
                'precio' => '19.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '4',
                'idioma_id' => '2',
                'numero_ejemplar' => '7902',
                'precio' => '19.99',
                'stock' => '30',
            ],
            [
                'libro_id' => '5',
                'idioma_id' => '1',
                'numero_ejemplar' => '4801',
                'precio' => '29.99',
                'stock' => '50',
            ],
            [
                'libro_id' => '6',
                'idioma_id' => '1',
                'numero_ejemplar' => '4701',
                'precio' => '28.55',
                'stock' => '50',
            ],
            [
                'libro_id' => '7',
                'idioma_id' => '1',
                'numero_ejemplar' => '3101',
                'precio' => '29.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '8',
                'idioma_id' => '1',
                'numero_ejemplar' => '4601',
                'precio' => '29.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '9',
                'idioma_id' => '1',
                'numero_ejemplar' => '5601',
                'precio' => '29.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '10',
                'idioma_id' => '1',
                'numero_ejemplar' => '6601',
                'precio' => '29.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '11',
                'idioma_id' => '1',
                'numero_ejemplar' => '7601',
                'precio' => '29.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '12',
                'idioma_id' => '2',
                'numero_ejemplar' => '2201',
                'precio' => '39.99',
                'stock' => '70',
            ],
            [
                'libro_id' => '12',
                'idioma_id' => '1',
                'numero_ejemplar' => '2202',
                'precio' => '39.99',
                'stock' => '10',
            ],
            [
                'libro_id' => '13',
                'idioma_id' => '2',
                'numero_ejemplar' => '3301',
                'precio' => '19.99',
                'stock' => '30',
            ],
            [
                'libro_id' => '13',
                'idioma_id' => '1',
                'numero_ejemplar' => '3302',
                'precio' => '19.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '14',
                'idioma_id' => '2',
                'numero_ejemplar' => '4401',
                'precio' => '9.99',
                'stock' => '10',
            ],
            [
                'libro_id' => '14',
                'idioma_id' => '1',
                'numero_ejemplar' => '4402',
                'precio' => '9.99',
                'stock' => '25',
            ],
            [
                'libro_id' => '15',
                'idioma_id' => '7',
                'numero_ejemplar' => '5501',
                'precio' => '49.99',
                'stock' => '35',
            ],
            [
                'libro_id' => '15',
                'idioma_id' => '1',
                'numero_ejemplar' => '5502',
                'precio' => '49.99',
                'stock' => '15',
            ],
            [
                'libro_id' => '15',
                'idioma_id' => '2',
                'numero_ejemplar' => '5503',
                'precio' => '49.99',
                'stock' => '25',
            ],
            [
                'libro_id' => '16',
                'idioma_id' => '1',
                'numero_ejemplar' => '7701',
                'precio' => '19.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '17',
                'idioma_id' => '1',
                'numero_ejemplar' => '8801',
                'precio' => '19.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '18',
                'idioma_id' => '1',
                'numero_ejemplar' => '9901',
                'precio' => '19.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '19',
                'idioma_id' => '1',
                'numero_ejemplar' => '1101',
                'precio' => '19.99',
                'stock' => '20',
            ],
            [
                'libro_id' => '20',
                'idioma_id' => '1',
                'numero_ejemplar' => '2021',
                'precio' => '19.99',
                'stock' => '20',
            ],
        ];

        foreach ($ejemplares as $ejemplar) {
            Ejemplar::create($ejemplar);
        }
    }
}
