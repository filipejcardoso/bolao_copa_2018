<template>
	<div>
        <div class="row">
          <div class="col s12"  v-for="(item,index) in this.$store.state.jogos" :key="item.id">
            <div v-if="item.status == 1" class="col s12">
            <div class="row valign-wrapper reset">
              <div class="col s2 center-align"><h6>{{item.id}}</h6><h6>{{item.time1}}</h6></div>
              <div class="col s2 center-align">
                <img class="responsive-img bandeira" v-bind:src="`images/times/${item.foto1}`">
              </div>
              <div class="col s4 center-align">
                    <h5>{{item.escore1}}x{{item.escore2}}</h5>
              </div>
              <div class="col s2 center-align">
                <img class="responsive-img bandeira" v-bind:src="`images/times/${item.foto2}`">
              </div>
              <div class="col s2 center-align"><h6>{{item.time2}}</h6></div>
              </div>
            <div class="col s12 gray-text center-align">
                <span class="horario">{{item.data}}</span>
            </div>
            </div>
            </div>       
          </div>
    </div>
</template>
<script>
export default {
methods: {
    loadAtual()
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
    }
  },
  created(){
      this.loadAtual();
  }
}
</script>
<style>
  .reset{padding: 0px!important; margin: 0px!important;}
	.line{border-bottom: solid 1px #ddd; padding: 0px!important; margin: 0px!important;}
	.line:hover{cursor: pointer;}
  .horario{font-size: 13px; color: #888;}
</style>