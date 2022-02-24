require('./bootstrap');


import { createApp } from 'vue'

import App from './vue/app'

import router from './router'

import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap/dist/js/bootstrap.min.js";
import "bootstrap"

createApp({
    components: { App }
}).use(router).mount('#app');
