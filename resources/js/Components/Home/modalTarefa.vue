<template>
    <div>
        <teleport to="body">
            <div class="container-modal" v-if="modalAtivo">
                <div>
                    <label>Tarefa Título</label>
                    <dx-text-box
                        class="margin-bottom-10"
                        v-model:value="form.ds_titulo"
                    />
                    <label v-if="tarefaNova">Mensagem/Descrição</label>
                    <dx-text-box
                        v-if="tarefaNova"
                        class="margin-bottom-10"
                        v-model:value="form.ds_mensagem"
                    />

                    <label>Tarefa Progresso</label>
                    <dx-select-box
                        class="margin-bottom-10"
                        v-model:value="form.cd_tarefa_progresso"
                        :items="$store.state.tarefas_progresso"
                        value-expr="id"
                        display-expr="ds_progresso"
                        :show-clear-button="true"
                        :search-enabled="false"
                    />

                    <label>Tarefa Prioridade</label>
                    <dx-select-box
                        class="margin-bottom-10"
                        v-model:value="form.cd_tarefa_prioridade"
                        :items="$store.state.tarefas_prioridade_list"
                        value-expr="id"
                        display-expr="ds_prioridade"
                        :show-clear-button="true"
                        :search-enabled="false"
                    />

                    <label>Requerente</label>
                    <dx-select-box
                        class="margin-bottom-10"
                        v-model:value="form.cd_pessoa_requerente"
                        :items="$store.state.pessoas"
                        value-expr="id"
                        display-expr="ds_nome"
                        :show-clear-button="true"
                        :search-enabled="false"
                    />

                    <label>Atribuído</label>
                    <dx-select-box
                        class="margin-bottom-10"
                        v-model:value="form.cd_pessoa_atribuido"
                        :items="$store.state.pessoas"
                        value-expr="id"
                        display-expr="ds_nome"
                        :show-clear-button="true"
                        :search-enabled="false"
                    />

                    <label>Data de previsão</label>
                    <dx-date-box
                        class="margin-bottom-10"
                        v-model:value="form.dt_previsao"
                        :use-mask-behavior="true"
                        type="date"
                        display-format="dd/MM/yyyy"
                        date-serialization-format="yyyy-MM-dd"
                    />
                    <div class="buttonsControl">

                        <dx-button
                            v-if="tarefaNova"
                            type="success"
                            text="Criar tarefa"
                            @click="criarTarefa"
                        />

                        <dx-button
                            v-if="!tarefaNova"
                            type="default"
                            text="Salvar tarefa"
                            @click="editarTarefa"
                        />

                        <dx-button
                            v-if="!tarefaNova"
                            type="danger"
                            text="Deletar tarefa"
                            @click="deletarTarefaConfirmacao"
                        />

                        <dx-button
                            type="danger"
                            text="Fechar"
                            styling-mode="outlined"
                            @click="fecharModal"
                        />

                    </div>

                </div>

            </div>
        </teleport>
    </div>
</template>

<script>
import {DxDateBox, DxSelectBox, DxTagBox, DxTextBox, DxButton} from 'devextreme-vue';

export default {
name: "modalTarefa",

    components: {DxDateBox, DxSelectBox, DxTagBox, DxTextBox, DxButton},

    methods:{

        resetForm(){
            this.form = {
                id:null,
                ds_titulo:null,
                ds_mensagem:null,
                dt_previsao:null,
                cd_pessoa_requerente: null,
                cd_pessoa_atribuido: null,
                cd_tarefa_progresso: null,
                cd_tarefa_prioridade: null,
            }
        },

        fecharModal(){
            this.resetForm();
            this.modalAtivo = false;
        },

        mostrarErro(msg){

            if(!msg){
                msg = "Algo deu errado";
            }

            this.$swal.fire({
                icon: 'warning',
                title: 'Aviso',
                text: msg,
            })
        },

        sucessoMensagem(msg){
            if(!msg){
                msg = "Ok";
            }

            this.$swal.fire({
                icon: 'success',
                title: msg,
            })
        },

        criarTarefa(){

            axios.post("/api/tarefas", this.form)
            .then(res => {
                this.sucessoMensagem(res.data.message);
            })
            .catch(error => {
                this.mostrarErro(error.response.data.errors);
            })
            .finally(() =>{
                this.$emit('loadTarefas');
            })

        },

        editarTarefa(){

            axios.put(`/api/tarefas/${this.form.id}`, this.form)
                .then(res => {
                    this.sucessoMensagem(res.data.message);
                })
                .catch(error => {
                    this.mostrarErro(error.response.data.errors);
                })
                .finally(() =>{
                    this.$emit('loadTarefas');
                })

        },

        deletarTarefaConfirmacao(){


            this.$swal.fire({
                title: 'Deseja mesmo deletar esta tarefa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ae0000',
                cancelButtonColor: '#0063ff',
                confirmButtonText: 'Deletar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.deletarTarefa();
                }
            })

        },

        deletarTarefa(){

            axios.delete(`/api/tarefas/${this.form.id}`)
                .then(res => {
                    this.sucessoMensagem(res.data.message);
                })
                .catch(error => {
                    this.mostrarErro(error.response.data.errors);
                })
                .finally(() =>{
                    this.$emit('loadTarefas');
                })

        },

        ativarModal(){
            this.modalAtivo = true;
        },

        desativarModal(){
            this.modalAtivo = false;
        },

        toggleModal(){
            this.modalAtivo = !this.modalAtivo;
        },

    },

    data(){
        return {
            tarefaNova: true,
            modalAtivo: false,

            form:{
                id:null,
                ds_titulo:null,
                ds_mensagem:null,
                dt_previsao:null,
                cd_pessoa_requerente: null,
                cd_pessoa_atribuido: null,
                cd_tarefa_progresso: null,
                cd_tarefa_prioridade: null,
            }
        }
    }

}
</script>

<style scoped>

    .container-modal{
        background-color: rgba(0,0,0,0.2);
        position: fixed;
        top: 0;
        height: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    .container-modal > div{
        background-color: #fff;
        width: 500px;
        padding: 50px 30px;
        border-radius: 15px;
    }

    .margin-bottom-10{
        margin-bottom: 10px;
    }

    .buttonsControl{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

</style>
