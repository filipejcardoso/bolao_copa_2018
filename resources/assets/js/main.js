//============VUE=====================
import Vue from 'vue'
import axios from 'axios'
import router from './routes/web.js'
import VueAxios from 'vue-axios'
import store from './store/store'

//============COMPONENTES=====================
import App from './App.vue'
import Navbar from './components/Navbar.vue'
import Classificacao from './components/Classificacao.vue'
import Participante from './components/Participante.vue'
import ListaParticipantes from './components/ListaParticipantes.vue'
import Apostas from './components/Apostas.vue'
import ListaJogos from './components/ListaJogos.vue'
import JogoAtual from './components/JogoAtual.vue'

//============VUE=====================
Vue.use(VueAxios, axios);

//============COMPONENTES=====================
Vue.component('navbar',Navbar);
Vue.component('classificacao',Classificacao);
Vue.component('participante',Participante);
Vue.component('lista-participantes',ListaParticipantes);
Vue.component('apostas',Apostas);
Vue.component('lista-jogos',ListaJogos);
Vue.component('jogo-atual',JogoAtual);

//============CONSTANTES=====================
window.api = "copa.eletrobidu.com.br";
// window.api = "copa.com";
// window.api = "copa.com";

const app = new Vue({
	store,
	el: '#root',
	template: '<app></app>',
	components: { App },
	router
})