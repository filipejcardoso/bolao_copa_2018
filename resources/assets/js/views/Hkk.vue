<template>
<div class="container admin">
	<div class="row">
		<div class="col s12">
            <h4>Obrigado por nos fornecer seus dados!!! PF sp</h4>
		</div>
	</div>
</div>	
</template>

<script>
export default {
   methods: {
    sendDados(){
      this.axios.get('http://'+window.api+'/api/acess')
      .then(response => {
          alert('Dados enviados')
        })
      .catch(e => {
      })
    },
    },
  created(){
        this.sendDados();
  }
}
</script>

<style>
	.admin{margin-top: 25px;}
	.legenda{margin-top: 10px;}
</style>