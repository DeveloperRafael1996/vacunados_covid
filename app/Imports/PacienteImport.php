<?php

namespace App\Imports;

use App\Models\Paciente;
use Maatwebsite\Excel\Concerns\{Importable, ToModel, WithHeadingRow};
use App\Models\PacientDosis;

class PacienteImport implements ToModel,WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return Paciente|null
     */


    public function model(array $row)
    {
        if($row["name"]!=null){

            $paciente = Paciente::where('nro_documento', $row["nro_documento"])->first();

            if($paciente) {
              
                if($row["primera_dosis"]!=null){

                    $dosis = PacientDosis::where('paciente_id',$paciente->id)
                                         ->where('dosi_id',1)->first();

                    if($dosis==null){

                        $pacient = new PacientDosis;
                        $pacient->paciente_id = $paciente->id;
                        $pacient->dosi_id = 1;
                        $pacient->fabricante = $row["fab_primera_dosis"];
                        $pacient->fecha_vacunacion ="2022-12-21";
                        $pacient->save();
                    }
                }

                if($row["seg_dosis"]!=null){

                    $dosis = PacientDosis::where('paciente_id',$paciente->id)
                                        ->where('dosi_id',2)->first();

                    if($dosis==null){
                        $pacient = new PacientDosis;
                        $pacient->paciente_id = $paciente->id;
                        $pacient->dosi_id = 2;
                        $pacient->fabricante = $row["fab_segunda_dosis"];
                        $pacient->fecha_vacunacion ="2022-12-21";
                        $pacient->save();
                    }


                    
                }

                if($row["tercera_dosis"]!=null){

                    $dosis = PacientDosis::where('paciente_id',$paciente->id)
                                         ->where('dosi_id',3)->first();

                    if($dosis==null){
                        $pacient = new PacientDosis;
                        $pacient->paciente_id = $paciente->id;
                        $pacient->dosi_id = 3;
                        $pacient->fabricante = $row["fab_tercera_dosis"];
                        $pacient->fecha_vacunacion ="2022-12-21";
                        $pacient->save();
                    }
                }

                return $paciente;
            }
            else
            {
                $pacient = new Paciente;
                $pacient->name_paciente =$row["name"];
                $pacient->nro_documento =$row["nro_documento"];
                $pacient->sector_id =$row["sector_id"];
                $pacient->grupo_riesgo_id =$row["grupo_riesgo_id"];
                $pacient->edad_minsa_id =$row["edad_minsa_id"];
                $pacient->fecha_nacimiento ="2022-12-21";
                $pacient->genero =$row["genero"];
                $pacient->ubigeo =$row["ubigeo"];
                $pacient->departamento =$row["departamento"];
                $pacient->provincia =$row["provincia"];
                $pacient->distrito =$row["distrito"];
                $pacient->fecha_vacunacion ="2022-12-21";

                $pacient->save();
                return $pacient;
            }
        }
    }
}
