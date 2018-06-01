<template>
<div class="container admin">
	<div class="row">
		<div class="col s12 m3">
			<lista-participantes></lista-participantes>
		</div>
		<div class="col s12 m9">
			<apostas></apostas>
		</div>
	</div>
</div>	
</template>

<script>
export default {
   methods: {
    loadApostas() {
      alert('apostas')
    },
  },
}
</script>

<style>
	.admin{margin-top: 25px;}
	.legenda{margin-top: 10px;}
</style>