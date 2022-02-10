// console.log('front-office');

import Vue from 'vue';
import App from './views/App.vue';

//app router (rotte per l'aap)
import router from './routes';

const root = new Vue({
    el: '#root',
    router : router,
    render: h => h(App),
})