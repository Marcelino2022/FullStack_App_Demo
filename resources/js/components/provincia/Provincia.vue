<template>

    <div class="container mt-3">

        <!--adicionarProvincia-component></adicionarProvincia-component-->
        <!--editarProvincia-component></editarProvincia-component-->
        <!--removerProvincia-component></removerProvincia-component-->

        <h2 class="margem-top">Províncias</h2>

        <hr class="mb-3">

        <div class="row mb-3">
            <div class="col-md-3 form-floating" id="filter">

                <select-component class="bi bi-filter-circle-fill">
                    <template v-slot:optionSelected>Todas as Províncias</template>
                    <template v-slot:option>
                        <option v-for="obj in provincias" :key="obj.id" :value="obj.id"> {{ obj.Designacao_Provincia }}</option>
                    </template>
                    <template v-slot:labelContent>Clique aqui para filtrar </template>
                </select-component>

            </div>

            <div class="col-md-6"></div>

            <div class="col-md-3 mt-1 col-btn">
                <buttonComponent-component class="button-component" data-bs-toggle="modal" data-bs-target="#provinciaModal">
                    <template v-slot:icon><i class="bi bi-plus-circle"></i></template>
                    <template v-slot:conteudo>Adicionar Província</template>
                </buttonComponent-component>
            </div>

        </div>

        <hr class="mb-3">


        <card-component v-for="obj in provincias" :key="obj.id" :titulo="obj.Designacao_Provincia+' - '+obj.Codigo_Provincia">
            <template v-slot:image> <img src="../../../../public/imagens/bandeira-angola.png" class="float-start avatar" alt="..."></template>

            <template v-slot:rodape>
                <div class="mb-2"><i class="bi bi-building icon-color"></i> -- Coordenações</div>
                <div class="mb-2 ml-5"><i class="bi bi-pin-map-fill icon-color"></i> -- Municípios </div>
                <div class="mb-2 ml-5"><i class="bi bi-geo-alt-fill icon-color"></i> -- Localidades </div>

                <div class="mb-2 ml-5">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarProvinciaModal" @click="setStore(obj)">
                        <i class="bi bi-pencil-square"></i> Editar
                    </button>
                </div>

                <div class="mb-2 ml-5">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removerProvinciaModal" @click="setStore(obj)">
                        <i class="bi bi-trash3-fill"></i> Remover
                    </button>
                </div>
            </template>

        </card-component>


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
                <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" @click="remover()" v-if="$store.state.transacao.status != 'removido'">Eliminar</button>
            </template>
        </modal-component> <!--REMOVER PROVÍNCIA-->

    </div>

</template>

<style scoped>
    @import '../../../css/provincias.css';
    @import '../../../css/modal.css';
</style>

<script>
    import axios from 'axios';

    export default {

        data() {
            return {
                urlBase: "http://127.0.0.1:8000/api/provincia",
                designacaoProvinciaFornecido: "",
                siglaProvinciaFornecida: "",
                transacaoStatus: "",
                transacaoDetalhes: {},
                provincias: []
            };
        },
        methods: {

            setStore(obj) {

                this.$store.state.transacao.status = 'avisar'
                this.$store.state.transacao.mensagem = ''
                this.$store.state.transacao.dados = ''
                this.$store.state.item = obj
            },

            carregarProvincias() {

                axios.get(this.urlBase)
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

                axios.post(this.urlBase, formData, config)
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

                let url = this.urlBase+'/'+this.$store.state.item.id;

                let config = {

                    headers: {
                        'Content.Type': 'multipart/form-data'
                    }
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.$store.state.transacao.status = 'atualizado'
                        this.$store.state.transacao.mensagem = "Registas da Província Atualizado com sucesso"
                        console.log('Atualizado', response)
                        this.carregarProvincias()
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
        },
    }
</script>
