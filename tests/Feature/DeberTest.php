<?php

namespace Tests\Feature;

use App\Models\Deber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DeberTest extends TestCase
{
    use RefreshDatabase;

    public function test_se_puede_subir_un_deber(): void
    {
        Storage::fake('public');

        $archivo = UploadedFile::fake()->create('tarea.pdf', 120, 'application/pdf');

        $response = $this->post(route('deberes.store'), [
            'titulo' => 'Tarea de derivadas',
            'materia' => 'matematica',
            'estudiante' => 'Juan Pérez',
            'descripcion' => 'Ejercicios del capítulo 3',
            'archivo' => $archivo,
        ]);

        $response->assertRedirect(route('deberes.index'));

        $this->assertDatabaseHas('deberes', [
            'titulo' => 'Tarea de derivadas',
            'materia' => 'matematica',
            'estudiante' => 'Juan Pérez',
        ]);

        $deber = Deber::firstOrFail();
        Storage::disk('public')->assertExists($deber->archivo);
    }

    public function test_no_se_puede_subir_un_deber_sin_archivo(): void
    {
        $response = $this->from(route('deberes.create'))->post(route('deberes.store'), [
            'titulo' => 'Sin archivo',
            'materia' => 'computacion',
            'estudiante' => 'Ana Torres',
        ]);

        $response->assertSessionHasErrors('archivo');
        $this->assertDatabaseCount('deberes', 0);
    }

    public function test_no_se_acepta_una_materia_invalida(): void
    {
        Storage::fake('public');

        $archivo = UploadedFile::fake()->create('tarea.pdf', 10, 'application/pdf');

        $response = $this->from(route('deberes.create'))->post(route('deberes.store'), [
            'titulo' => 'Materia inválida',
            'materia' => 'historia',
            'estudiante' => 'Ana Torres',
            'archivo' => $archivo,
        ]);

        $response->assertSessionHasErrors('materia');
        $this->assertDatabaseCount('deberes', 0);
    }

    public function test_se_puede_filtrar_por_materia(): void
    {
        Deber::create([
            'titulo' => 'Tarea de computacion UNICA',
            'materia' => 'computacion',
            'estudiante' => 'Ana Torres',
            'archivo' => 'deberes/computacion.txt',
            'nombre_original' => 'computacion.txt',
            'mime' => 'text/plain',
            'tamano' => 10,
        ]);

        Deber::create([
            'titulo' => 'Tarea de matematica UNICA',
            'materia' => 'matematica',
            'estudiante' => 'Luis Ramírez',
            'archivo' => 'deberes/matematica.txt',
            'nombre_original' => 'matematica.txt',
            'mime' => 'text/plain',
            'tamano' => 10,
        ]);

        $response = $this->get(route('deberes.index', ['materia' => 'computacion']));

        $response->assertOk();
        $response->assertSee('Tarea de computacion UNICA');
        $response->assertDontSee('Tarea de matematica UNICA');
    }
}
