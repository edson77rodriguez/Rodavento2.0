<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Guia;
use App\Models\Asignar_Equipo;
use App\Models\Material;
use App\Models\User;

class Asignar_EquipoController extends Controller
{
    public function index()
    {
        $actividades=Actividad::all();
        $guias = Guia::all();
        $asignaciones = Asignar_Equipo::all();
        $materiales = Material::all();
        $user = auth()->user();
        $asignaciones = Asignar_Equipo::with(['guia.user'])->get();
        return view('asignar_equipos.index', compact('asignaciones', 'guias', 'materiales','actividades','user'));
    }

  // Guarda una nueva asignación
  public function store(Request $request)
  {
      // Validar los datos del formulario
      $validatedData = $request->validate([
          'material_id' => 'required|exists:materials,id',
          'guia_id' => 'required|exists:guias,id',
          'actividad_id' => 'required|exists:actividads,id',
          'fecha_programada' => 'required|date',
          'fecha_devolucion' => 'required|date',
      ]);
  
      try {
          // Intentar crear la asignación
          Asignar_Equipo::create($validatedData);
  
          // Redirigir con éxito si no hay errores
          return redirect()
              ->route('asignar_equipos.index')
              ->with('success', 'Asignación creada exitosamente');
      } catch (\Illuminate\Database\QueryException $e) {
          // Manejar el error generado por el disparador
          if ($e->getCode() === '45000') {
              // Detectar el mensaje del disparador
              $errorMessage = $e->getMessage();
  
              if (strpos($errorMessage, 'La fecha de devolución no puede ser anterior a la fecha programada.') !== false) {
                  return redirect()
                      ->back()
                      ->withErrors(['error' => 'La fecha de devolución no puede ser anterior a la fecha programada.'])
                      ->withInput();
              } elseif (strpos($errorMessage, 'El material está en mantenimiento') !== false) {
                  return redirect()
                      ->back()
                      ->withErrors(['error' => 'El material está en mantenimiento y no puede ser asignado.'])
                      ->withInput();
              }
          }
  
          // Manejar otros posibles errores de la base de datos
          return redirect()
              ->back()
              ->withErrors(['error' => 'Ocurrió un error inesperado. Inténtalo de nuevo.'])
              ->withInput();
      }
  }
  

     public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'material_id' => 'required|exists:materials,id',
             'guia_id' => 'required|exists:guias,id',
             'actividad_id' => 'required|exists:actividads,id',
             'fecha_programada' => 'required|date',
             'fecha_devolucion' => 'required|date',
        ]);

        $asignacion = Asignar_Equipo::find($id);
        $asignacion->update($request->all());

        return redirect()->route('asignar_equipos.index')->with('success', 'Asignación actualizada exitosamente');
    }
     // Elimina una asignación
   
     public function destroy(string $id)
     {
        $asignacion = Asignar_Equipo::findOrFail($id);
        $asignacion->delete();
 
        return redirect()->route('asignar_equipos.index')->with('success', 'Asignación eliminada exitosamente');
    }
}
