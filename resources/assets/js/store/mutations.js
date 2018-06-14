export default {
    'CHANGE_ID'(state, payload){
        state.id = payload;
    },
    'CHANGE_PARTICIPANTE'(state, payload){
        state.participante = payload;
    },
    'CHANGE_JOGOS'(state, payload){
        state.jogos = payload;
    }
}