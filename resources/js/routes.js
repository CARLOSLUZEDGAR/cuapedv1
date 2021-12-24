import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

export default new Router ({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
       /* {
            path: '*',
            component: require('./components/Notfound.vue').default
        },
        {
            path: '/',
            component: require('./components/Content.vue').default
        },
        
        
        {
            path: '/personal',
            name: 'Personal',
            component: require('./components/Personal.vue').default
        },*/

        {
            path: '/listarColegios',
            component: require('./components/Colegio.vue').default
        },

        {
            path: '/listarEstudiantes',
            component: require('./components/Estudiante.vue').default
        },

        {
            path: '/designarEstudiantes',
            component: require('./components/DesignacionCurso.vue').default
        },

        {
            path: '/destinosPersonal/:d',
            //name: "nombre_component"
            name: 'DestinosPersonal',
            component: require('./components/DestinosPersonal.vue').default
        },
        /*{
            path: '/modal/:d',
            //name: "nombre_component"
            name: 'Modal',
            component: require('./components/Modal.vue').default
        }*/
    ]
})