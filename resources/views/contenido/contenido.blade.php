@extends('principal')
@section('contenido')
    <template v-if="menu==1">
        <paciente></paciente>
    </template>

    <template v-if="menu==2">
        <reporte></reporte>
    </template>

@endsection