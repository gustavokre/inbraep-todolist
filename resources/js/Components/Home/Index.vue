<template>
    <div class="container-main">
        <div class="container-controles">
            <dx-button
                style="width: 50%;font-size: 1.2em"
                @click="novaTarefa()"
                text="Nova tarefa"
                type="success"
            />
        </div>
        <div class="container-tarefas">

            <template v-for="t_progresso in $store.state.tarefas_progresso">
                <div class="container-tarefas-progresso" :style="`border-color: ${t_progresso.ds_color_hex};`">
                    <p class="tarefa-progresso-titulo" :style="`border-color: ${t_progresso.ds_color_hex};`">{{t_progresso.ds_progresso}}</p>

                    <template v-for="tarefa in $store.state.tarefas[t_progresso.id]">
                        <div class="tarefa-item-container">
                            <div class="tarefa-item" @click="editarTarefa(tarefa)" :title="tarefa.ds_titulo" :style="`border-color: ${tarefa.prioridade.ds_color_hex}`">
                                <span>{{tarefa.ds_titulo}}</span>
                            </div>
                            <div class="msg-icon" @click="abrirTarefaMensagem(tarefa.id)"><span>&#9993;</span></div>
                        </div>

                    </template>

                </div>
            </template>

        </div>
        <modal-tarefa ref="modalTarefa" @loadTarefas="loadTarefas"></modal-tarefa>
        <modal-tarefa-mensagem ref="modalTarefaMensagem"></modal-tarefa-mensagem>
    </div>


</template>

<script>

import DxButton from 'devextreme-vue/button';
import ModalTarefa from "./modalTarefa.vue";
import ModalTarefaMensagem from "./modalTarefaMensagem.vue";

export default {
    name: "Index",

    components: {
        ModalTarefa,
        ModalTarefaMensagem,
        DxButton,
    },

    methods:{

        abrirTarefaMensagem(tarefaId){
            this.$refs.modalTarefaMensagem.abrirTarefa(tarefaId);
            this.$refs.modalTarefaMensagem.modalAtivo = true;
        },

        editarTarefa(tarefa){

            this.$refs.modalTarefa.modalAtivo = true;
            this.$refs.modalTarefa.tarefaNova = false;
            this.$refs.modalTarefa.form = tarefa;

        },

        novaTarefa(){

            this.$refs.modalTarefa.modalAtivo = true;
            this.$refs.modalTarefa.tarefaNova = true;

        },

        loadTarefas(){

            this.$store.dispatch('getTarefasProgresso')
            this.$store.dispatch('getTarefas')
            this.$store.dispatch('getTarefasPrioridade')
            this.$store.dispatch('getPessoas')

        },

    },

    data() {

        return {


        };

    },

    mounted() {

        this.loadTarefas();

    }
}
</script>

<style scoped>

.container-main{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #e9e9e1;
    margin: 0;
    padding: 0;
    border: 0;
    width: 100%;
    min-height: 100vh;
}

.container-tarefas{
    display: flex;
    width: 80%;
    justify-content: center;
    align-items: center;
    gap: 5px;
    flex-wrap: wrap;
    padding: 40px 0px;
}

.container-controles{
    display: flex;
    width: 80%;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
}

.container-tarefas-progresso{
    background-color: #ffffff;
    border-bottom: 2px solid;
    width: 300px;
    padding: 10px 15px;
    height: 70vh;
    border-radius: 10px;
    transition-delay: 2s;
    overflow: auto;
}

.tarefa-progresso-titulo{
    border-bottom: 2px solid;
    font-size: 1.1em;
    color:#333;
    padding-bottom: 6px;
}

.tarefa-item{
    cursor: pointer;
    border: 1px solid;
    border-left: 5px solid;
    margin: 8px 0px;
    padding: 8px;
    border-radius: 4px;
    font-size: 0.85em;
    transition: background-color ease 0.5s;
    background-color: #fff;
    white-space: nowrap;
    overflow: hidden;
    flex: 1;
}

.tarefa-item:hover{
    background-color: #f1f1f1;
    transition: background-color ease 0.5s;
}

.msg-icon{
    cursor: pointer;
    margin: 10px 5px;
    width: 35px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #0284fc;
    border-radius: 6px;
    color: #fff;
}

.tarefa-item-container{
    display: flex;
    flex-direction: row;
    width: 100%;
}

</style>
