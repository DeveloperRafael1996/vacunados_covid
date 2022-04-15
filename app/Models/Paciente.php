<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacients';

    protected $fillable = ['name_paciente', 'nro_documento', 'sector_id', 'grupo_riesgo_id', 'edad_minsa_id', 'fecha_nacimiento', 'genero','ubigeo','departamento','provincia','distrito','fecha_vacunacion'];

}
