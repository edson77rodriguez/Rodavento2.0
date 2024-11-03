<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Material;
use App\Models\T_Mantenimiento;
use App\Models\Encargado;
use Illuminate\Http\Request;
class MantenimientoController extends Controller
{
    // Muestra la lista de mantenimientos
    public function index()
    {
        $mantenimientos = Mantenimiento::all();
        $materiales = Material::all();
        $tipos = T_Mantenimiento::all();
        $encargados = Encargado::all();

        return view('mantenimientos.index', compact('mantenimientos', 'materiales', 'tipos', 'encargados'));
    }

    // Guarda un nuevo mantenimiento
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'material_id' => 'required|exists:materials,id',
            'fecha_mantenimiento' => 'required|date',
            'tipo_m' => 'required|exists:t__mantenimientos,id',
            'observaciones' => 'required|string',
            'encargado_id' => 'required|exists:encargados,id',
        ]);

        Mantenimiento::create($validatedData);


        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento creado exitosamente');
    }

    // Actualiza un mantenimiento existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_mantenimiento' => 'required|date',
            'tipo_m' => 'required|exists:t__mantenimientos,id',
            'encargado_id' => 'required|exists:encargados,id',
        ]);

        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->update([
            'fecha_mantenimiento' => $request->fecha_mantenimiento,
            'tipo_m' => $request->tipo_m,
            'encargado_id' => $request->encargado_id,
        ]);

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento actualizado exitosamente');
    }

    // Elimina un mantenimiento
    public function destroy($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento eliminado exitosamente');
    }
}
