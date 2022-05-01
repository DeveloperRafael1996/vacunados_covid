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

    <template v-if="menu==4">
        <grupo-riesgo-dosis></grupo-riesgo-dosis>
    </template>

    <template v-if="menu==5">
        <sector-dosis></sector-dosis>
    </template>

    <template v-if="menu==6">
        <fabricante-dosis></fabricante-dosis>
    </template>

    <template v-if="menu==7">
        <paciente-report></paciente-report>
    </template>

    <template v-if="menu==8">
        <distrito-report></distrito-report>
    </template>

    <template v-if="menu==9">
        <provincia-report></provincia-report>
    </template>
    
@endsection