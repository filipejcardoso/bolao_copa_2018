<template>
	<div>
	  <h5>{{this.$store.state.participante.nome}}</h5>

        <div class="row">
          <div class="col s12 m6"  v-for="(item,index) in this.$store.state.jogos" :key="item.id">
            <div class="row valign-wrapper reset">
              <div class="col s2 center-align"><h6>{{item.id}}</h6><h6>{{item.time1}}</h6></div>
              <div class="col s2 center-align">
                <img class="responsive-img bandeira" v-bind:src="`images/times/${item.foto1}`">
              </div>
              <div class="col s4 center-align">
                  <div class="row">
                    <div class="col s6"><input :disabled="item.status != 1" v-on:change="updateJogos(item.id)" v-bind:id="`input_1_${item.id}`" type="number" min="0" max="99" step="1" v-bind:value="item.escore1" name="shoe-size"></div>
                    <div class="col s6"><input :disabled="item.status != 1" v-on:change="updateJogos(item.id)" v-bind:id="`input_2_${item.id}`" type="number" min="0" max="99" step="1" v-bind:value="item.escore2" name="shoe-size"></div>
                  </div>
              </div>
              <div class="col s2 center-align">
                <img class="responsive-img bandeira" v-bind:src="`images/times/${item.foto2}`">
              </div>
              <div class="col s2 center-align"><h6>{{item.time2}}</h6></div>
            </div>
            <div class="row reset">
                <div class="col s12 center-align">
                  <label>
                    <input v-bind:name="`group_${item.id}`" type="radio" v-on:change="updateStatus(item.id, 0)" :checked="item.status == 0"/>
                    <span>Pendente</span>
                  </label>
                  <label>
                    <input v-bind:name="`group_${item.id}`" type="radio" v-on:change="updateStatus(item.id, 1)" :checked="item.status == 1" />
                    <span>Jogando</span>
                  </label>
                  <label>
                    <input v-bind:name="`group_${item.id}`" type="radio" v-on:change="updateStatus(item.id, 2)" :checked="item.status == 2" />
                    <span>Finalizado</span>
                  </label>
                </div>
                <div class="col s12 gray-text center-align">
                    <span class="horario">{{item.data}}</span>
                </div>
            </div>
            <br/>
            <div v-if="(index+1)%6==0"><br/><br/><br/><br/><br/></div>
            </div>
          </div>
    </div>
</template>
<script>
export default {
methods: {
    loadJogos()
    {
        const url = `http://copa.eletrobidu.com.br/api/jogos`;
        this.axios.get(url)
        .then(response => {

          const payload = response.data['records'];
          this.$store.commit('CHANGE_JOGOS', payload);
        })
        .catch(e => {
          alert(e)
        })
    },
    updateJogos(id){
      this.updateJogosBidu(id);
    },    
    updateJogosBidu(id){
      const url = `http://copa.eletrobidu.com.br/api/jogos/${id}`;;
      const payload = {"records":[{"escore1":`${$(`#input_1_${id}`).val()}`,"escore2":`${$(`#input_2_${id}`).val()}`}]};
      
      this.axios.patch(url, payload)
      .then(response => {
         this.updateJogosJoao(id);
      })
      .catch(e => {
        alert(e)
      })
    },    
    updateJogosJoao(id){
      const url = `http://bolao.bardojoao.com.br/api/jogos/${id}`;;
      const payload = {"records":[{"escore1":`${$(`#input_1_${id}`).val()}`,"escore2":`${$(`#input_2_${id}`).val()}`}]};
      
      this.axios.patch(url, payload)
      .then(response => {
          this.updateJogosMogibahr(id);
      })
      .catch(e => {
        alert(e)
      })
    },    
    updateJogosMogibahr(id){
      const url = `http://bolao.mogibahr.com.br/api/jogos/${id}`;;
      const payload = {"records":[{"escore1":`${$(`#input_1_${id}`).val()}`,"escore2":`${$(`#input_2_${id}`).val()}`}]};
      
      this.axios.patch(url, payload)
      .then(response => {
          M.toast({html: 'Alterado com sucesso!!!'});
      })
      .catch(e => {
        alert(e)
      })
    },    
    updateStatus(id, status){
        this.updateStatusBidu(id, status);
    },
    updateStatusBidu(id, status){
      const url = `http://copa.eletrobidu.com.br/api/jogos/${id}`;
      const payload = {"records":[{"status":`${status}`}]};
      
        this.axios.patch(url, payload)
        .then(response => {
          this.updateStatusJoao(id, status);
        })
        .catch(e => {
          alert(e)
        })
    },
    updateStatusJoao(id, status){
      const url = `http://bolao.bardojoao.com.br/api/jogos/${id}`;
      const payload = {"records":[{"status":`${status}`}]};
      
        this.axios.patch(url, payload)
        .then(response => {
          this.updateStatusMogibahr(id, status);
        })
        .catch(e => {
          alert(e)
        })
    },
    updateStatusMogibahr(id, status){
      const url = `http://bolao.mogibahr.com.br/api/jogos/${id}`;
      const payload = {"records":[{"status":`${status}`}]};
      
        this.axios.patch(url, payload)
        .then(response => {
          M.toast({html: 'Alterado com sucesso!!!'});
          this.loadJogos();
        })
        .catch(e => {
          alert(e)
        })
    }
  },
  created(){
      this.loadJogos();
  }
}
</script>
<style>
  .reset{padding: 0px!important; margin: 0px!important;}
	.line{border-bottom: solid 1px #ddd; padding: 0px!important; margin: 0px!important;}
	.line:hover{cursor: pointer;}
	.pontos,.escore_vencedor,.acerto_vencedor{background-color: #eee!important;}
  .bandeira{max-width: 40px!important;}
  .horario{font-size: 13px; color: #888;}
</style>