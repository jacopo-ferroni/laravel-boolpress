import Vue from 'vue';
import VueRouter from 'vue-router';

// componenti per rotta

// attivazione router in vue
Vue.use(VueRouter);

// definizione delle rotte
const router = new VueRouter({
    mode : 'history',
    routes : [
        {
            path : '/',
            name : 'home',
            component : Home, 
        }
    ]
});

//export delle rotte per essere usato con import in altri file
export default router;