<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\PacientDosis;
use Illuminate\Http\Request;
use DB;
use Log;
use Maatwebsite\Excel\Excel;


class PacienteController extends Controller
{

    public function getPaciente() {
        return Paciente::where('departamento','=', 'LORETO')->get();
    }

    public function getGrupoRiego(){

        return 
            Paciente::join('grupo_riesgos as gr','pacients.grupo_riesgo_id', '=', 'gr.id')
                    ->select('gr.descripcion as descripcion',DB::raw("COUNT(pacients.id) as cantidad"))
                    ->where('pacients.departamento','=', 'LORETO')
                    ->groupBy('gr.id')
                    ->get();
    }

    public function getFrabricante(){

        return PacientDosis::select('p.departamento','pacient_dosic.fabricante', DB::raw("COUNT(pacient_dosic.paciente_id) as cantidad"))
                ->join('pacients as p','p.id','=','pacient_dosic.paciente_id') 
                ->where('p.departamento','=', 'LORETO')
                ->groupBy('pacient_dosic.fabricante','p.departamento')->get();

    }

    public function getVEdades(){
        return 
            Paciente::join('edad_minsas as em','pacients.edad_minsa_id', '=', 'em.id')
                    ->select('em.descripcion as descripcion',DB::raw("COUNT(pacients.id) as cantidad"))
                    ->where('pacients.departamento','=', 'LORETO')
                    ->groupBy('em.id')
                    ->get();
    }

    public function getGrupoRiesgoDosis(){

        return PacientDosis::join('pacients as p','pacient_dosic.paciente_id','=','p.id')
                    ->select('gr.id','gr.descripcion')
                    ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 1 
                                AND p.grupo_riesgo_id = gr.id
                                AND p.departamento = "LORETO"
                        ) as DosisUno')
                    ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 2 
                                AND p.grupo_riesgo_id = gr.id
                                AND p.departamento = "LORETO"
                        ) as DosisDos')
                    ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 3 
                                AND p.grupo_riesgo_id = gr.id
                                AND p.departamento = "LORETO"
                        ) as DosisTres')
                    ->join('grupo_riesgos as gr','p.grupo_riesgo_id','=','gr.id')
                    ->where('p.departamento','=', 'LORETO')
                    ->groupBy('gr.descripcion','gr.id')->get();                    
    }

    public function getGrupoSectorDosis(){

        return PacientDosis::join('pacients as p','pacient_dosic.paciente_id','=','p.id')
            ->select('s.id','s.descripcion')
            ->selectRaw('
                (
                    SELECT COUNT(pc.dosi_id)  
                    FROM pacient_dosic pc
                        INNER JOIN pacients p
                        ON pc.paciente_id = p.id
                        WHERE pc.dosi_id = 1 
                        AND p.sector_id = s.id
                        AND p.departamento = "LORETO"
                ) as DosisUno')
            ->selectRaw('
                    (
                        SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 2
                                AND p.sector_id = s.id
                                AND p.departamento = "LORETO"
                    ) as DosisDos')
            ->selectRaw('
                    (
                        SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                            INNER JOIN pacients p
                            ON pc.paciente_id = p.id
                            WHERE pc.dosi_id = 3
                            AND p.sector_id = s.id
                            AND p.departamento = "LORETO"
                    ) as DosisTres')
            ->join('sectors as s','p.sector_id','=','s.id')
            ->where('p.departamento','=', 'LORETO')
            ->groupBy('s.descripcion','s.id')->get();        

    }

    public function getFabricanteDosis(){

        return PacientDosis::select('pacient_dosic.fabricante as fab')
                ->selectRaw('
                    (
                        SELECT COUNT(dosi_id) FROM pacient_dosic 
                            INNER JOIN pacients pac
                            ON pacient_dosic.paciente_id = pac.id
                            WHERE dosi_id = 1 
                            AND  fabricante = fab
                            AND pac.departamento = "LORETO"
                    ) as DosisUno')

                ->selectRaw('
                    (
                        SELECT COUNT(dosi_id) FROM pacient_dosic 
                            INNER JOIN pacients pac
                            ON pacient_dosic.paciente_id = pac.id
                            WHERE dosi_id = 2 
                            AND  fabricante = fab
                            AND pac.departamento = "LORETO"
                    ) as DosisDos')
                ->selectRaw('
                    (
                        SELECT COUNT(dosi_id) FROM pacient_dosic 
                            INNER JOIN pacients pac
                            ON pacient_dosic.paciente_id = pac.id
                            WHERE dosi_id = 3 
                            AND  fabricante = fab
                            AND pac.departamento = "LORETO"
                    ) as DosisTres')
                
                ->join('pacients as p','p.id','=','pacient_dosic.paciente_id')
                ->where('p.departamento','=',"LORETO")
                ->groupBy('fab','p.departamento')->get();        
    }

    public function getProvinciaDosis(Request $request){

        if($request->f_inicio && $request->f_fin) {

            return PacientDosis::join('pacients as pac','pacient_dosic.paciente_id','=','pac.id')
                ->select('pac.departamento','pac.provincia')
                ->selectRaw('
                    (
                        SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                            INNER JOIN pacients p
                            ON pc.paciente_id = p.id
                            WHERE pc.dosi_id = 1 
                            AND p.provincia = pac.provincia
                            AND p.departamento = "LORETO"
                    ) as DosisUno')
                ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 2 
                                AND p.provincia = pac.provincia
                                AND p.departamento = "LORETO"
                        ) as DosisDos')
                ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 3 
                                AND p.provincia = pac.provincia
                                AND p.departamento = "LORETO"
                        ) as DosisTres')
                ->groupBy('pac.provincia')
                ->where('pacient_dosic.fecha_vacunacion', '>=', $request->f_inicio)
                ->where('pacient_dosic.fecha_vacunacion', '<=', $request->f_fin)
                ->where('pac.departamento','=', 'LORETO')
                ->get(); 
        }   

        return PacientDosis::join('pacients as pac','pacient_dosic.paciente_id','=','pac.id')
                ->select('pac.departamento','pac.provincia')
                ->selectRaw('
                    (
                        SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                            INNER JOIN pacients p
                            ON pc.paciente_id = p.id
                            WHERE pc.dosi_id = 1 
                            AND p.provincia = pac.provincia
                            AND p.departamento = "LORETO"
                    ) as DosisUno')
                ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 2 
                                AND p.provincia = pac.provincia
                                AND p.departamento = "LORETO"
                        ) as DosisDos')
                ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 3 
                                AND p.provincia = pac.provincia
                                AND p.departamento = "LORETO"
                        ) as DosisTres')
                ->where('pac.departamento','=', 'LORETO')
                ->groupBy('pac.departamento','pac.provincia')->get();       
    }

    public function getDistritosDosis(){

        return PacientDosis::join('pacients as pac','pacient_dosic.paciente_id','=','pac.id')
                    ->select('pac.departamento','pac.provincia','pac.distrito')
                    ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 1 
                                AND p.distrito = pac.distrito
                                AND p.departamento = "LORETO"
                        ) as DosisUno')
                    ->selectRaw('
                            (
                                SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 2 
                                    AND p.distrito = pac.distrito
                                    AND p.departamento = "LORETO"
                            ) as DosisDos')
                    ->selectRaw('
                            (
                                SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 3 
                                    AND p.distrito = pac.distrito
                                    AND p.departamento = "LORETO"
                            ) as DosisTres')

                    ->where('pac.departamento','=', 'LORETO')
                    ->groupBy('pac.departamento','pac.distrito', 'pac.provincia')->get();       
    }

    public function getRezagados(){
        return PacientDosis::join('pacients as pac','pacient_dosic.paciente_id','=','pac.id')
        ->select('pac.provincia')
        ->selectRaw('
            (
                SELECT COUNT(pc.dosi_id)  
                    FROM pacient_dosic pc
                    INNER JOIN pacients p
                    ON pc.paciente_id = p.id
                    WHERE pc.dosi_id = 3 
                    AND p.provincia = pac.provincia
                    AND pc.fabricante = "SINOPHARM"
            ) as SINOPHARM')
        ->selectRaw('
                (
                    SELECT COUNT(pc.dosi_id)  
                        FROM pacient_dosic pc
                        INNER JOIN pacients p
                        ON pc.paciente_id = p.id
                        WHERE pc.dosi_id = 3
                        AND p.provincia = pac.provincia
                        AND pc.fabricante = "PFIZER"
                ) as PFIZER')
        ->selectRaw('
                (
                    SELECT COUNT(pc.dosi_id)  
                        FROM pacient_dosic pc
                        INNER JOIN pacients p
                        ON pc.paciente_id = p.id
                        WHERE pc.dosi_id = 3 
                        AND p.provincia = pac.provincia
                        AND pc.fabricante = "ASTRAZENECA"
                ) as ASTRAZENECA')

        ->selectRaw('
            (
                (
                    SELECT COUNT(pc.dosi_id)  
                    FROM pacient_dosic pc
                    INNER JOIN pacients p
                    ON pc.paciente_id = p.id
                    WHERE pc.dosi_id = 3 
                    AND p.provincia = pac.provincia
                    AND pc.fabricante = "SINOPHARM"
                )
                +
                (
                    SELECT COUNT(pc.dosi_id)  
                        FROM pacient_dosic pc
                        INNER JOIN pacients p
                        ON pc.paciente_id = p.id
                        WHERE pc.dosi_id = 3
                        AND p.provincia = pac.provincia
                        AND pc.fabricante = "PFIZER"
                )
                +
                (
                    SELECT COUNT(pc.dosi_id)  
                    FROM pacient_dosic pc
                    INNER JOIN pacients p
                    ON pc.paciente_id = p.id
                    WHERE pc.dosi_id = 3 
                    AND p.provincia = pac.provincia
                    AND pc.fabricante = "ASTRAZENECA"
                )
            ) as Total')
        ->groupBy('pac.provincia')->get();       
    }

    
}
