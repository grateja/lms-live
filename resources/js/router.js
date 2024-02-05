import { createRouter, createWebHistory } from "vue-router";

import _404 from './components/_404.vue'
import MainBody from './components/MainBody.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
    	{
    		path: "/",
    		component: MainBody
    	},
	    {
	    	path: "/:pathMatch(.*)",
	    	name: 'not found',
	    	component: _404
	    }
	]
})

export default router