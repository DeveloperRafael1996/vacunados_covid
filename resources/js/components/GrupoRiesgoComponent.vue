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
                    <i class="fa fa-align-justify"></i> GRUPO RIESGO VACUNADOS
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <button type="submit" @click="get_grupo_riesgo()" class="btn btn-primary"><i class="fa fa-search"></i> VER</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>GRUPO RIESGO</th>
                                <th>CANTIDAD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item ,index) in grupoRiesgo" :key="index">
                                <td v-text="item.descripcion"></td>
                                <td v-text="item.cantidad"></td>
                            </tr>        
                            
                            <tr>
                                <td>TOTAL</td>
                                <td>{{total}}</td>
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
            grupoRiesgo:[],
            total: 0
        }
    },  
    methods:{
        get_grupo_riesgo(){
            axios.get('grupo-riesgo')
                .then((response) => {
                    this.grupoRiesgo = response.data;
                    this.total = this.grupoRiesgo.reduce((acc, r) => {
                        return acc + parseFloat(r.cantidad);
                    }, 0);
                });
        }
    },
    mounted() {
        console.log('Component mounted.');
    }
}
</script>