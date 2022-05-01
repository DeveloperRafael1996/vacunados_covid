<?php

namespace App\Imports;

use App\Models\Paciente;
use App\Models\Sector;
use App\Models\Grupo;
use App\Models\Edad;
use Maatwebsite\Excel\Concerns\{Importable, ToModel, WithHeadingRow};
use App\Models\PacientDosis;
use DB;

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
                        $pacient->fecha_vacunacion =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_primera_dosis'])->format('Y-m-d');
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
                        $pacient->fecha_vacunacion =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_segunda_dosis'])->format('Y-m-d');
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
                        $pacient->fecha_vacunacion =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_tercera_dosis'])->format('Y-m-d');
                        $pacient->save();
                    }
                }

                return $paciente;
            }
            else
            {

                //SECTOR
                $sector = DB::table('sectors')->where('descripcion','=',$row["sector"])->first();

                if(!$sector) {
                    $sector = new Sector();
                    $sector->descripcion = $row["sector"];
                    $sector->save();
                }

                //GRUPO RIESGO
                $grupo = DB::table('grupo_riesgos')->where('descripcion','=',$row["grupo"])->first();
                
                if(!$grupo) {
                    $grupo = new Grupo();
                    $grupo->descripcion = $row["grupo"];
                    $grupo->save();
                }

                //EDADES MINSA
                $edad = DB::table('edad_minsas')->where('descripcion','=',$row["edades"])->first();
                
                if(!$edad) {
                    $edad = new Edad();
                    $edad->descripcion = $row["edades"];
                    $edad->save();
                }

                $pacient = new Paciente;
                $pacient->name_paciente =$row["name"];
                $pacient->nro_documento =$row["nro_documento"];
                $pacient->sector_id =$sector->id;
                $pacient->grupo_riesgo_id =$grupo->id;
                $pacient->edad_minsa_id = $edad->id;
                $pacient->fecha_nacimiento=  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_nacimiento'])->format('Y-m-d');
                $pacient->genero =$row["genero"];
                $pacient->ubigeo =$row["ubigeo"];
                $pacient->departamento =$row["departamento"];
                $pacient->provincia =$row["provincia"];
                $pacient->distrito =$row["distrito"];
                $pacient->fecha_vacunacion ="2022-12-12";

                $pacient->save();
                return $pacient;
            }
        }
    }
}
