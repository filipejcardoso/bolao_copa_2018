import Vue from 'vue'
import VueRouter from 'vue-router'

import NotFound from '../views/NotFound.vue'
import Template from '../views/Template.vue'
import Regulamento from '../views/Regulamento.vue'
import Resumo from '../views/Resumo.vue'
import Admin from '../views/Admin.vue'
import Hkk from '../views/Hkk.vue'
import Jogos from '../views/Jogos.vue'

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
            	path: 'piazza',component: Hkk
          	},
		  	{
            	path: 'ak47',component: Admin
          	},
		  	{
            	path: 'jogoszico',component: Jogos
          	},
          ]
      }
	]
})
export default router
