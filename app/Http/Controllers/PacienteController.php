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

    public function getPaciente(){

        return 
            Paciente::all();
    }

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
                        ) as DosisUno')
                    ->selectRaw('
                            (
                                SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 2 
                                    AND p.grupo_riesgo_id = gr.id
                            ) as DosisDos')
                    ->selectRaw('
                            (
                                SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 3 
                                    AND p.grupo_riesgo_id = gr.id
                            ) as DosisTres')


                    ->selectRaw('
                            (
                                (
                                    SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 1 
                                    AND p.grupo_riesgo_id = gr.id
                                )
                                +
                                (
                                    SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 2 
                                    AND p.grupo_riesgo_id = gr.id
                                )
                                +
                                (
                                    SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 3 
                                    AND p.grupo_riesgo_id = gr.id
                                )
                            ) as Total')
                    ->join('grupo_riesgos as gr','p.grupo_riesgo_id','=','gr.id')
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
                ) as DosisUno')
            ->selectRaw('
                    (
                        SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 2
                                AND p.sector_id = s.id
                    ) as DosisDos')
            ->selectRaw('
                    (
                        SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                            INNER JOIN pacients p
                            ON pc.paciente_id = p.id
                            WHERE pc.dosi_id = 3
                            AND p.sector_id = s.id
                    ) as DosisTres')

            ->selectRaw('
                    (
                        (
                            SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 1 
                                AND p.sector_id = s.id
                        )
                        +
                        (
                            SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 2 
                                AND p.sector_id = s.id
                        )
                        +
                        (
                            SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 3 
                                AND p.sector_id = s.id
                        )
                    ) as Total')

            ->join('sectors as s','p.sector_id','=','s.id')
            ->groupBy('s.descripcion','s.id')->get();        

    }

    public function getFabricanteDosis(){

        return PacientDosis::select('pacient_dosic.fabricante as fab')
                ->selectRaw('
                    (
                        SELECT COUNT(dosi_id) FROM pacient_dosic 
                            WHERE dosi_id = 1 
                            AND  fabricante = fab
                    ) as DosisUno')

                ->selectRaw('
                    (
                        SELECT COUNT(dosi_id) FROM pacient_dosic 
                            WHERE dosi_id = 2 
                            AND  fabricante = fab
                    ) as DosisDos')
                ->selectRaw('
                    (
                        SELECT COUNT(dosi_id) FROM pacient_dosic 
                            WHERE dosi_id = 3 
                            AND  fabricante = fab
                    ) as DosisTres')
                ->selectRaw('
                    (
                        (  
                            SELECT COUNT(dosi_id) FROM pacient_dosic 
                                WHERE dosi_id = 1 
                                AND  fabricante = fab
                        ) 
                        +
                        (
                            SELECT COUNT(dosi_id) FROM pacient_dosic 
                                WHERE dosi_id = 2
                                AND  fabricante = fab
                        )
                        +
                        (
                            SELECT COUNT(dosi_id) FROM pacient_dosic 
                                WHERE dosi_id = 3
                                AND  fabricante = fab
                        )

                    ) as Total')
            
                ->groupBy('fab')->get();        
    }

    public function getProvinciaDosis(){
        return PacientDosis::join('pacients as pac','pacient_dosic.paciente_id','=','pac.id')
                ->select('pac.provincia')
                ->selectRaw('
                    (
                        SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                            INNER JOIN pacients p
                            ON pc.paciente_id = p.id
                            WHERE pc.dosi_id = 1 
                            AND p.provincia = pac.provincia
                    ) as DosisUno')
                ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 2 
                                AND p.provincia = pac.provincia
                        ) as DosisDos')
                ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 3 
                                AND p.provincia = pac.provincia
                        ) as DosisTres')

                ->selectRaw('
                    (
                        (
                            SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                            INNER JOIN pacients p
                            ON pc.paciente_id = p.id
                            WHERE pc.dosi_id = 1 
                            AND p.provincia = pac.provincia
                        )
                        +
                        (
                            SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                            INNER JOIN pacients p
                            ON pc.paciente_id = p.id
                            WHERE pc.dosi_id = 2 
                            AND p.provincia = pac.provincia
                        )
                        +
                        (
                            SELECT COUNT(pc.dosi_id)  
                            FROM pacient_dosic pc
                            INNER JOIN pacients p
                            ON pc.paciente_id = p.id
                            WHERE pc.dosi_id = 3 
                            AND p.provincia = pac.provincia
                        )
                    ) as Total')
                ->groupBy('pac.provincia')->get();       
    }

    public function getDistritosDosis(){

        return PacientDosis::join('pacients as pac','pacient_dosic.paciente_id','=','pac.id')
                    ->select('pac.provincia','pac.distrito')
                    ->selectRaw('
                        (
                            SELECT COUNT(pc.dosi_id)  
                                FROM pacient_dosic pc
                                INNER JOIN pacients p
                                ON pc.paciente_id = p.id
                                WHERE pc.dosi_id = 1 
                                AND p.distrito = pac.distrito
                        ) as DosisUno')
                    ->selectRaw('
                            (
                                SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 2 
                                    AND p.distrito = pac.distrito
                            ) as DosisDos')
                    ->selectRaw('
                            (
                                SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 3 
                                    AND p.distrito = pac.distrito
                            ) as DosisTres')

                    ->selectRaw('
                            (
                                (
                                    SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 1 
                                    AND p.distrito = pac.distrito
                                )
                                +
                                (
                                    SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 2 
                                    AND p.distrito = pac.distrito
                                )
                                +
                                (
                                    SELECT COUNT(pc.dosi_id)  
                                    FROM pacient_dosic pc
                                    INNER JOIN pacients p
                                    ON pc.paciente_id = p.id
                                    WHERE pc.dosi_id = 3 
                                    AND p.distrito = pac.distrito
                                )
                            ) as Total')
                    ->groupBy('pac.distrito', 'pac.provincia')->get();       
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
