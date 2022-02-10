import Vue from 'vue';
import VueRouter from 'vue-router';

// componenti per rotta
import Home from './pages/Home';
import About from './pages/About';

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
        },
        {
            path : '/about',
            name : 'about',
            component : About, 
        },
    ]
});

//export delle rotte per essere usato con import in altri file
export default router;