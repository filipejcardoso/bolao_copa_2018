<template>
	<div>
	  <h5>{{this.$store.state.participante.nome}}</h5>
      <table class="highlight">
        <thead>
          <tr>
              <th>Apostas</th>
          </tr>
        </thead>

        <tbody>

          <tr class="line reset"  v-for="item in this.$store.state.participante.apostas" :key="item.id">
            <td>
              <div v-if="item.status == 1" class="row reset red">
                  <div class="col s12"></div>
              </div>
              <div v-if="item.status == 2" class="row reset blue">
                  <div class="col s12"></div>
              </div>
              <div v-if="item.status == 3" class="row reset green">
                  <div class="col s12"></div>
              </div>
              <div class="row valign-wrapper reset">
                <div class="col s2 center-align"><h6>{{item.time1}}</h6></div>
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
              <div class="row reset">
                  <div class="col s12 gray-text center-align">
                      <span class="horario">{{item.data}}</span>
                  </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>    
    </div>
</template>
<script>
export default {
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