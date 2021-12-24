<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NivelController extends Controller
{
    public function selectNivel(Request $request){
        // if(!$request->ajax()) return view('/');
        $nivel = DB::table('niveles')
        ->select('id','nivel_abreviatura')
        ->where('nivel_estado',1)
        ->orderBy('id','asc')
        ->get();
        return response()->json($nivel);
    }
}
