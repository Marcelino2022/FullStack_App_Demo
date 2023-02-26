<template>
    <modal-component id="editarProvinciaModal" titulo="Editar dados Provincia">

        <template v-slot:alertas>
            <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Dados da província Atualizada com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
            <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar atualizar Província" v-if="transacaoStatus == 'erro'"></alert-component>
        </template>

        <template v-slot:conteudo>
            <form>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <input-container-component titulo="Designação Província:" id="designacaoProvincia" id-help="designacaoHelp" texto-ajuda="Informe a Designação da Província">
                            <input type="text" class="form-control" id="designacaoProvincia" aria-describedby="idHelp" placeholder="Designaçao da Entidade" v-model="designacaoProvinciaFornecido">
                            <span class="icon-input"><i class="bi bi-map-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mb-3">
                        <input-container-component titulo="Sigla da Província:" id="siglaProvincia" id-help="siglaHelp" texto-ajuda="Informe a Sigla da Província">
                            <input type="text" class="form-control" id="siglaProvincia" aria-describedby="idHelp" placeholder="Sigla da Entidade" v-model="siglaProvinciaFornecida">
                            <span class="icon-input"><i class="bi bi-bookmark-fill"></i></span>
                        </input-container-component>

                    </div>

                </div>
            </form>
        </template>
        <template v-slot:rodape>
            <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-principal" @click="salvar()">Atualizar</button>
        </template>
    </modal-component>
</template>

<style scoped>
    @import '../../../css/modalAdicionar.css';
</style>

<script>
import axios from 'axios';

    export default{

        computed: {
                token() {
                    let token = document.cookie.split(';').find( indice => {
                        return indice.includes('token=')
                    })

                    token = token.split('=')[1]
                    token = 'Bearer' + token

                    return token
                }
        },

        data() {
            return{
                urlBase: 'http://127.0.0.1:8000/api/provincia',
                designacaoProvinciaFornecido: '',
                siglaProvinciaFornecida: '',
                transacaoStatus: '',
                transacaoDetalhes: {}

            }
        },

        methods: {
            salvar(){
                console.log(this.designacaoProvinciaFornecido, this.siglaProvinciaFornecida)

                const formData = new FormData();
                formData.append('Designacao_Provincia', this.designacaoProvinciaFornecido)
                formData.append('Codigo_Provincia', this.siglaProvinciaFornecida)

                let config = {
                    headers: {
                        'Content.Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'authorization': this.token
                    }
                }


                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = {
                            mensagem: "Província adicionada com sucesso"
                        }
                    })

                    .catch(errors => {
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors
                        }
                    })
            }
        }
    }

</script>
