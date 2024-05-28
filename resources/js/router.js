import { createRouter, createWebHistory } from "vue-router";

import _404 from './components/_404.vue'
import MainBody from './components/MainBody.vue'
import Login from './components/auth/Login.vue'
import Register from './components/register/Index.vue'
import LinkToQrCode from './components/link/LinkToQrCode.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
    	{
    		path: "/",
    		component: MainBody
    	},
    	{
    		path: "/login",
    		component: Login
    	},
        {
            path: '/register',
            component: Register
        },
        {
            path: '/link',
            component: LinkToQrCode
        },
	    {
	    	path: "/:pathMatch(.*)",
	    	name: 'not found',
	    	component: _404
	    }
	]
})

export default router
