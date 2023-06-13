<template>
    <modal-component :id="id" :listarFuncoes="listarFuncoes" titulo="Editar dados da Função" :funcao_id="funcao_id">

        <template v-slot:alertas>
            <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Dados da Funcao Atualizados com sucesso" v-if="transacaoStatus == 'atualizado'"></alert-component>
            <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar atualizar Funcao" v-if="transacaoStatus == 'erro'"></alert-component>
        </template>

        <template v-slot:conteudo>

            <form>
                <div class="row">

                    <div class="col-md-8 mb-3">
                        <input-container-component titulo="Designação Função" id="designacaoFuncao" id-help="designacaoHelp" texto-ajuda="Atualizar Designação da Funcao">
                            <input type="text" class="form-control" id="designacaoFuncao" aria-describedby="idHelp" v-model="$store.state.item.Designacao_Funcao">
                            <span class="icon-input"><i class="bi bi-person-lines-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-4 mb-3">
                        <input-container-component titulo="Sigla da Função:" id="siglaFuncao" id-help="siglaHelp" texto-ajuda="Atualizar Sigla da Funcao">
                            <input type="text" class="form-control" id="siglaFuncao" aria-describedby="idHelp" v-model="$store.state.item.Sigla_Funcao">
                            <span class="icon-input"><i class="bi bi-bookmark-fill"></i></span>
                        </input-container-component>
                    </div>

                </div>
            </form>

        </template>
        <template v-slot:rodape>
            <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-principal" @click="atualizar()">Atualizar</button>
        </template>
    </modal-component>
</template>

<style scoped>
    @import '../../../css/modal.css';
</style>

<script>
import axios from 'axios';

    export default{
        data() {
            return{
                urlBase: import.meta.env.VITE_API_URL,
                designacaoFornecida:'',
                siglaFornecida:'',
                transacaoStatus:'',
                transacaoDetalhes: {}

            }
        },

        props:['id', 'funcao_id', 'obterFuncao', 'listarFuncoes'],

        methods: {

            setStore(obj) {
                this.$store.state.transacao.status = 'avisar'
                this.$store.state.transacao.mensagem = ''
                this.$store.state.transacao.dados = ''
                this.$store.state.item = obj
            },

            atualizar(){

                let formData = new FormData()
                formData.append('_method', 'patch')
                formData.append('Designacao_Funcao', this.$store.state.item.Designacao_Funcao)
                formData.append('Sigla_Funcao', this.$store.state.item.Sigla_Funcao)

                let url = `${this.urlBase}funcao/${this.$store.state.item.id}`
                let config = {
                    headers: {
                        'Content.Type': 'multipart/form-data'
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'atualizado'
                        this.transacaoDetalhes = {
                            mensagem: "Registo da Funcao atualizado com sucesso"
                        }
                    })
                    .catch(errors => {
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message
                        }
                        this.$store.state.transacao.mensagem = errors.response.data.message
                        this.$store.state.transacao.dados = errors.response.data.errors
                })
            },
        }
    }

</script>
