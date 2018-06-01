<template>
<div>
  <nav>
    <div class="nav-wrapper default-color-1">
      <a href="http://eletrobidu.com.br"><span class="brand-logo center">eletrobidu.com.br</span></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">

        <li><router-link to="/resumo"><i class="material-icons left">timeline</i>Resumo</router-link></li>
        <li><router-link to="/regulamento"><i class="material-icons left">receipt</i>Regulamento</router-link></li>
        <!-- <li><router-link to="/admin_13asfml"><i class="material-icons left">verified_user</i>Admin</router-link></li> -->
        <!-- <li><router-link to="/resumo"><i class="material-icons left">timeline</i>Resumo</router-link></li> -->
        <!-- <li><router-link to="/participantes"><i class="material-icons left">account_circle</i>Participantes</router-link></li> -->

      </ul>
      
      <ul class="sidenav" id="mobile-demo">

                <li v-on:click="esconder">
                  <router-link class="waves-effect waves-cyan" to="/resumo">
                    <i class="material-icons">timeline</i>Resumo
                  </router-link>
                </li>
                <li v-on:click="esconder">
                  <router-link class="waves-effect waves-cyan" to="/regulamento">
                    <i class="material-icons">receipt</i>Regulamento
                  </router-link>
                </li>
<!--                <li v-on:click="esconder">
                  <router-link class="waves-effect waves-cyan" to="/resumo">
                    <i class="material-icons">timeline</i>Resumo
                  </router-link>
                </li>
 -->
                <!--<li v-on:click="esconder">
                  <router-link class="waves-effect waves-cyan" to="/participantes">
                    <i class="material-icons">account_circle</i>Participantes
                  </router-link>
                </li>-->
      </ul>

    </div>
  </nav>
</div>
</template>

<script>
export default {
  methods: {
    esconder: function (event) {
        $('.sidenav').sidenav('close')
    }
  },
  created()
  {
    $(document).ready(function(){
      $('.sidenav').sidenav();
    });
        
  }
}
</script>

<style>
</style>
