<template>

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
                        <input type="text" class="form-control" id="designacaoFuncao" aria-describedby="idHelp" placeholder="Designaçao da Função" >
                        <span class="icon-input"><i class="bi bi-person-lines-fill"></i></span>
                    </input-container-component>
                </div>

                <div class="col-md-6 mb-3">
                    <input-container-component titulo="Sigla da Função:" id="siglaFuncao" id-help="siglaHelp" texto-ajuda="Informe a Sigla da Função">
                        <input type="text" class="form-control" id="siglaFuncao" aria-describedby="idHelp" placeholder="Sigla da Função" >
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

            <hr>

            <div class="row">
                <div class="col-md-3 form-floating" id="filter">
                    <h2 class="">Funções</h2>
                </div>

                <div class="col-md-6"></div>

                <div class="col-md-3 col-btn">
                    <buttonComponent-component class="button-component" data-bs-toggle="modal" data-bs-target="#FuncoesModal">
                        <template v-slot:icon><i class="bi bi-plus-circle"></i></template>
                        <template v-slot:conteudo>Adicionar</template>
                    </buttonComponent-component>
                </div>
            </div>

            <hr>

                <div class="card mt-3">
                    <div class="card-header"> Lista de Funções </div>
                    <div class="card-body">
                        <table class="table table-striped table-borderless table-hover table-bordered ">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Função</th>
                                    <th scope="col">Adicionado em:</th>
                                    <th scope="col">Nº Membros</th>
                                    <th scope="col"><i class="bi bi-tools"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <th>
                                        <i class="bi bi-eye-fill"></i>
                                        <i class="bi bi-pencil-square"></i>
                                        <i class="bi bi-trash-fill"></i>
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                    <th>
                                        <i class="bi bi-eye-fill"></i>
                                        <i class="bi bi-pencil-square"></i>
                                        <i class="bi bi-trash-fill"></i>
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                    <th>
                                        <i class="bi bi-eye-fill"></i>
                                        <i class="bi bi-pencil-square"></i>
                                        <i class="bi bi-trash-fill"></i>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <footer class="blockquote-footer mt-3">Atualizado em:<cite title="Source Title">20-05-2023 07:34:00:00</cite></footer>
                    </div>
            </div>
            </div>
            <div class="col-md-1"></div>

        </div>
    </div>
</template>



<style scoped>
    @import '../../css/provincias.css';
    @import '../../css/modal.css';
</style>

<script>

    import axios from 'axios';
    export default {

        data() {
            return {
                urlBase: "http://127.0.0.1:8000/api/municipio",
                urlProvincias: "http://127.0.0.1:8000/api/provincia",
                designacaoMunicipioFornecido: "",
                siglaMunicipioFornecida: "",
                proviciaSelecionada: "",
                transacaoStatus: "",
                transacaoDetalhes: {},
                municipios: [],
                provinciasDoMunicipio: [],
                provinciaDoMunicipio: [],
                provincia_id: ""

            };
        },

        methods: {
            setStore(obj) {
                this.$store.state.transacao.status = 'avisar'
                this.$store.state.transacao.mensagem = ''
                this.$store.state.transacao.dados = ''
                this.$store.state.item = obj
                this.provincia_id = obj.provincia_id
                this.obterProvinciaPorID(this.provincia_id)
            },

            carregarMunicipios() {

                axios.get(this.urlBase)
                    .then(response => {
                    this.municipios = response.data;
                })
                    .catch(errors => {
                    this.municipios = errors.response.data.msg;
                });
            },

            carregarProvincias(){
                axios.get(this.urlProvincias)
                    .then(response => {
                    this.provinciasDoMunicipio = response.data
                    })

                    .catch(errors =>{
                        this.provinciasDoMunicipio = errors.response.data.msg
                    })
            },


            obterProvinciaPorID(provincia_id){

                const urlProvincia = this.urlProvincias+'/'+provincia_id

                console.log(urlProvincia);
                axios.get(urlProvincia)
                    .then(response => {
                    this.provinciaDoMunicipio = response.data
                    })

                    .catch(errors =>{
                        this.provinciaDoMunicipio = errors.response.data.msg
                })
            },

            salvar(){

                const formData = new FormData();
                formData.append('Designacao_Municipio', this.designacaoMunicipioFornecido)
                formData.append('Codigo_Municipio', this.siglaMunicipioFornecida)
                formData.append('provincia_id', this.proviciaSelecionada)

                let config = {
                    headers: {
                        'Content.Type': 'multipart/form-data'
                    }
                }

                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.carregarMunicipios();
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = {
                            mensagem: "Município adicionado com sucesso"
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
                },

        },

        mounted() {
            this.carregarMunicipios();
            this.carregarProvincias();
            this.obterProvinciaPorID();
        },
    }
</script>
