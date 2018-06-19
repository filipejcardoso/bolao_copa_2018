<template>
	<div>
	  <h5>PARTICIPANTES</h5>
  <a class="waves-effect waves-light btn modal-trigger" href="#modal1"><i class="material-icons right">add</i>Adicionar Participante</a>
  <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer modal-particiante">
    <div class="modal-content">
      <h4>Inserir Participante</h4>
      <input type="text" v-on:keyup="keyInsert" placeholder="Nome do Participante" name="nome_participante" id="nome_participante"/>
    </div>
    <div class="modal-footer">
      <a class="waves-effect waves-light btn" v-on:click.stop="inserirParticipante"><i class="material-icons right">add</i>Inserir</a>
    </div>
  </div>

      <table class="highlight">
        <thead>
          <tr>
              <th width="10%">Posição</th>
              <th width="95%">Nome</th>
          </tr>
        </thead>

        <tbody>
          <tr class="line" v-on:click.stop="loadApostas(index)" v-for="(item, index) in participantes" :key="item.id">
            <td>{{ index + 1 }}</td>
            <td>{{ item.nome }}</td>
          </tr>
        </tbody>
      </table>

      <a class="waves-effect waves-light btn modal-trigger red" href="#modal2"><i class="material-icons right">delete</i>Remover Participante</a>
      <!-- Modal Structure -->
      <div id="modal2" class="modal modal-fixed-footer modal-particiante">
        <div class="modal-content">
          <h4>Remover ({{this.$store.state.participante.nome}})</h4>
          <p>Tem certeza que deseja remover esse Participante?</p>
        </div>
        <div class="modal-footer">
          <a class="waves-effect waves-light btn" v-on:click.stop="closeModalDestroy"><i class="material-icons right">cancel</i>Cancelar</a>
          <a class="waves-effect waves-light btn red" v-on:click.stop="destroyParticipante()"><i class="material-icons right">delete</i>SIM</a>
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
    loadParticipantes(){
      this.axios.get('http://'+window.api+'/api/participantes')
      .then(response => {

        this.participantes = response.data['records'];

        this.loadApostas(0);
      })
      .catch(e => {
      })
    },
    loadApostas(index) {
      if(this.participantes.length > 0)
      {
        const payload = this.participantes[index].id;
        this.$store.commit('CHANGE_ID', payload)

        this.axios.get('http://'+window.api+'/api/participantes/'+this.$store.state.id)
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
    inserirParticipante(){
      const url = `http://${window.api}/api/participantes`;
      const payload = {"records":[{"nome":`${$(nome_participante).val()}`}]};

      this.axios.post(url, payload)
      .then(response => {
        this.loadParticipantes();
        $('#modal1').modal('close');
        $(nome_participante).val('');
      })
      .catch(e => {
      })
    },
    destroyParticipante()
    {
      const url = `http://${window.api}/api/participantes/${this.$store.state.id}`;

      this.axios.delete(url)
      .then(response => {
        this.loadParticipantes();
        this.closeModalDestroy();
      })
      .catch(e => {
      })
    },
    keyInsert: function(event){
      if(event.key == 'Enter')
        this.inserirParticipante();
    },
  closeModalDestroy(){
        $('#modal2').modal('close');
  }
  },
  created(){
        $(document).ready(function(){
          $('.modal').modal();
        });
        this.loadParticipantes();
  }
}
</script>
<style>
	.line{border-bottom: solid 1px #ddd;}
	.line:hover{cursor: pointer;}
	.pontos,.escore_vencedor,.acerto_vencedor{background-color: #eee!important;}
	.ultimos{float: right!important;}
  .modal-particiante{width:500px!important; height: 250px!important;}
</style>