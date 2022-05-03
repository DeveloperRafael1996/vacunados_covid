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
                    <i class="fa fa-align-justify"></i> PROVINCIA REZAGADOS
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <button type="submit" @click="get_rezagados()" class="btn btn-primary"><i class="fa fa-search"></i> VER</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>PROVINCIA</th>
                                <th>CANTIDAD</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item ,index) in rezagados" :key="index">
                                <td v-text="item.provincia"></td>
                                <td v-text="item.CANTIDAD"></td>
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
            rezagados:[]
        }
    },  
    methods:{
        get_rezagados(){
            axios.get('rezagados-dosis')
                .then((response) => {
                     this.rezagados = response.data;
                });
        }, 
        
    },
    mounted() {
        console.log('Component mounted.');
    }
}
</script>