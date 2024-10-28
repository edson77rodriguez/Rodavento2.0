<?php

namespace App\Http\Controllers;

use App\Models\Asignar_guia;
use App\Models\User;
use App\Models\Habilidad;
use Illuminate\Http\Request;

class AsignarGuiaController extends Controller
{
     // Muestra la vista con las habilidades asignadas
     public function index()
     {
         $asignarGuias = Asignar_guia::with(['user', 'habilidad'])->get();
         $usuarios = User::where('rol_id', 3)->get(); // Obtener solo usuarios con role_id == 3
         $habilidades =Habilidad::all();
         return view('asignar_guias.index', compact('asignarGuias', 'usuarios','habilidades'));
     }
 
     // Guardar una nueva asignación de guía
     public function store(Request $request)
     {
         $request->validate([
             'user_id' => 'required|exists:users,id',
             'habilidad_id' => 'required|exists:habilidads,id',
             'fecha_emsion' => 'required|date',
             'fecha_vencimiento' => 'required|date',
         ]);
 
         Asignar_guia::create($request->all());
         return redirect()->route('asignar_guias.index')->with('success', 'Guía asignada con éxito.');
     }
 
     // Actualizar una asignación de guía
     public function update(Request $request, Asignar_guia $asignarGuia)
     {
         $request->validate([
             'user_id' => 'required|exists:users,id',
             'habilidad_id' => 'required|exists:habilidads,id',
             'fecha_emsion' => 'required|date',
             'fecha_vencimiento' => 'required|date',
         ]);
 
         $asignarGuia->update($request->all());
         return redirect()->route('asignar_guias.index')->with('success', 'Asignación actualizada con éxito.');
     }
 
     // Eliminar una asignación de guía
     public function destroy(Asignar_guia $asignarGuia)
     {
         $asignarGuia->delete();
         return redirect()->route('asignar_guias.index')->with('success', 'Asignación eliminada con éxito.');
     }
     
}
