@extends('principal')
@section('contenido')
    <template v-if="menu==1">
        <grupo-riesgo></grupo-riesgo>
    </template>

    <template v-if="menu==2">
        <fabricante></fabricante>
    </template>

    <template v-if="menu==3">
        <edades></edades>
    </template>

@endsection