<template>
    <modal-component :id="id" :listarCategorias="listarCategorias" titulo="Editar dados da Categoria" :categoria_id="categoria_id">

        <template v-slot:alertas>
            <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Dados da Categoria Atualizados com sucesso" v-if="transacaoStatus == 'atualizado'"></alert-component>
            <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar atualizar Categoria" v-if="transacaoStatus == 'erro'"></alert-component>
        </template>

        <template v-slot:conteudo>

            <form>
                <div class="row">

                    <div class="col-md-8 mb-3">
                        <input-container-component titulo="Designação Categoria:" id="designacaoCategoria" id-help="designacaoHelp" texto-ajuda="Atualizar Designação da Categoria">
                            <input type="text" class="form-control" id="designacaoCategoria" aria-describedby="idHelp" v-model="$store.state.item.Designacao_Categoria">
                            <span class="icon-input"><i class="bi bi-person-lines-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-4 mb-3">
                        <input-container-component titulo="Sigla da Categoria:" id="siglaCategoria" id-help="siglaHelp" texto-ajuda="Atualizar Sigla da Categoria">
                            <input type="text" class="form-control" id="siglaCategoria" aria-describedby="idHelp" v-model="$store.state.item.Sigla_Categoria">
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
                designacaoFornecida: '',
                siglaFornecida: '',
                transacaoStatus: '',
                transacaoDetalhes: {}

            }
        },

        props:['id', 'categoria_id', 'obterCategoria', 'listarCategorias'],

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
                formData.append('Designacao_Categoria', this.$store.state.item.Designacao_Categoria)
                formData.append('Sigla_Categoria', this.$store.state.item.Sigla_Categoria)


                let url = `${this.urlBase}categoria/${this.$store.state.item.id}`
                let config = {
                    headers: {
                        'Content.Type': 'multipart/form-data'
                    }
                }

                for (const [chave, valor] of formData.entries()) {
                    console.log(`${chave}: ${valor}`);
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.$store.state.transacao.status = 'atualizado'
                        this.$store.state.transacao.mensagem = "Registas da Categoria atualizados com sucesso"
                        console.log(response);
                    })
                    .catch(errors => {
                        this.$store.state.transacao.status = 'erro'
                        this.$store.state.transacao.mensagem = errors.response.data.message
                        this.$store.state.transacao.dados = errors.response.data.errors
                })
            },
        }
    }

</script>
