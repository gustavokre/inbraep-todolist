<template>
    <div>
        <teleport to="body">
            <div class="container-modal" v-if="modalAtivo">
                <div>
                    <p class="tarefa-titulo">{{tarefa.ds_titulo}}</p>
                    <label v-if="tarefa">Mensagem</label>

                    <div class="container-mensagem">
                        <template v-for="mensagem in tarefa.mensagens">
                            <div class="balao-mensagem">
                                <label class="autor-mensagem">{{mensagem.pessoa.ds_nome}} - {{mensagem.created_at}}</label>
                                <span>{{mensagem.ds_mensagem}}</span>
                            </div>
                        </template>
                    </div>

                    <label>Autor da Mensagem</label>
                    <dx-select-box
                        class="margin-bottom-10"
                        v-model:value="form.cd_pessoa"
                        :items="$store.state.pessoas"
                        value-expr="id"
                        display-expr="ds_nome"
                        :show-clear-button="true"
                        :search-enabled="false"
                    />

                    <DxTextArea
                        class="margin-bottom-10"
                        :height="90"
                        v-model:value="form.ds_mensagem"
                    />

                    <div class="buttonsControl">

                        <dx-button
                            type="success"
                            text="Salvar Mensagem"
                            @click="salvarMensagem"
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
import { DxSelectBox, DxTextBox, DxButton, DxTextArea} from 'devextreme-vue';

export default {
    name: "modalTarefa",

    components: { DxSelectBox, DxTextBox, DxButton, DxTextArea},

    methods:{

        salvarMensagem(){
            axios.post('api/mensagem-salvar', this.form)
            .then(res => {
                this.sucessoMensagem(res.data.message);
                //para recarregar as mensagens
                this.abrirTarefa(this.tarefa.id)
            })
            .catch(error => {
                this.mostrarErro(error.response.data.errors);
            })
        },

        fecharModal(){
            this.tarefa = {};
            this.form.ds_mensagem = null;
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


        abrirTarefa(tarefaId){

            this.form.cd_tarefa = tarefaId;

            axios.post(`/api/mensagem/${tarefaId}`)
            .then(res => {
                this.tarefa = res.data;
            })

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
            tarefa: {},
            modalAtivo: false,

            form:{
                cd_tarefa: null,
                ds_mensagem: null,
            }

        }
    }

}
</script>

<style scoped>

.tarefa-titulo{
    text-align: center;
}

.autor-mensagem{
    font-size: 0.7em;
    color:#777;
}

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

.container-mensagem{
    margin-bottom: 10px;
    max-height: 400px;
    overflow: auto;
}

.container-modal > div{
    background-color: #fff;
    width: 500px;
    padding: 40px 30px;
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

.balao-mensagem{
    padding: 5px 10px;
    display: flex;
    align-items: center;
    flex-direction: column;
    background-color: #a5d9ff;
    margin: 8px;
    border-radius: 10px;
}

</style>
