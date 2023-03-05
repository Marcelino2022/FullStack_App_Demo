<template>
    <modal-component id="removerProvinciaModal" titulo="Remover Provincia">

        <template v-slot:alertas>
            <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Província removida com sucesso" v-if="transacaoStatus == 'removido'"></alert-component>
            <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar remover Província" v-if="transacaoStatus == 'erro'"></alert-component>
        </template>

        <template v-slot:conteudo>

            <form>
                <div class="row">

                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-exclamation-triangle-fill mr-3"></i>
                            Tem certeza que pretende Eliminar a Província com designação  <b>{{ $store.state.item.Designacao_Provincia }}</b> ?
                            <p class="mt-3"><i class="bi bi-question-diamond-fill mr-3"></i>
                                <b> Para cancelar clica em fechar.</b>
                            </p>
                        </div>
                        <input-container-component hidden titulo="ID Província:" id="designacaoProvincia" id-help="designacaoHelp">
                            <input  type="text" class="form-control" id="idProvincia" aria-describedby="idHelp" texto-ajuda="" :value="$store.state.item.id" disabled>
                            <span class="icon-input"><i class="bi bi-tags"></i></span>
                        </input-container-component>
                    </div>

                </div>
            </form>
        </template>
        <template v-slot:rodape>
            <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-danger" @click="remover()">Eliminar</button>
        </template>
    </modal-component>
</template>

<style scoped>
    @import '../../../css/modal.css';
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

            remover(){
                let url = this.urlBase+'/'+this.$store.state.item.id;

                console.log(url);

                const formData = new FormData();
                formData.append('_method','delete')

                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'authorization': this.token
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {

                        console.log(response)

                        /*this.transacaoStatus = 'removido'
                        this.transacaoDetalhes = {
                            mensagem: "Província removida com sucesso"
                        }*/
                    })

                    .catch(errors => {
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors.data
                    }
                })
            },

        },
    }

</script>
