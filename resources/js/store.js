import { createStore } from 'vuex'
import axios from "axios";

// Create a new store instance.
const store = createStore({
    state () {
        return {
            tarefas_prioridade: [],
            tarefas_prioridade_list: [],
            tarefas_progresso: [],
            tarefas: [],
            pessoas: []
        }
    },

    actions: {

        getTarefasProgresso({commit, state}, filter = []){
            axios.post("/api/tarefas-progresso-get", "")
                .then(res => {
                    state.tarefas_progresso = res.data;
                })
        },

        getTarefas({commit, state}, filter = []){
            axios.post("/api/tarefas-get", "")
                .then(res => {
                    state.tarefas = res.data;
                })
        },

        getTarefasPrioridade({commit, state}, filter = []){
            axios.post("/api/tarefas-prioridade-get", "")
                .then(res => {

                    //aqui vem agrupado
                    state.tarefas_prioridade = res.data;

                    //cria o mesmo array mas desagrupado
                    state.tarefas_prioridade_list = [];
                    for (var key in res.data) {
                        if (res.data.hasOwnProperty(key)) {
                            state.tarefas_prioridade_list.push(res.data[key]);
                        }
                    }

                })
        },

        getPessoas({commit, state}, filter = []){
            axios.post("/api/pessoas-get", "")
                .then(res => {
                    state.pessoas = res.data;
                })
        },
    }
})

export default store;
