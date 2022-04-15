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
       
        <main class="main">

            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> IMPORTAR EXCEL
                    </div>
                    <div class="card-body">
                        <form action="{{route('import.excel')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        @csrf
                                            @if(Session::has('message'))
                                                <p>{{Session::get('message')}}</p>
                                            @endif

                                        <input type="file" id="file" name="file" class="form-control" placeholder="File">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> IMPORTAR</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
        </main>

    </template>

@endsection