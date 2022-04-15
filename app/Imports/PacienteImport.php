<?php

namespace App\Imports;

use App\Models\Paciente;
use Maatwebsite\Excel\Concerns\ToModel;

class PacienteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Paciente([
            'name_paciente' =>$row[0],
            'nro_documento' =>$row[1],
            'sector_id' =>$row[2],
            'grupo_riesgo_id' =>$row[3],
            'edad_minsa_id' =>$row[4],
            'fecha_nacimiento' =>$row[5],
            'genero' =>$row[6],
            'ubigeo' =>$row[7],
            'departamento' =>$row[8],
            'provincia' =>$row[9],
            'distrito' =>$row[10],
            'fecha_vacunacion' =>$row[11]
        ]);
    }
}
