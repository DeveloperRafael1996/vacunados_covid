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
                    <i class="fa fa-align-justify"></i> DISTRITO POR DOSIS
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <button type="submit" @click="get_distrito()" class="btn btn-primary"><i class="fa fa-search"></i> VER</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>DISTRITO</th>
                                <th>1RDA DOSIS</th>
                                <th>2DA DOSIS</th>
                                <th>3RA DOSIS</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item ,index) in distrito" :key="index">
                                <td v-text="item.distrito"></td>
                                <td v-text="item.DosisUno"></td>
                                <td v-text="item.DosisDos"></td>
                                <td v-text="item.DosisTres"></td>
                               
                            </tr> 

                            <tr>
                                <td>TOTAL</td>
                                <td>{{dosis_1}}</td>
                                <td>{{dosis_2}}</td>
                                <td>{{dosis_3}}</td>
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
            distrito:[],
            dosis_1:0,
            dosis_2:0,
            dosis_3:0,
        }
    },  
    methods:{
        get_distrito(){
            axios.get('distrito-dosis')
                .then((response) => {
                     this.distrito = response.data;

                        this.dosis_1 = this.distrito.reduce((acc, r) => {
                            return acc + parseFloat(r.DosisUno);
                        }, 0);

                        this.dosis_2 = this.distrito.reduce((acc, r) => {
                            return acc + parseFloat(r.DosisDos);
                        }, 0);

                        this.dosis_3 = this.distrito.reduce((acc, r) => {
                            return acc + parseFloat(r.DosisTres);
                        }, 0);
                });
        }
    },
    mounted() {
        console.log('Component mounted.');
    }
}
</script>