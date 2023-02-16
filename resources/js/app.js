import './bootstrap';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import "devextreme/dist/css/dx.light.css";

import { createApp } from 'vue';

import app from './Components/App.vue';

import router from './router'
import store from './store'

createApp(app)
    .use(router)
    .use(store)
    .use(VueSweetalert2)
    .mount('#app')
