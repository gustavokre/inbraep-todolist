<template>
    <div class="container-main">
        <div class="container-tarefas">
            <div class="container-tarefas-progresso" v-for="t_progresso in tarefas_progresso" :style="`border-bottom: 2px solid ${t_progresso.ds_color_hex};`">
                <!--    vuex store test -->
                <p class="tarefa-progresso-titulo" :style="`border-bottom: 2px solid ${t_progresso.ds_color_hex};`">{{t_progresso.ds_progresso}}</p>
                <!--    devextreme test    -->
                <div class="tarefa-item" v-for="tarefa in tarefas[t_progresso.id]" :style="`border: 1px solid;border-left: 5px solid;border-color: ${tarefas_prioridade[tarefa.cd_tarefa_prioridade].ds_color_hex}`">
                    <span>{{tarefa.ds_titulo}}</span>
                </div>
            </div>


        </div>
    </div>


</template>

<script>
import DxButton from 'devextreme-vue/button';
import axios from "axios";
export default {
    name: "Index",

    components: {
        DxButton,
    },

    methods:{

        start(){

            this.getTarefasProgresso();
            this.getTarefas();
            this.getTarefasPrioridade();

        },

        getTarefasProgresso(){
            axios.post("api/tarefas-progresso-get", "")
                .then(res => {
                    this.tarefas_progresso = res.data;
                })
        },

        getTarefas(){
            axios.post("api/tarefas-get", "")
                .then(res => {
                    this.tarefas = res.data;
                })
        },

        getTarefasPrioridade(){
            axios.post("api/tarefas-prioridade-get", "")
                .then(res => {
                    this.tarefas_prioridade = res.data;
                })
        },

    },

    data() {

        return {

            tarefas_prioridade: null,
            tarefas_progresso: null,
            tarefas: null,

        };

    },

    mounted() {

        this.start();

    }
}
</script>

<style scoped>

.container-main{
    display: flex;
    justify-content: center;
    align-items: center;
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
    border: 1px solid red;
    flex-wrap: wrap;
    padding: 40px 0px;
}

.container-tarefas-progresso{
    background-color: #ffffff;
    width: 300px;
    padding: 10px 15px;
    height: 70vh;
    border-radius: 10px;
    transition-delay: 2s;
}

.tarefa-progresso-titulo{
    font-size: 1.1em;
    color:#333;
    padding-bottom: 6px;
}

.tarefa-item{
    margin: 8px 0px;
    display: block;
    padding: 8px;
    border-radius: 4px;
    font-size: 0.85em;
    transition: background-color ease 0.5s;
    background-color: #fff;
    white-space: nowrap;
    overflow: hidden;
}

.tarefa-item:hover{
    background-color: #f1f1f1;
    transition: background-color ease 0.5s;
}

</style>
