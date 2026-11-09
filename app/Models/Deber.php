<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'titulo',
    'materia',
    'estudiante',
    'descripcion',
    'archivo',
    'nombre_original',
    'mime',
    'tamano',
])]
class Deber extends Model
{
    use HasFactory;

    protected $table = 'deberes';

    public const MATERIAS = [
        'computacion' => 'Computación',
        'matematica' => 'Matemática',
    ];

    protected function casts(): array
    {
        return [
            'tamano' => 'integer',
        ];
    }

    protected function materiaLabel(): Attribute
    {
        return Attribute::get(
            fn (): string => self::MATERIAS[$this->materia] ?? ucfirst($this->materia)
        );
    }

    protected function materiaColor(): Attribute
    {
        return Attribute::get(
            fn (): string => $this->materia === 'computacion' ? 'primary' : 'success'
        );
    }

    protected function materiaIcon(): Attribute
    {
        return Attribute::get(
            fn (): string => $this->materia === 'computacion' ? 'uil-desktop' : 'uil-calculator'
        );
    }

    protected function tamanoHumano(): Attribute
    {
        return Attribute::get(function (): string {
            $bytes = (int) $this->tamano;

            if ($bytes >= 1048576) {
                return number_format($bytes / 1048576, 2).' MB';
            }

            if ($bytes >= 1024) {
                return number_format($bytes / 1024, 1).' KB';
            }

            return $bytes.' B';
        });
    }

    protected function extension(): Attribute
    {
        return Attribute::get(
            fn (): string => strtolower(pathinfo((string) $this->nombre_original, PATHINFO_EXTENSION))
        );
    }

    public function esImagen(): bool
    {
        return str_starts_with((string) $this->mime, 'image/');
    }

    public function esPdf(): bool
    {
        return $this->mime === 'application/pdf' || $this->extension === 'pdf';
    }
}
