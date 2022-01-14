<?php

namespace App\Http\Controllers;

use App\EstudianteCursos;
use App\Estudiantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    public function index (Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar=='')
        {
            $estudiante = DB::table('estudiantes')
                        ->select(
                            'estudiantes.id',
                            'estudiantes.est_rude',
                            'estudiantes.est_paterno',
                            'estudiantes.est_materno',
                            'estudiantes.est_nombre',
                            'estudiantes.est_ci',
                            'estudiantes.est_expedido',
                            'estudiantes.est_estado',
                            'estudiantes.est_observacion'
                        )
                        ->orderBy('estudiantes.est_paterno','asc')
                        ->take(1)
                        ->paginate(10);
        }
        else
        {
            $estudiante = DB::table('estudiantes')
                        ->select(
                            'estudiantes.id',
                            'estudiantes.est_rude',
                            'estudiantes.est_paterno',
                            'estudiantes.est_materno',
                            'estudiantes.est_nombre',
                            'estudiantes.est_ci',
                            'estudiantes.est_expedido',
                            'estudiantes.est_estado',
                            'estudiantes.est_observacion'
                        )
                        ->where($criterio,'like','%'.$buscar.'%')
                        ->orderBy('estudiantes.est_paterno','asc')
                        ->take(1)
                        ->paginate(10);
        }
        return [
            'pagination' => [
                'total'         => $estudiante->total(),
                'current_page'  => $estudiante->currentPage(),
                'per_page'      => $estudiante->perPage(),
                'last_page'     => $estudiante->lastPage(),
                'from'          => $estudiante->firstItem(),
                'to'            => $estudiante->lastItem(),
            
            ],
            'estudiante' => $estudiante
        ];

        //return response()->json($estudiante);
    }

    public function registrarEstudiante(Request $request)
    {
        $estudiante = Estudiantes::create([
            //'CAMPO DE LA TABLA' => $request->NOMBRE Q VIENE DE LA VISTA
            'est_rude' => $request->est_rude,
            'est_paterno' => $request->est_paterno,
            'est_materno' => $request->est_materno,
            'est_nombre' => $request->est_nombre,
            'est_ci' => $request->est_ci,
            'est_expedido' => $request->est_expedido,
            'est_estado' => '1',
            'est_observacion' => $request->est_observacion,
            'est_sysuser' => 'ADMIN',   
        ]);
        $estudiante_curso = EstudianteCursos::create([
            'cod_est' => $estudiante->id,
            // 'cod_col' => $request->desig_col,
            'cod_col' => 1,
            'cod_nivel' => $request->cod_nivel,
            'cod_curso' => $request->cod_curso,
            'paralelo' => $request->paralelo,
            'gestion' => $request->gestion,
            'estc_estado' => 1,
            'estc_flag' => 1,
            'estc_observacion' => $request->est_observacion,
            'estc_sysuser' => 'ADMIN',
        ]);
    }

    public function updateEstudiante(Request $request)
    {
        $estudiante = Estudiantes::where('id',$request->est_id)
                    ->first();
        $estudiante -> update([
            'est_rude' => $request->est_rude,
            'est_paterno' => $request->est_paterno,
            'est_materno' => $request->est_materno,
            'est_nombre' => $request->est_nombre,
            'est_ci' => $request->est_ci,
            'est_expedido' => $request->est_expedido,
            'est_observacion' => $request->est_observacion,
        ]);
    }
}
