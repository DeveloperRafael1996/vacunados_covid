/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('paciente', require('./components/PacienteComponet.vue').default);
Vue.component('grupo-riesgo', require('./components/GrupoRiesgoComponent.vue').default);
Vue.component('fabricante', require('./components/FabricanteComponent.vue').default);
Vue.component('reporte', require('./components/ReportesEdadesComponet.vue').default);
Vue.component('edades', require('./components/EdadesComponent.vue').default);
Vue.component('grupo-riesgo-dosis', require('./components/DosisGRComponent.vue').default);
Vue.component('sector-dosis', require('./components/SectorDosisComponent.vue').default);






/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }
});
