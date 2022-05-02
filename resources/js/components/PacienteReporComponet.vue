<template>
    <main class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>PACIENTES VACUNADOS
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <button type="submit" @click="get_paciente()" class="btn btn-primary"><i class="fa fa-search"></i> VER</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>DOCUMENTO</th>
                                <th>SEXO</th>
                                <th>PROVINCIA</th>
                                <th>DISTRITO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item ,index) in paciente" :key="index">
                                <td v-text="item.name_paciente"></td>
                                <td v-text="item.nro_documento"></td>
                                <td v-text="item.genero"></td>
                                <td v-text="item.provincia"></td>
                                <td v-text="item.distrito"></td>
                            </tr>                                
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        
    </main>
</template>

<script>
export default {
    data() {
        return {
            paciente:[]
        }
    },  
    methods:{
        get_paciente(){
            axios.get('paciente')
                .then((response) => {
                     this.paciente = response.data;
                });
        }
    },
    mounted() {
        //console.log('Component mounted.');
        this.get_paciente();
    }
}
</script>