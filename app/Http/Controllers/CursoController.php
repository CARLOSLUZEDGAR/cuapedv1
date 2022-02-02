<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CursoController extends Controller
{
    public function selectCurso(Request $request){
        // if(!$request->ajax()) return view('/');
        $curso = DB::table('cursos')
        ->select('id','curso_sigla')
        ->where('curso_estado',1)
        ->orderBy('id','asc')
        ->get();
        return response()->json($curso);
    }

    public function cursosColegio(Request $request){
        // if(!$request->ajax()) return view('/');
        $colegio = $request->col_id;

        $curso_colegios = DB::table('estudiante_cursos as ec')
                        ->join('niveles as n','n.id','ec.cod_nivel')
                        ->join('cursos as c','c.id','ec.cod_curso')
                        ->select('ec.cod_col',
                                'n.nivel_abreviatura',
                                'c.curso_sigla',
                                'paralelo',
                                DB::raw('count(paralelo) as cantestcur'))
                        ->where('estc_estado',1)
                        ->where('cod_col',$colegio)
                        ->groupBy('ec.cod_col')
                        ->groupBy('n.nivel_abreviatura')
                        ->groupBy('c.curso_sigla')
                        ->groupBy('paralelo')
                        ->orderBy('n.nivel_abreviatura','asc')
                        ->orderBy('c.curso_sigla','asc')
                        ->orderBy('paralelo','asc')
                        ->get();
        return response()->json($curso_colegios);
    }
}
