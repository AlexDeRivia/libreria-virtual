<?php

namespace Database\Seeders;

use App\Models\Libro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $libros = [
            [
                'titulo' => 'La ciudad y los perros',
                'resumen' => 'Ambientada en un colegio militar en Lima, esta novela explora la brutalidad, la corrupción y el poder entre los cadetes.',
                'isbn' => '978-8-457-30246-1',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'Cien años de soledad',
                'resumen' => 'Esta obra maestra del realismo mágico narra la historia de la familia Buendía a lo largo de varias generaciones en el ficticio pueblo de Macondo.',
                'isbn' => '978-0-140-18513-7',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'El túnel',
                'resumen' => 'Un hombre obsesionado con una mujer casada comete un crimen y reflexiona sobre su propia existencia en este relato existencialista.',
                'isbn' => '978-84-9759-491-9',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'Rayuela',
                'resumen' => 'Una novela experimental que desafía las convenciones narrativas tradicionales y ofrece múltiples formas de ser leída.',
                'isbn' => '978-8-458-72010-1',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'El amor en los tiempos del cólera',
                'resumen' => 'Una historia de amor que perdura a lo largo del tiempo, ambientada en la exuberante costa caribeña de Colombia.',
                'isbn' => '978-8-447-90118-9',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'La fiesta del chivo',
                'resumen' => 'Una novela que relata los últimos días del dictador dominicano Rafael Trujillo y su influencia en la vida de sus seguidores.',
                'isbn' => '978-8-448-61938-3',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'El general en su laberinto',
                'resumen' => 'Una reconstrucción ficticia de los últimos días de Simón Bolívar, el libertador de América del Sur.',
                'isbn' => '978-8-448-70189-0',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'La guerra del fin del mundo',
                'resumen' => 'Basada en hechos reales, esta novela recrea la guerra de Canudos en Brasil a fines del siglo XIX, donde un líder mesiánico desafía al gobierno.',
                'isbn' => '978-8-448-70012-1',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'El coronel no tiene quien le escriba',
                'resumen' => 'Un coronel retirado y su esposa esperan la llegada de una pensión que nunca llega, mientras luchan contra la pobreza y la adversidad.',
                'isbn' => '978-8-448-60123-3',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'La fiesta vigilada',
                'resumen' => 'Un joven diplomático se ve envuelto en un juego de espionaje y traición durante la Segunda Guerra Mundial en esta novela de suspenso.',
                'isbn' => '978-8-448-70377-1',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'Sobre héroes y tumbas',
                'resumen' => 'Una obra magistral que entrelaza varias historias en la Argentina de mediados del siglo XX, explorando temas como la locura y la historia nacional.',
                'isbn' => '978-8-448-70322-1',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'resumen' => 'Ofrece principios y prácticas para escribir código limpio y fácilmente mantenible, crucial para el desarrollo de software de alta calidad.',
                'isbn' => '978-0-13-235088-4',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'The Art of Computer Programming',
                'resumen' => 'Esta obra monumental aborda los fundamentos de la informática y la programación de manera exhaustiva y detallada.',
                'isbn' => '978-0-201-03801-1',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'Introduction to the Theory of Computation',
                'resumen' => 'Explora los fundamentos teóricos de la informática y la computación, incluyendo autómatas, lenguajes formales y complejidad computacional.',
                'isbn' => '978-1-133-18779-0',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'El príncipe',
                'resumen' => 'Un tratado político clásico que analiza cómo los gobernantes pueden obtener y mantener el poder, escrito durante el Renacimiento italiano.',
                'isbn' => '978-1-601-63333-2',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'Democracia y educación',
                'resumen' => 'Este libro aborda la relación entre la educación y la democracia, explorando cómo la educación puede promover una sociedad democrática.',
                'isbn' => '978-8-487-32338-7',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'Cocina al minuto',
                'resumen' => 'Un clásico de la cocina cubana que ofrece recetas tradicionales de la isla adaptadas para prepararse de forma rápida y sencilla.',
                'isbn' => '978-9-585-18329-2',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'Mastering the Art of French Cooking',
                'resumen' => 'Escrito por una icónica chef, este libro es una guía detallada para dominar la cocina francesa, desde técnicas básicas hasta platos elaborados.',
                'isbn' => '978-0-375-41340-2',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'The Joy of Cooking',
                'resumen' => 'Una obra clásica de la cocina estadounidense que ofrece una amplia variedad de recetas acompañadas de consejos útiles y técnicas culinarias.',
                'isbn' => '978-0-7432-4626-2',
                'es_novedad' => '0',
            ],
            [
                'titulo' => 'Food Lab: Better Home Cooking Through Science',
                'resumen' => 'Explora los principios científicos detrás de la cocina, ofreciendo técnicas probadas y recetas mejoradas mediante la comprensión de la química y la física de los alimentos.',
                'isbn' => '978-0-393-08108-4',
                'es_novedad' => '0',
            ],
        ];

        foreach ($libros as $libro) {
            Libro::create($libro);
        }
    }
}
