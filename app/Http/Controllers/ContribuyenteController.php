<?php

namespace App\Http\Controllers;

use App\Models\Contribuyente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContribuyenteController extends \Illuminate\Routing\Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $contribuyentes = Contribuyente::orderBy('id')->paginate(10);
    return view('index', compact('contribuyentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    return view('contribuyentes.form');
    }        

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $datos = $this->validarYPreparar($request);

    Contribuyente::create($datos);

    return redirect()
        ->route('contribuyentes.index')
        ->with('success', 'Contribuyente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contribuyente $contribuyente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contribuyente $contribuyente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contribuyente $contribuyente)
    {
    
    $datos = $this->validarYPreparar($request, $contribuyente);

    $contribuyente->update($datos);

    return redirect()
        ->route('contribuyentes.index')
        ->with('success', 'Contribuyente actualizado correctamente.');
    }
private function validarYPreparar(
    Request $request,
    ?Contribuyente $contribuyente = null
): array
{
    $esNit = strtoupper(trim((string) $request->input('tipo_documento'))) === 'NIT';

    $reglas = [
        'tipo_documento' => ['required', 'string', 'max:28'],
        'documento' => ['required','string','max:30', Rule::unique('contribuyentes', 'documento')
        ->ignore($contribuyente?->id),],
        'direccion' => ['required', 'string', 'max:180'],
        'telefono' => ['required', 'string', 'max:20'],
        'celular' => ['required', 'string', 'max:20'],
        'email' => ['required', 'string', 'email:rfc', 'max:130'],
        'usuario' => ['required', 'string', 'max:50'],
    ];

    if ($esNit) {
        $reglas['razon_social'] = ['required', 'string', 'max:201'];
    } else {
        $reglas['nombre'] = ['required', 'string', 'max:100'];
        $reglas['apellidos'] = ['required', 'string', 'max:100'];
    }

    $datos = $request->validate($reglas);

    if ($esNit) {
        $palabras = preg_split(
            '/\s+/',
            trim($datos['razon_social']),
            -1,
            PREG_SPLIT_NO_EMPTY
        );

        if (count($palabras) >= 3) {
            $nombre = array_slice($palabras, 0, -2);
            $apellidos = array_slice($palabras, -2);
        } elseif (count($palabras) === 2) {
            $nombre = [$palabras[0]];
            $apellidos = [$palabras[1]];
        } else {
            $nombre = $palabras;
            $apellidos = [];
        }

        $datos['nombre'] = implode(' ', $nombre);
        $datos['apellidos'] = implode(' ', $apellidos);
        unset($datos['razon_social']);

        Validator::make($datos, [
            'nombre' => ['required', 'string', 'max:100'],
            'apellidos' => ['present', 'string', 'max:100'],
        ])->validate();
    }

    return $datos;
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contribuyente $contribuyente)
    {
        //
    }

}
