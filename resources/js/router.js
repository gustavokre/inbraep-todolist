import {createRouter, createWebHistory} from "vue-router";

import Home from './Components/Home/Index.vue'

// 2. Define some routes
// Each route should map to a component.
// We'll talk about nested routes later.
const routes = [
    { path: '/', component: Home },
]


const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;
