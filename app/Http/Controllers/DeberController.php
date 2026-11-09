<?php

namespace App\Http\Controllers;

use App\Models\Deber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DeberController extends Controller
{
    public function dashboard(): View
    {
        $total = Deber::count();
        $computacion = Deber::where('materia', 'computacion')->count();
        $matematica = Deber::where('materia', 'matematica')->count();
        $esteMes = Deber::where('created_at', '>=', now()->startOfMonth())->count();
        $recientes = Deber::latest()->take(6)->get();

        return view('dashboard', compact('total', 'computacion', 'matematica', 'esteMes', 'recientes'));
    }

    public function index(Request $request): View
    {
        $query = Deber::query();

        if (in_array($request->input('materia'), array_keys(Deber::MATERIAS), true)) {
            $query->where('materia', $request->input('materia'));
        }

        if ($request->filled('buscar')) {
            $buscar = trim((string) $request->input('buscar'));

            $query->where(function ($subquery) use ($buscar) {
                $subquery->where('titulo', 'like', "%{$buscar}%")
                    ->orWhere('estudiante', 'like', "%{$buscar}%")
                    ->orWhere('descripcion', 'like', "%{$buscar}%");
            });
        }

        $deberes = $query->latest()->paginate(10)->withQueryString();

        return view('deberes.index', compact('deberes'));
    }

    public function create(): View
    {
        return view('deberes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'titulo' => ['required', 'string', 'max:120'],
            'materia' => ['required', 'in:computacion,matematica'],
            'estudiante' => ['required', 'string', 'max:80'],
            'descripcion' => ['nullable', 'string', 'max:2000'],
            'archivo' => [
                'required',
                'file',
                'max:20480',
                'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar,jpg,jpeg,png,gif,webp',
            ],
        ], [], [
            'titulo' => 'título',
            'materia' => 'materia',
            'estudiante' => 'estudiante',
            'descripcion' => 'descripción',
            'archivo' => 'archivo',
        ]);

        $file = $request->file('archivo');
        $path = $file->store('deberes', 'public');

        Deber::create([
            'titulo' => $data['titulo'],
            'materia' => $data['materia'],
            'estudiante' => $data['estudiante'],
            'descripcion' => $data['descripcion'] ?? null,
            'archivo' => $path,
            'nombre_original' => $file->getClientOriginalName(),
            'mime' => $file->getClientMimeType(),
            'tamano' => $file->getSize(),
        ]);

        return redirect()
            ->route('deberes.index')
            ->with('success', '¡Deber subido correctamente!');
    }

    public function show(Deber $deber): View
    {
        return view('deberes.show', compact('deber'));
    }

    public function download(Deber $deber): StreamedResponse
    {
        abort_unless(
            Storage::disk('public')->exists($deber->archivo),
            404,
            'El archivo ya no está disponible.'
        );

        return Storage::disk('public')->download($deber->archivo, $deber->nombre_original);
    }

    public function preview(Deber $deber): StreamedResponse
    {
        abort_unless(
            Storage::disk('public')->exists($deber->archivo),
            404,
            'El archivo ya no está disponible.'
        );

        return Storage::disk('public')->response($deber->archivo, $deber->nombre_original, [
            'Content-Disposition' => 'inline; filename="'.$deber->nombre_original.'"',
        ]);
    }

    public function destroy(Deber $deber): RedirectResponse
    {
        Storage::disk('public')->delete($deber->archivo);
        $deber->delete();

        return redirect()
            ->route('deberes.index')
            ->with('success', 'Deber eliminado correctamente.');
    }
}
