<template>
    <modal-component :id="id" :listarAcessos="listarAcessos" titulo="Editar Nível de Acesso" :acesso_id="acesso_id">

        <template v-slot:alertas>
            <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Dados da Categoria Atualizados com sucesso" v-if="transacaoStatus == 'atualizado'"></alert-component>
            <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar atualizar Categoria" v-if="transacaoStatus == 'erro'"></alert-component>
        </template>

        <template v-slot:conteudo>

            <form>
                <div class="row">

                    <div class="col-md-8 mb-3">
                        <input-container-component titulo="Designação Permissão:" id="designacaoPermissao" id-help="designacaoHelp" texto-ajuda="Atualizar Designação da Permissão">
                            <input type="text" class="form-control" id="designacaoPermissao" aria-describedby="idHelp" v-model="$store.state.item.Designacao_Permissao">
                            <span class="icon-input"><i class="bi bi-person-check"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-4 mb-3">
                        <input-container-component titulo="Sigla da Permissão:" id="siglaPermissao" id-help="siglaHelp" texto-ajuda="Atualizar Sigla da Permissão">
                            <input type="text" class="form-control" id="siglaPermissao" aria-describedby="idHelp" v-model="$store.state.item.Sigla_Permissao">
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

        props:['id', 'acesso_id', 'obterCategoria', 'listarAcessos'],

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
                formData.append('Designacao_Permissao', this.$store.state.item.Designacao_Permissao)
                formData.append('Sigla_Permissao', this.$store.state.item.Sigla_Permissao)

                let url = `${this.urlBase}permissoes/${this.$store.state.item.id}`

                let config = {
                    headers: {
                        'Content.Type': 'multipart/form-data'
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'atualizado'
                        this.transacaoDetalhes = {
                            mensagem: "Registo da Permissão atualizada com sucesso"
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
