<template>
<div>
    <div class="container">
        <div class="row">
            <div class="col s12 hide-on-small-only">
                <div class="slider">
                    <ul class="slides">
                      <li>
                        <img src="images/index/slider_one.jpg"> <!-- random image -->
                        <div class="caption center-align">
                          <h3>Bolão EletroBidu Copa do Mundo 2018</h3>
                          <h5 class="light grey-text text-lighten-3">Leia o regulamento e participe do bolão EletroBidu</h5>
                        </div>
                      </li>
                      <li>
                      <a href="http://eletrobidu.com.br">
                        <img src="images/index/slider_two.jpg"> <!-- random image -->
                        <div class="caption left-align">
                        </div>
                      </a>
                      </li>
                      <li>
                      <a href="https://www.facebook.com/EletroBidu/">
                        <img src="images/index/slider_tree.jpg"> <!-- random image -->
                        <div class="caption right-align">
                          <h3>Curta Nossa Página</h3>
                        </div>
                      </a>
                      </li>
                      <li>
                      <a href="https://www.facebook.com/EletroBidu/photos/a.938409532841025.1073741825.498811566800826/2151121204903179/?type=3&theater">
                        <img src="images/index/slider_four.jpg"> <!-- random image -->
                        <div class="caption right-align grey-text text-darken-4">
                        </div>
                      </a>
                      </li>
                    </ul>
                  </div>
            </div>
      
            <div class="col s12">

              <h4>1. COMO PARTICIPAR</h4>
              <p>Preencher as apostas, na folha oficial da EletroBidu, entregar e efetuar o pagamento no valor de R$20,00 na loja física localizada na Rua Francisco Franco nº 93 – Centro, Mogi das Cruzes - SP até o dia 11/06/2018 às 18:00.</p>

              <br/>

              <h4>2. PONTUAÇÃO</h4>
              <p>2.1 A pontuação dos participantes será feita em função de seus prognósticos para o resultado e o placar das partidas, conforme abaixo. Por resultado entende-se a indicação de vitória/derrota deste ou daquele time (incluindo-se o tempo regulamentar e excluindo a prorrogação e a disputa de pênaltis, quando houver). A pontuação dos acertos será feita a partir dos seguintes critérios não acumulativos:</p><br/>
              <p>Apostando que a partida terá um vencedor:</p>
              <p>Acerto do placar exato – 25 pontos.</p>
              <p>Acerto apenas do time vencedor – 10 pontos</p><br/>
              <p>Apostando que a partida terminará empatada:</p>
              <p>Acerto do placar exato – 25 pontos.</p>
              <p>Acerto do empate não exato – 10 pontos.</p>

             <br/>

              <h4>3. CRITÉRIO DE DESEMPATE</h4>
              <p>3.1 Serão considerados, para fins de desempate os seguintes critérios, na respectiva ordem:</p>
              <p>O maior número de acertos de placar em cheio (PC);</p>
              <p>O maior número de acertos do escore do vencedor (PV);</p>
              <p>O maior número de acertos do escore do perdedor (PP);</p>
              <p>O maior número de acertos dos vencedores (AV).</p>

             <br/>

              <h4>4. PREMIAÇÃO</h4>
              <p>4.1 Contando que não acontece nenhum a premiação será da seguinte forma:</p>
              <p>1º colocado – 55% do valor arrecado</p>
              <p>2º colocado – 30% do valor arrecado</p>
              <p>3º colocado – 10% do valor arrecado</p>
              <p>Ulitmo Colocado (Lanterna) – 5% do valor arrecado</p>
             <br/>
              <p>4.2. Caso haja empate, o prêmio será divido entre os ganhadores, com isso pode acontecer que o primeiro colocado receba um valor final menor que o segundo colocado.</p>

            </div>
              
              <!--<div class="col s12">
                <div class="card">
                  <div class="card-image">
                    <img src="images/index/soccer_one.png">
                  </div>
                  <div class="card-content">
                    <span class="card-title">Serelepe da rodada</span>
                    <p>Confira agora mesmo qual foi a opção vencedora na votação Quem é o craque da galera da Rodada do Campeonato!</p>
                  </div>
                </div>
              </div>-->

            </div>
        </div>
    </div>
</div>	
</template>

<script>
export default {
  created()
  {
    $(document).ready(function(){
      $('.slider').slider();
    });
  }
}
</script>

<style>
    .slider{margin-top: 30px!important; margin-bottom: 20px!important;}
</style>