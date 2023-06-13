<template>

        <!--ADICIONAR PROVÍNCIA-->
        <modal-component id="provinciaModal" titulo="Adicionar provinciade">

            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Registo Realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar Registar Província" v-if="transacaoStatus == 'erro'"></alert-component>
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
                <button type="button" class="btn btn-principal" @click="salvar()">Salvar</button>
            </template>
        </modal-component><!--ADICIONAR PROVÍNCIA-->


        <!-- ATUALIZAR DADOS DA PROVÍNCIA-->
        <modal-component id="editarProvinciaModal" titulo="Editar dados da Provincia">
            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="this.$store.state.transacao" titulo="" v-if="$store.state.transacao.status == 'atualizado'"></alert-component>
                <alert-component tipo="danger" :detalhes="this.$store.state.transacao" titulo="" v-if="$store.state.transacao.status == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>

                <form>
                    <div class="row">

                        <div class="col-md-2 mb-3">
                            <input-container-component titulo="ID Província:" id="idProvincia" id-help="designacaoHelp">
                                <input type="text" class="form-control" id="idProvincia" aria-describedby="idHelp" texto-ajuda="" :value="$store.state.item.id" disabled>
                                <span class="icon-input"><i class="bi bi-tags"></i></span>
                            </input-container-component>
                        </div>

                        <div class="col-md mb-3">
                            <input-container-component titulo="Designação Província:" id="atualizarDesignacaoProvincia" id-help="designacaoHelp" texto-ajuda="Atualizar Designação da Província">
                                <input type="text" class="form-control" id="atualizarDesignacaoProvincia" aria-describedby="idHelp" placeholder="Designação da Província" v-model="$store.state.item.Designacao_Provincia">
                                <span class="icon-input"><i class="bi bi-map-fill"></i></span>
                            </input-container-component>
                        </div>

                        <div class="col-md-4 mb-3">
                            <input-container-component titulo="Sigla da Província:" id="atualizarSiglaProvincia" id-help="siglaHelp" texto-ajuda="Atualizar Sigla da Província">
                                <input type="text" class="form-control" id="atualizarSiglaProvincia" aria-describedby="idHelp" placeholder="Sigla da Província" v-model="$store.state.item.Codigo_Provincia">
                                <span class="icon-input"><i class="bi bi-bookmark-fill"></i></span>
                            </input-container-component>

                        </div>

                    </div>

                </form>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-principal" @click="atualizar()">Atualizar</button>
            </template>
        </modal-component> <!--ATUALIZAR DADOS DA PROVÍNCIA-->


        <!--REMOVER PROVÍNCIA-->
        <modal-component id="removerProvinciaModal" titulo="Remover Provincia">
            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="this.$store.state.transacao" titulo="" v-if="$store.state.transacao.status == 'removido'"></alert-component>
                <alert-component tipo="warning" :detalhes=" {mensagem: 'Tem Certeza que pretende remover a província'+ ' ' + $store.state.item.Designacao_Provincia+' ?'}" titulo="" v-if="$store.state.transacao.status == 'avisar'"></alert-component>
                <alert-component tipo="danger" :detalhes="this.$store.state.transacao" titulo="" v-if="$store.state.transacao.status == 'erro'"></alert-component>
            </template>

            <template v-slot:conteudo>

                <form>
                    <div class="row">

                        <div class="col-md-12">
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
                <button type="button" class="btn btn-danger" @click="remover()" v-if="$store.state.transacao.status != 'removido'">Eliminar</button>
            </template>
        </modal-component> <!--REMOVER PROVÍNCIA-->

   <!--  </div> -->


    <div class="container  margem-top">
        <div class="row  mt-5">

            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3 form-floating" id="filter">
                        <h2 class="">Províncias</h2>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3 col-float-right">
                        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#provinciaModal" v-if="admin"><i class="bi bi-plus"></i></button>
                    </div>
                </div>

                <hr>

                <table class="table table-striped table-borderless table-hover table-bordered ">
                    <thead class="tableHeader">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Província</th>
                            <th scope="col">Sigla</th>
                            <th scope="col">Nº de Municípios</th>
                            <th scope="col">Nº de Lolalidades</th>
                            <th scope="col"><i class="bi bi-tools"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="provinia in provincias" :key="provinia.id" :titulo="provinia.Designacao_Provincia+' - '+provinia.Codigo_Provincia">
                            <td class="text-center" scope="row">
                                <img src="../../../../public/imagens/bandeira-angola.png" class="item-img" alt="...">
                            </td>
                            <td>{{ provinia.Designacao_Provincia }}</td>
                            <td>{{ provinia.Codigo_Provincia }}</td>
                            <td>--</td>
                            <td>--</td>
                            <th class="tools text-center">
                                <i class="bi bi-eye-fill view" @click="setStore(provinia)"></i>
                                <i class="bi bi-pencil-square edit" data-bs-toggle="modal" data-bs-target="#editarProvinciaModal" @click="setStore(provinia)" v-if="admin"></i>
                                <i class="bi bi-trash-fill delete" data-bs-toggle="modal" data-bs-target="#removerProvinciaModal"  @click="setStore(provinia)" v-if="admin"></i>
                            </th>
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

        data() {
            return {
                urlBase: import.meta.env.VITE_API_URL,
                designacaoProvinciaFornecido: "",
                siglaProvinciaFornecida: "",
                transacaoStatus: "",
                transacaoDetalhes: {},
                provincias: [],
                permissao: "",
                admin: false,
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
                        }
                })
            },

            setStore(obj) {
                this.$store.state.transacao.status = 'avisar'
                this.$store.state.transacao.mensagem = ''
                this.$store.state.transacao.dados = ''
                this.$store.state.item = obj
            },

            carregarProvincias() {

                const url = `${this.urlBase}provincia`

                axios.get(url)
                    .then(response => {
                    this.provincias = response.data;
                })
                    .catch(errors => {
                    this.provincias = errors.response.data.msg;
                });
            },

            salvar(){

                const formData = new FormData();
                formData.append('Designacao_Provincia', this.designacaoProvinciaFornecido)
                formData.append('Codigo_Provincia', this.siglaProvinciaFornecida)

                let config = {
                    headers: {
                        'Content.Type': 'multipart/form-data'
                    }
                }

                const url = `${this.urlBase}provincia`

                axios.post(url, formData, config)
                    .then(response => {
                        this.carregarProvincias();
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
            },

            atualizar(){

                let formData = new FormData()
                formData.append('_method', 'patch')
                formData.append('Designacao_Provincia', this.$store.state.item.Designacao_Provincia)
                formData.append('Codigo_Provincia', this.$store.state.item.Codigo_Provincia)

                let url = `${this.urlBase}provincia/${this.$store.state.item.id}`

                let config = {

                    headers: {
                        'Content.Type': 'multipart/form-data'
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.$store.state.transacao.status = 'atualizado'
                        this.$store.state.transacao.mensagem = "Registas da Província Atualizado com sucesso"
                        this.carregarProvincias()
                    })
                    .catch(errors => {
                        this.$store.state.transacao.status = 'erro'
                        this.$store.state.transacao.mensagem = errors.response.data.message
                        this.$store.state.transacao.dados = errors.response.data.errors
                    })
            },

            remover(){

                //let url = this.urlBase+'/'+this.$store.state.item.id;
                let url = `${this.urlBase}provincia/${this.$store.state.item.id}`

                const formData = new FormData();
                formData.append('_method','delete')

                axios.post(url, formData)
                    .then(response => {

                        this.$store.state.transacao.status = 'removido'
                        this.$store.state.transacao.mensagem = response.data.msg
                        this.carregarProvincias();
                    })

                    .catch(errors => {
                        this.$store.state.transacao.status = 'erro'
                        this.$store.state.transacao.mensagem = errors.response.data.msg
                    })
            },

        },

        mounted() {
            this.carregarProvincias();
            this.carragarDadosDoUtilizador();
        },
    }
</script>
