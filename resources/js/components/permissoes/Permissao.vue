<template>

    <editarPermissao-component id="editarPermissaoModal" ></editarPermissao-component>

    <modal-component id="PermissaoModal" titulo="Adicionar Permissão">

        <template v-slot:alertas>
            <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Registo Realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
            <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar Registar Província" v-if="transacaoStatus == 'erro'"></alert-component>
        </template>

        <template v-slot:conteudo>
            <form>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <input-container-component titulo="Designação da Permissão:" id="designacaoFuncao" id-help="designacaoHelp" texto-ajuda="Informe a Designação da Função">
                            <input type="text" class="form-control" id="designacaoFuncao" aria-describedby="idHelp" placeholder="Designaçao da Função" v-model="permissaoFornecida">
                            <span class="icon-input"><i class="bi bi-person-check"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mb-3">
                        <input-container-component titulo="Sigla da Função:" id="siglaFuncao" id-help="siglaHelp" texto-ajuda="Informe a Sigla da Função">
                            <input type="text" class="form-control" id="siglaFuncao" aria-describedby="idHelp" placeholder="Sigla da Função" v-model="siglaFornecida">
                            <span class="icon-input"><i class="bi bi-bookmark-fill"></i></span>
                        </input-container-component>
                    </div>
                </div>
            </form>
        </template>

        <template v-slot:rodape>
            <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-principal" @click="salvar()">Salvar</button>
        </template>

    </modal-component>

    <div class="container  margem-top">
        <div class="row  mt-5">

            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3 form-floating" id="filter">
                        <h2 class="">Nível de Acesso</h2>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3 col-float-right">
                        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#PermissaoModal" v-if="admin"><i class="bi bi-plus"></i></button>
                    </div>
                </div>

                <hr>

                <table class="table table-striped table-borderless table-hover table-bordered ">
                    <thead class="tableHeader">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Designação Acesso</th>
                            <th scope="col">Sigla</th>
                            <th scope="col"><i class="bi bi-tools"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="permissao in permissoes" :key="permissao.id">
                            <td scope="row">{{ permissao.id }}</td>
                            <td>{{ permissao.Designacao_Permissao }}</td>
                            <td class="text-center">{{ permissao.Sigla_Permissao }}</td>
                            <td class="text-center tools">
                                <i class="bi bi-eye-fill view" @click="setStore(permissao)"></i>
                                <i class="bi bi-pencil-square edit" data-bs-toggle="modal" data-bs-target="#editarPermissaoModal" @click="setStore(permissao)" v-if="admin"></i>
                                <i class="bi bi-trash-fill delete" data-bs-toggle="modal" data-bs-target="#removerPermissaoModal"  @click="setStore(permissao)" v-if="admin"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">
                <div hidden>  {{ usuario }} </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import '../../../css/provincias.css';
    @import '../../../css/modal.css';
</style>

<script>

import axios from 'axios';
import { mapState } from 'vuex';

export default {

    data(){
        return{
            urlBase: import.meta.env.VITE_API_URL,
            permissoes: "",
            permissaoFornecida:"",
            siglaFornecida:"",
            admin: "",

            transacaoStatus: "",
            transacaoDetalhes: {},
        }
    },

    computed: {
        ...mapState(['user']),
        usuario(){
            const usuario = this.user && this.user[0] ? this.user[0] : '';
            this.carragarDadosDoUtilizador(usuario)
            return this.user && this.user[0] ? this.user[0] : '';
        },
    },

    methods: {

        carragarDadosDoUtilizador(usuario){

            const url = `${this.urlBase}user/autenticado/dados/?id=${usuario.coordenacao_id}`
            axios.get(url)
                .then( response => {

                    this.permissao =response.data.coordenacao[0].Designacao_Permissao

                    if(this.permissao == 'Nível Nacional'){
                        this.admin = true
                        this.acessorURL =`${this.urlBase}membro`
                    }
            })
        },

        setStore(obj) {
            this.$store.state.transacao.status = "avisar";
            this.$store.state.transacao.mensagem = "";
            this.$store.state.transacao.dados = "";
            this.$store.state.item = obj;
            this.categoria_id = obj.categoria_id;
        },

       listarPermissoes(){

            const url = `${this.urlBase}permissoes`

            axios.get(url)
                .then( response => {
                    this.permissoes = response.data;
                } )
                .catch( errors => {
                    this.permissoes = errors.response.data.msg;
                })

        },


        salvar(){
            const formData = new FormData();
            formData.append('Designacao_Permissao', this.permissaoFornecida)
            formData.append('Sigla_Permissao', this.siglaFornecida)

            let config = {
                headers: {
                    'Content.Type': 'multipart/form-data'
                }
            }

            const url = `${this.urlBase}permissoes`

            axios.post(url, formData, config)
                .then(response => {
                    this.listarPermissoes();
                    this.transacaoStatus = 'adicionado'
                    this.transacaoDetalhes = {
                        mensagem: "Permissão adicionada com sucesso"
                    }

                    this.PermissãoFornecida=""
                    this.siglaFornecida=""
                })

                .catch(errors => {
                    this.transacaoStatus = 'erro'
                    this.transacaoDetalhes = {
                        mensagem: errors.response.data.message,
                        dados: errors.response.data.errors
                }
            })
        },
    },
    mounted(){
        this.listarPermissoes()
        this.carragarDadosDoUtilizador()
    }
}

</script>
