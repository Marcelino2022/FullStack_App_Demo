<template>

    <editarFuncao-component id="editarFuncaoModal" ></editarFuncao-component>

    <modal-component id="FuncoesModal" titulo="Adicionar Função">

        <template v-slot:alertas>
            <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Registo Realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
            <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar Registar Província" v-if="transacaoStatus == 'erro'"></alert-component>
        </template>

        <template v-slot:conteudo>
            <form>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <input-container-component titulo="Designação da Função:" id="designacaoFuncao" id-help="designacaoHelp" texto-ajuda="Informe a Designação da Função">
                            <input type="text" class="form-control" id="designacaoFuncao" aria-describedby="idHelp" placeholder="Designaçao da Função" v-model="funcaoFornecida">
                            <span class="icon-input"><i class="bi bi-person-lines-fill"></i></span>
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
                        <h2 class="">Funções</h2>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3 col-float-right">
                        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#FuncoesModal"><i class="bi bi-plus"></i></button>
                    </div>
                </div>

            <hr>

            <table class="table table-striped table-borderless table-hover table-bordered ">
                    <thead class="tableHeader">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Designacão da Função</th>
                            <th scope="col">Sigla</th>
                            <th scope="col"><i class="bi bi-tools"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="funcao in funcoes" :key="funcao.id">
                            <td scope="row">{{ funcao.id }}</td>
                            <td>{{ funcao.Designacao_Funcao }}</td>
                            <td class="text-center">{{ funcao.Sigla_Funcao }}</td>
                            <td class="text-center tools">
                                <i class="bi bi-eye-fill view" @click="setStore(funcao)"></i>
                                <i class="bi bi-pencil-square edit" data-bs-toggle="modal" data-bs-target="#editarFuncaoModal" @click="setStore(funcao)" v-if="admin"></i>
                                <i class="bi bi-trash-fill delete" data-bs-toggle="modal" data-bs-target="#removerFuncoesModal"  @click="setStore(funcao)" v-if="admin"></i>
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
    @import '../../css/provincias.css';
    @import '../../css/modal.css';
</style>

<script>

    import axios from 'axios';
    import { mapState } from 'vuex';

    export default {

        data() {
            return {
                urlBase: import.meta.env.VITE_API_URL,
                funcoes: "",
                funcaoFornecida: "",
                siglaFornecida: "",
                provincia_id: "",
                permissao:"",
                admin: false,


                transacaoStatus: "",
                transacaoDetalhes: {},

            };
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
                        } else{
                            this.acessorURL =`${this.urlBase}membro/listarMembros?id=${usuario.coordenacao_id}`
                        }
                })
            },

            setStore(obj) {
                this.$store.state.transacao.status = 'avisar'
                this.$store.state.transacao.mensagem = ''
                this.$store.state.transacao.dados = ''
                this.$store.state.item = obj
                this.funcao_id = obj.funcao_id
              /*   this.obterProvinciaPorID(this.provincia_id) */
            },

            listarFuncoes() {

                const url = `${this.urlBase}funcoes/listar`

                axios.get(url)
                    .then(response => {
                    this.funcoes = response.data;
                })
                    .catch(errors => {
                    this.funcoes = errors.response.data.msg;
                });
            },
/*
            carregarProvincias(){
                axios.get(this.urlProvincias)
                    .then(response => {
                    this.provinciasDoMunicipio = response.data
                    })

                    .catch(errors =>{
                        this.provinciasDoMunicipio = errors.response.data.msg
                    })
            }, */


/*             obterProvinciaPorID(provincia_id){

                const urlProvincia = this.urlProvincias+'/'+provincia_id

                console.log(urlProvincia);
                axios.get(urlProvincia)
                    .then(response => {
                    this.provinciaDoMunicipio = response.data
                    })

                    .catch(errors =>{
                        this.provinciaDoMunicipio = errors.response.data.msg
                })
            }, */

            salvar(){

                const formData = new FormData();
                formData.append('Designacao_Funcao', this.funcaoFornecida)
                formData.append('Sigla_Funcao', this.siglaFornecida)

                let config = {
                    headers: {
                        'Content.Type': 'multipart/form-data'
                    }
                }

                const url = `${this.urlBase}funcao`

                axios.post(url, formData, config)
                    .then(response => {
                        this.listarFuncoes();
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = {
                            mensagem: "Função adicionada com sucesso"
                        }

                        this.funcaoFornecida=""
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

 /*            atualizar(){

                let formData = new FormData()
                formData.append('_method', 'patch')
                formData.append('Designacao_Municipio', this.$store.state.item.Designacao_Municipio)
                formData.append('Codigo_Municipio', this.$store.state.item.Codigo_Municipio)
                formData.append('provincia_id', this.proviciaSelecionada)

                let url = this.urlBase+'/'+this.$store.state.item.id;
                console.log( this.proviciaSelecionada);

                let config = {

                    headers: {
                        'Content.Type': 'multipart/form-data'
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.$store.state.transacao.status = 'atualizado'
                        this.$store.state.transacao.mensagem = "Registos da Município Atualizado com sucesso"
                        //console.log('Atualizado', response)
                        this.carregarMunicipios()
                    })
                    .catch(errors => {
                        this.$store.state.transacao.status = 'erro'
                        this.$store.state.transacao.mensagem = errors.response.data.message
                        this.$store.state.transacao.dados = errors.response.data.errors
                    })
                },

                remover(){

                    let url = this.urlBase+'/'+this.$store.state.item.id;

                    const formData = new FormData();
                    formData.append('_method','delete')

                    axios.post(url, formData)
                        .then(response => {

                            this.$store.state.transacao.status = 'removido'
                            this.$store.state.transacao.mensagem = response.data.msg
                            this.carregarMunicipios();
                        })

                        .catch(errors => {
                            this.$store.state.transacao.status = 'erro'
                            this.$store.state.transacao.mensagem = errors.response.data.msg
                        })
                }, */

        },

        mounted() {
            this.listarFuncoes();
            this.carragarDadosDoUtilizador();
        },
    }
</script>
