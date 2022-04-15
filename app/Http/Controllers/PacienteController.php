<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\PacientDosis;
use Illuminate\Http\Request;
use DB;

class PacienteController extends Controller
{
    public function getGrupoRiego(){

        return 
            Paciente::join('grupo_riesgos as gr','pacients.grupo_riesgo_id', '=', 'gr.id')
                    ->select('gr.descripcion as descripcion',DB::raw("COUNT(pacients.id) as cantidad"))
                    ->groupBy('gr.id')
                    ->get();
    }

    public function getFrabricante(){

        return PacientDosis::select('pacient_dosic.fabricante', DB::raw("COUNT(pacient_dosic.paciente_id) as cantidad")) 
                ->groupBy('pacient_dosic.fabricante')->get();         
    }

    public function getVEdades(){
        return 
            Paciente::join('edad_minsas as em','pacients.edad_minsa_id', '=', 'em.id')
                    ->select('em.descripcion as descripcion',DB::raw("COUNT(pacients.id) as cantidad"))
                    ->groupBy('em.id')
                    ->get();
    }
}
