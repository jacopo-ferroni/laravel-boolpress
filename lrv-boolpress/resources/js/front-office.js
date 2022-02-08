// console.log('front-office');

import Vue from 'vue';
import App from './views/App.vue';

const root = new Vue({
    el: '#root',
    render: h => h(App),
})