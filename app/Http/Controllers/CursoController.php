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
}
