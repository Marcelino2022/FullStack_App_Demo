<template>

    <div class="container mt-3">

        <!--adicionarmunicipio-component></adicionarmunicipio-component-->
        <!--editarmunicipio-component></editarmunicipio-component-->
        <!--removermunicipio-component></removermunicipio-component-->

   <!--      <h2 class="margem-top">Municípios</h2>

        <hr class="mb-3">

        <div class="row mb-3">
            <div class="col-md-3 form-floating" id="filter">
                <select-component class="bi bi-filter-circle-fill">
                    <template v-slot:optionSelected>Todas os Municípios</template>
                    <template v-slot:option>
                        <option v-for="obj in municipios" :key="obj.id" :value="obj.id"> {{ obj.Designacao_Municipio }}</option>
                    </template>
                    <template v-slot:labelContent>Clique aqui para filtrar </template>
                </select-component>
            </div>

            <div class="col-md-6"></div>

            <div class="col-md-3 mt-1 col-btn">
                <buttonComponent-component class="button-component" data-bs-toggle="modal" data-bs-target="#municipioModal">
                    <template v-slot:icon><i class="bi bi-plus-circle"></i></template>
                    <template v-slot:conteudo>Adicionar Município</template>
                </buttonComponent-component>
            </div>

        </div>

        <hr class="mb-3">


        <card-component v-for="municipio in municipios" :key="municipio.id" :titulo="municipio.Designacao_Municipio">
            <template v-slot:image> <img src="../../../public/imagens/bandeira-angola.png" class="float-start avatar" alt="..."></template>

            <template v-slot:rodape>
                <div class="mb-2"><i class="bi bi-building icon-color"></i> -- Coordenações</div>
                <div class="mb-2 ml-5"><i class="bi bi-pin-map-fill icon-color"></i> -- Municípios </div>
                <div class="mb-2 ml-5"><i class="bi bi-geo-alt-fill icon-color"></i> -- Localidades </div>

                <div class="mb-2 ml-5">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarmunicipioModal" @click="setStore(municipio)">
                        <i class="bi bi-pencil-square"></i> Editar
                    </button>
                </div>

                <div class="mb-2 ml-5">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#removermunicipioModal" @click="setStore(municipio)">
                        <i class="bi bi-trash3-fill"></i> Remover
                    </button>
                </div>
            </template>

        </card-component>
 -->

        <!--ADICIONAR Município-->
        <modal-component id="municipioModal" titulo="Adicionar Município">

            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Registo Realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar Registar Município" v-if="transacaoStatus == 'erro'"></alert-component>
            </template>

            <template v-slot:conteudo>
                <form>
                    <div class="row">

                        <div class="col-md-4" id="filter">
                            <input-container-component titulo="Município da Provínca:" id="procinciaMunicipio" id-help="procinciaMunicipioHelp" texto-ajuda="Informe a Província do Município">
                                <select class="form-select" aria-label="Default select example" v-model="proviciaSelecionada">
                                    <!--option selected>Clique aqui para Selecionar</option-->
                                    <option v-for="provincia in provinciasDoMunicipio" :key="provincia.id" :value="provincia.id"> {{ provincia.Designacao_Provincia }} </option>
                                </select>
                                <span class="icon-input"><i class="bi bi-map-fill"></i></span>
                            </input-container-component>
                        </div>

                        <div class="col-md-4 mb-3">
                            <input-container-component titulo="Designação Município:" id="designacaoMunicipio" id-help="designacaoHelp" texto-ajuda="Informe a Designação da Município">
                                <input type="text" class="form-control" id="designacaoMunicipio" aria-describedby="idHelp" placeholder="Designaçao do Município" v-model="designacaoMunicipioFornecido">
                                <span class="icon-input"><i class="bi bi-pin-map-fill"></i></span>
                            </input-container-component>
                        </div>

                        <div class="col-md-4 mb-3">
                            <input-container-component titulo="Sigla da Município:" id="siglaMunicipio" id-help="siglaHelp" texto-ajuda="Informe a Sigla do Município">
                                <input type="text" class="form-control" id="siglaMunicipio" aria-describedby="idHelp" placeholder="Sigla da Município" v-model="siglaMunicipioFornecida">
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
        </modal-component><!--ADICIONAR Município-->


        <!-- ATUALIZAR DADOS DA Município-->
        <modal-component id="editarMunicipioModal" titulo="Editar dados da municipio">
            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="this.$store.state.transacao" titulo="" v-if="$store.state.transacao.status == 'atualizado'"></alert-component>
                <alert-component tipo="danger" :detalhes="this.$store.state.transacao" titulo="" v-if="$store.state.transacao.status == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>

                <form>
                    <div class="row">

                        <div class="col-md-2 mb-3">
                            <input-container-component titulo="ID Município:" id="idmunicipio" id-help="designacaoHelp">
                                <input type="text" class="form-control" id="idmunicipio" aria-describedby="idHelp" texto-ajuda="" :value="$store.state.item.id" disabled>
                                <span class="icon-input"><i class="bi bi-tags"></i></span>
                            </input-container-component>
                        </div>

                        <div class="col-md-4 mb-3">
                            <input-container-component titulo="Designação Município:" id="atualizarDesignacaomunicipio" id-help="designacaoHelp" texto-ajuda="Atualizar Designação da Município">
                                <input type="text" class="form-control" id="atualizarDesignacaomunicipio" aria-describedby="idHelp" placeholder="Designação da Município" v-model="$store.state.item.Designacao_Municipio">
                                <span class="icon-input"><i class="bi bi-pin-map-fill"></i></span>
                            </input-container-component>
                        </div>

                        <div class="col-md-3 mb-3">
                            <input-container-component titulo="Sigla da Município:" id="atualizarSiglamunicipio" id-help="siglaHelp" texto-ajuda="Atualizar Sigla da Município">
                                <input type="text" class="form-control" id="atualizarSiglamunicipio" aria-describedby="idHelp" placeholder="Sigla da Município" v-model="$store.state.item.Codigo_Municipio">
                                <span class="icon-input"><i class="bi bi-bookmark-fill"></i></span>
                            </input-container-component>
                        </div>

                        <div class="col-md-3 mb-3">
                            <input-container-component titulo="Município da Provínca:" id="procinciaMunicipio" id-help="procinciaMunicipioHelp" texto-ajuda="Clique para alterar Província">
                                <select class="form-select" aria-label="Default select example" v-model="proviciaSelecionada">
                                    <option :value="provinciaDoMunicipio.id" selected> {{ provinciaDoMunicipio.Designacao_Provincia }}</option>
                                    <option v-for="provincia in provinciasDoMunicipio" :key="provincia.id" :value="provincia.id"> {{ provincia.Designacao_Provincia }}</option>
                                </select>
                                <span class="icon-input"><i class="bi bi-map-fill"></i></span>
                            </input-container-component>
                        </div>

                    </div>

                </form>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-principal" @click="atualizar()">Atualizar</button>
            </template>
        </modal-component> <!--ATUALIZAR DADOS DA Município-->


        <!--REMOVER Município-->
        <modal-component id="removerMunicipioModal" titulo="Remover municipio">

            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="this.$store.state.transacao" titulo="" v-if="$store.state.transacao.status == 'removido'"></alert-component>
                <alert-component tipo="warning" :detalhes=" {mensagem: 'Tem Certeza que pretende remover o Município'+ ' ' + $store.state.item.Designacao_municipio+' ?'}" titulo="" v-if="$store.state.transacao.status == 'avisar'"></alert-component>
                <alert-component tipo="danger" :detalhes="this.$store.state.transacao" titulo="" v-if="$store.state.transacao.status == 'erro'"></alert-component>
            </template>

            <template v-slot:conteudo>

                <form>
                    <div class="row">

                        <div class="col-md-12">
                            <input-container-component hidden titulo="ID Município:" id="designacaomunicipio" id-help="designacaoHelp">
                                <input  type="text" class="form-control" id="idmunicipio" aria-describedby="idHelp" texto-ajuda="" :value="$store.state.item.id" disabled>
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

        </modal-component> <!--REMOVER Município-->

    </div>

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
                            <th scope="col">Município</th>
                            <th scope="col">Sigla</th>
                            <th scope="col">Nº de Localidades</th>
                            <th scope="col">Nº de Coordenações</th>
                            <th scope="col"><i class="bi bi-tools"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr  v-for="municipio in municipios" :key="municipio.id">
                            <td class="text-center" scope="row">
                                <img src="../../../public/imagens/bandeira-angola.png" class="item-img" alt="...">
                            </td>
                            <td>{{ municipio.Designacao_Municipio }}</td>
                            <td>{{ municipio.Codigo_Municipio }}</td>
                            <td>--</td>
                            <td>--</td>
                            <th class="tools text-center">
                                <i class="bi bi-eye-fill view" @click="setStore(municipio)"></i>
                                <i class="bi bi-pencil-square edit" data-bs-toggle="modal" data-bs-target="#editarMunicipioModal" @click="setStore(municipio)" v-if="admin"></i>
                                <i class="bi bi-trash-fill delete" data-bs-toggle="modal" data-bs-target="#removerMunicipioModal"  @click="setStore(municipio)" v-if="admin"></i>
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
                designacaoMunicipioFornecido: "",
                siglaMunicipioFornecida: "",
                proviciaSelecionada: "",
                transacaoStatus: "",
                transacaoDetalhes: {},
                municipios: [],
                provinciasDoMunicipio: [],
                provinciaDoMunicipio: [],
                provincia_id: "",
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

                        console.log(this.permissao)

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
                this.provincia_id = obj.provincia_id
                this.obterProvinciaPorID(this.provincia_id)
            },

            carregarMunicipios() {
                const url = `${this.urlBase}municipio`;
                axios.get(url)
                    .then(response => {
                    this.municipios = response.data;
                })
                    .catch(errors => {
                    this.municipios = errors.response.data.msg;
                });
            },

            carregarProvincias(){

                const url = `${this.urlBase}provincia`
                axios.get(url)
                    .then(response => {
                    this.provinciasDoMunicipio = response.data
                    })

                    .catch(errors =>{
                        this.provinciasDoMunicipio = errors.response.data.msg
                    })
            },


            obterProvinciaPorID(provincia_id){

                const urlProvincia =`${this.urlBase}provincia/${provincia_id}`

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

                const url = `${this.urlBase}municipio`;

                axios.post(url, formData, config)
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

                let url =  `${this.urlBase}municipio`+'/'+this.$store.state.item.id;
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


                    let url = `${ this.urlBase}municipio/${this.$store.state.item.id}`
    /*                 this.urlBase+'/'+this.$store.state.item.id; */
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
            this.carragarDadosDoUtilizador();
        },
    }
</script>
