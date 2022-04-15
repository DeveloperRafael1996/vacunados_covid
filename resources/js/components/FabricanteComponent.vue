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
                    <i class="fa fa-align-justify"></i> FABRICANTES VACUNAS
                    
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <button type="submit" @click="get_fabricante()" class="btn btn-primary"><i class="fa fa-search"></i> VER</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>FABRICANTE</th>
                                <th>CANTIDAD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item ,index) in fabricante" :key="index">
                                <td v-text="item.fabricante"></td>
                                <td v-text="item.cantidad"></td>
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
            fabricante:[]
        }
    },  
    methods:{
        get_fabricante(){
            axios.get('fabricante')
                .then((response) => {
                     this.fabricante = response.data;
                });
        }
    },
    mounted() {
        console.log('Component mounted.');
        //this.get_pacientes();
    }
}
</script>