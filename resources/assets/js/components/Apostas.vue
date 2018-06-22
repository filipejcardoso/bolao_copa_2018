<template>
	<div>
	  <h5>{{this.$store.state.participante.nome}}</h5>

        <div class="row">
          <div class="col s12 m6"  v-for="(item,index) in this.$store.state.participante.apostas" :key="item.id">
            <div class="row valign-wrapper reset">
              <div class="col s2 center-align"><h6>{{item.id}}</h6><h6>{{item.time1}}</h6></div>
              <div class="col s2 center-align">
                <img class="responsive-img bandeira" v-bind:src="`images/times/${item.foto1}`">
              </div>
              <div class="col s4 center-align">
                  <div class="row">
                    <div class="col s6"><input v-on:change="updateAposta(item.id)" v-bind:id="`input_1_${item.id}`" type="number" min="0" max="99" step="1" v-bind:value="item.escore1" name="shoe-size"></div>
                    <div class="col s6"><input v-on:change="updateAposta(item.id)" v-bind:id="`input_2_${item.id}`" type="number" min="0" max="99" step="1" v-bind:value="item.escore2" name="shoe-size"></div>
                  </div>
              </div>
              <div class="col s2 center-align">
                <img class="responsive-img bandeira" v-bind:src="`images/times/${item.foto2}`">
              </div>
              <div class="col s2 center-align"><h6>{{item.time2}}</h6></div>
            </div>
            <div class="row reset">
                <div class="col s12 gray-text center-align">
                    <span class="horario">{{item.data}}</span>
                </div>
            </div>
            <div v-if="(index+1)%6==0"><br/><br/><br/><br/><br/></div>
            </div>
          </div>
    </div>
</template>
<script>
export default {
methods: {
    updateAposta($id){
      const url = `http://${window.api}/api/eletrobidu/participantes/${this.$store.state.id}/apostas/${$id}`;
      const payload = {"records":[{"escore1":`${$(`#input_1_${$id}`).val()}`,"escore2":`${$(`#input_2_${$id}`).val()}`}]};

      this.axios.patch(url, payload)
      .then(response => {
          M.toast({html: 'Alterado com sucesso!!!'});
       })
      .catch(e => {
      })
    }
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