<?php

namespace Database\Seeders;

use App\Models\Deber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DeberSeeder extends Seeder
{
    public function run(): void
    {
        $muestras = [
            [
                'titulo' => 'Ejercicios de álgebra lineal',
                'materia' => 'matematica',
                'estudiante' => 'Ana Torres',
                'descripcion' => 'Resolución de sistemas de ecuaciones y operaciones con matrices.',
                'nombre_original' => 'algebra-lineal.txt',
                'contenido' => "EJERCICIOS DE ÁLGEBRA LINEAL\n\n1. Resolver el sistema:\n   2x + 3y = 8\n   x - y = -1\n\n2. Calcular el determinante de la matriz A.\n\n3. Encontrar la inversa de la matriz B.\n",
            ],
            [
                'titulo' => 'Práctica de derivadas',
                'materia' => 'matematica',
                'estudiante' => 'Luis Ramírez',
                'descripcion' => 'Reglas de derivación y problemas de aplicación.',
                'nombre_original' => 'derivadas.txt',
                'contenido' => "PRÁCTICA DE DERIVADAS\n\n1. f(x) = 3x^4 - 2x^2 + 7\n2. f(x) = sen(x) * cos(x)\n3. f(x) = ln(x^2 + 1)\n\nAplicar la regla de la cadena cuando sea necesario.\n",
            ],
            [
                'titulo' => 'Taller de probabilidad',
                'materia' => 'matematica',
                'estudiante' => 'María Fernanda López',
                'descripcion' => 'Ejercicios de probabilidad condicional y eventos independientes.',
                'nombre_original' => 'probabilidad.txt',
                'contenido' => "TALLER DE PROBABILIDAD\n\n1. Se lanzan dos dados. ¿Cuál es la probabilidad de obtener suma 7?\n2. Calcular P(A|B) para los eventos descritos en clase.\n3. Determinar si dos eventos son independientes.\n",
            ],
            [
                'titulo' => 'Algoritmo de ordenamiento en Python',
                'materia' => 'computacion',
                'estudiante' => 'Carlos Pérez',
                'descripcion' => 'Implementación de bubble sort y quick sort con ejemplos.',
                'nombre_original' => 'ordenamiento.py',
                'contenido' => "def bubble_sort(lista):\n    n = len(lista)\n    for i in range(n):\n        for j in range(0, n - i - 1):\n            if lista[j] > lista[j + 1]:\n                lista[j], lista[j + 1] = lista[j + 1], lista[j]\n    return lista\n\nprint(bubble_sort([5, 2, 9, 1, 5, 6]))\n",
            ],
            [
                'titulo' => 'Diagrama de base de datos',
                'materia' => 'computacion',
                'estudiante' => 'Andrea Gómez',
                'descripcion' => 'Modelo entidad-relación para el sistema de una biblioteca.',
                'nombre_original' => 'base-datos.txt',
                'contenido' => "MODELO ENTIDAD-RELACIÓN - BIBLIOTECA\n\nEntidades:\n- Libro (id, titulo, autor, isbn)\n- Usuario (id, nombre, correo)\n- Préstamo (id, libro_id, usuario_id, fecha)\n\nRelaciones:\n- Un usuario puede tener muchos préstamos.\n- Un libro puede aparecer en muchos préstamos.\n",
            ],
            [
                'titulo' => 'Página web con HTML y CSS',
                'materia' => 'computacion',
                'estudiante' => 'Diego Salazar',
                'descripcion' => 'Maquetación responsive de una landing page sencilla.',
                'nombre_original' => 'landing.txt',
                'contenido' => "LANDING PAGE - HTML Y CSS\n\nSecciones:\n1. Encabezado con navegación.\n2. Hero con título y botón de acción.\n3. Tarjetas de servicios.\n4. Formulario de contacto.\n5. Pie de página.\n\nUsar Flexbox y media queries para adaptar a móviles.\n",
            ],
        ];

        foreach ($muestras as $indice => $muestra) {
            $path = 'deberes/demo-'.($indice + 1).'-'.$muestra['nombre_original'];

            Storage::disk('public')->put($path, $muestra['contenido']);

            $deber = Deber::updateOrCreate(
                ['archivo' => $path],
                [
                    'titulo' => $muestra['titulo'],
                    'materia' => $muestra['materia'],
                    'estudiante' => $muestra['estudiante'],
                    'descripcion' => $muestra['descripcion'],
                    'nombre_original' => $muestra['nombre_original'],
                    'mime' => 'text/plain',
                    'tamano' => strlen($muestra['contenido']),
                ]
            );

            $deber->created_at = now()->subDays(6 - $indice);
            $deber->updated_at = now()->subDays(6 - $indice);
            $deber->save();
        }
    }
}
