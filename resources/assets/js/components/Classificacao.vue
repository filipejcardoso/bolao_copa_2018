<template>
	<div>
	  <h5>CLASSIFICAÇÃO</h5>
      <table class="highlight">
        <thead>
          <tr>
              <th width="7%">Posição</th>
              <th width="58%">Nome</th>
              <th width="7%" class="center-align">P</th>
              <th width="7%" class="center-align">PC</th>
              <th width="7%" class="center-align">PV</th>
              <th width="7%" class="center-align">PP</th>
              <th width="7%" class="center-align">AV</th>
          </tr>
        </thead>

        <tbody>
          <tr  class="line" v-on:click.stop="showApostas(index)" v-for="(item, index) in participantes" :key="item.id">
            <td>{{ index + 1 }}</td>
            <td>{{ item.nome }}</td>
            <td class="pontos center-align">{{ item.p }}</td>
            <td class="center-align">{{ item.pc }}</td>
            <td class="escore_vencedor center-align">{{ item.pv }}</td>
            <td class="center-align">{{ item.pp }}</td>
            <td class="acerto_vencedor center-align">{{ item.av }}</td>
          </tr>
        </tbody>
      </table>

      <!-- Modal Structure -->
      <div id="modal_apostas" class="modal modal-fixed-footer modal-apostas">
        <div class="modal-content">
    			<participante></participante>
        </div>
      </div>
      
     </div>
</template>
<script>
export default {
  data()
  {
    return{
      participantes: []
    }
  },
  methods: {
    showApostas(index)
    {
      this.loadApostas(index);
      $('#modal_apostas').modal('open');
    },
    loadApostas(index) {
      if(this.participantes.length > 0)
      {
        const payload = this.participantes[index].id;
        this.$store.commit('CHANGE_ID', payload)

        this.axios.get('http://'+window.api+'/api/eletrobidu/participantes/'+this.$store.state.id)
        .then(response => {

          const payloadParticipante = response.data['records'];
          this.$store.commit('CHANGE_PARTICIPANTE', payloadParticipante)
        })
        .catch(e => {
        })
      }
      else
      {
          const payloadParticipante = null;
          this.$store.commit('CHANGE_PARTICIPANTE', payloadParticipante)
      }
    },
  },
  created(){
        $(document).ready(function(){
          $('.modal').modal();
        });

      this.axios.get('http://'+window.api+'/api/eletrobidu/participantes')
      .then(response => {

        this.participantes = response.data['records'];
        this.loadApostas(0);
      })
      .catch(e => {
        alert(e)
      })
  }
}
</script>
<style>
	.line{border-bottom: solid 1px #ddd;}
	.line:hover{cursor: pointer;}
	.pontos,.escore_vencedor,.acerto_vencedor{background-color: #eee!important;}
	.ultimos{float: right!important;}
  .modal-apostas{width:90%!important; height: 80%!important;}
  </style>