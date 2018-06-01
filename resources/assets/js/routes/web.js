import Vue from 'vue'
import VueRouter from 'vue-router'

import NotFound from '../views/NotFound.vue'
import Template from '../views/Template.vue'
import Regulamento from '../views/Regulamento.vue'
import Resumo from '../views/Resumo.vue'
import Admin from '../views/Admin.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'hash',
	routes: [
		{ path: '*', component: NotFound },
		{ path: '/', component: Template, redirect: '/resumo', 
		  children: [
		  	{
            	path: 'regulamento',component: Regulamento
          	},
		  	{
            	path: 'resumo',component: Resumo
          	},
		  	{
            	path: 'admin_13asfml',component: Admin
          	},
          ]
      }
	]
})
export default router
