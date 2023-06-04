<template>

<!--         <accordion-component
                    v-for="localidade in this.localidadesDoMunicipio" :key="localidade.municipio_id"
                    class="bi bi-geo-alt-fill"
                    :id="'localidade'+localidade.municipio_id"
                    :parentId="'localidade'+localidade.municipio_id"
                    :dataBsParent="'#localidade'+localidade.municipio_id"
                    :dataBsTarget="'#localidade'+localidade.municipio_id"
                    :aria-controls="'localidade'+localidade.municipio_id"
                    :titulo="localidade.provincia+' -'+localidade.municipio" :subtitulo="localidade.numero_localidades+' Localidade(s)'"
                    >
            <template v-slot:icone_i><i class="bi bi-geo" id="icon-location"></i></template>
            <template v-slot:items>
                <ul class="list-group">
                    <li class="list-group-item"  v-for="itemlocalidade, item in localidade.localidades"  :key="itemlocalidade.id">
                        <h5><i class="bi bi-geo-alt-fill"></i> {{ itemlocalidade.localidade }}</h5>
                        <div class="mYBtn-group">
                            <slot name="butrons"></slot>
                            <button type="button" class="btn btn-success mr" data-bs-toggle="modal" data-bs-target="#editarlocalidadeModal" @click="setStore(itemlocalidade)">
                                <i class="bi bi-pencil-square"></i> Editar
                            </button>

                            <button type="button" class="btn btn-danger ml-3" data-bs-toggle="modal" data-bs-target="#removerlocalidadeModal" @click="setStore(itemlocalidade)">
                                <i class="bi bi-trash3-fill"></i> Remover
                            </button>
                        </div>

                    </li>
                </ul>
            </template>
        </accordion-component> -->



        <!--ADICIONAR LOCALIDADE-->
        <modal-component id="localidadeModal" titulo="Editar Localidade">

                <template v-slot:alertas>
                    <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Registo Realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                    <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar Registar Província" v-if="transacaoStatus == 'erro'"></alert-component>
                </template>

                <template v-slot:conteudo>
                    <form>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <input-container-component titulo="Província:" id="designacaoProvincia" id-help="designacaoHelp" texto-ajuda="Informe a Designação da Província">
                                    <select class="form-select" aria-label="Default select example" v-model="proviciaSelecionada" @change="obterMunicipioDaPrvincia(proviciaSelecionada)">
                                        <option value="">Selecinar</option>
                                        <option v-for="provincia in provinciasMunicipios" :key="provincia.id" :value="provincia.id">{{ provincia.Designacao_Provincia }} </option>
                                    </select>
                                    <span class="icon-input"><i class="bi bi-map-fill"></i></span>
                                </input-container-component>
                            </div>

                            <div class="col-md-3 mb-3">
                                <input-container-component titulo="Município:" id="designacaoMunicipio" id-help="designacaoHelp" texto-ajuda="Informe o Município">
                                    <select class="form-select" aria-label="Default select example" v-model="municipioSelecionado">
                                        <option value="">Selecionar</option>
                                        <option v-for="municipio in municipios" :key="municipio.id" :value="municipio.id">{{ municipio.Designacao_Municipio }}</option>
                                    </select>
                                    <span class="icon-input"><i class="bi bi-pin-map-fill"></i></span>
                                </input-container-component>
                            </div>

                            <div class="col-md-6 mb-3">
                                <input-container-component titulo="Designação da Localidade:" id="designacaoLocalidade" id-help="siglaHelp" texto-ajuda="Informe a Localidade">
                                    <input type="text" class="form-control" id="siglaProvincia" aria-describedby="idHelp" placeholder="Desgnação da Localidade" v-model="designacaoLocalidade">
                                    <span class="icon-input"><i class="bi bi-geo-fill"></i></span>
                                </input-container-component>

                            </div>
                        </div>
                    </form>
                </template>

                <template v-slot:rodape>
                    <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-principal" @click="salvar()">Salvar</button>
                </template>
        </modal-component><!--ADICIONAR LOCALIDADE-->

        <!--ATUALIZAR LOCALIDADE-->
        <modal-component id="editarLocalidadeModal" titulo="Editar Localidade">
            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Registo Realizado com sucesso" v-if="transacaoStatus == 'atualizado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar Registar Província" v-if="transacaoStatus == 'erro'"></alert-component>
            </template>

            <template v-slot:conteudo>
                <form>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <input-container-component titulo="Província:" id="designacaoProvincia" id-help="designacaoHelp" texto-ajuda="Informe a Designação da Província">
                                <select class="form-select" aria-label="Default select example" v-model="proviciaSelecionada" @change="obterMunicipioDaPrvincia(proviciaSelecionada)">
                                    <option value="">{{ this.provinciaDaLocalidade.Designacao_Provincia }}</option>
                                    <option v-for="provincia in this.provinciasMunicipios" :key="provincia.id" :value="provincia.id">{{ provincia.Designacao_Provincia }} </option>
                                </select>
                                <span class="icon-input"><i class="bi bi-map-fill"></i></span>
                            </input-container-component>
                        </div>

                        <div class="col-md-3 mb-3">
                            <input-container-component titulo="Município:" id="designacaoMunicipio" id-help="designacaoHelp" texto-ajuda="Informe o Município">
                                <select class="form-select" aria-label="Default select example" v-model="municipioSelecionado">
                                    <option :value="this.municipioDaLocalidade.id"> {{ this.municipioDaLocalidade.Designacao_Municipio }}</option>
                                    <option v-for="municipio in municipios" :key="municipio.id" :value="municipio.id">{{ municipio.Designacao_Municipio }}</option>
                                </select>
                                <span class="icon-input"><i class="bi bi-pin-map-fill"></i></span>
                            </input-container-component>
                        </div>

                        <div class="col-md-6 mb-3">
                            <input-container-component titulo="Designação da Localidade:" id="designacaoLocalidade" id-help="siglaHelp" texto-ajuda="Informe a Localidade">
                                <input type="text" class="form-control" id="siglaProvincia" aria-describedby="idHelp" placeholder="Desgnação da Localidade" v-model="this.designacaoLocalidade">
                                <span class="icon-input"><i class="bi bi-geo-fill"></i></span>
                            </input-container-component>
                        </div>
                    </div>
                </form>
            </template>

            <template v-slot:rodape>
                <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-principal" @click="atualizar()">Atualizar</button>
            </template>
        </modal-component><!--ADICIONAR LOCALIDADE-->

    <div class="container  margem-top">
        <div class="row  mt-5">

            <div class="col-md-1"></div>

            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3 form-floating" id="filter">
                        <h2 class="">Localidades</h2>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3 col-float-right">
                        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#localidadeModal" v-if="admin"><i class="bi bi-plus"></i></button>
                    </div>
                </div>

                <hr>

                <table class="table table-striped table-borderless table-hover table-bordered ">
                    <thead class="tableHeader">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Localidade</th>
                            <th scope="col">Município</th>
                            <th scope="col">Provínca</th>
                            <th scope="col">Nº de Coordenações</th>
                            <th scope="col"><i class="bi bi-tools"></i></th>
                        </tr>
                    </thead>
                    <tbody v-for="localidade in localidadesDoMunicipio" :key="localidade.id">
                        <tr  v-for="itemlocalidade, item in localidade.localidades"  :key="itemlocalidade.id">
                            <td class="text-center" scope="row">
                                <img src="../../../public/imagens/bandeira-angola.png" class="item-img" alt="...">
                            </td>
                            <td>{{ itemlocalidade.localidade }}</td>
                            <td>{{ localidade.municipio }}</td>
                            <td>{{ localidade.provincia }}</td>
                            <td>--</td>
                            <th class="tools text-center">
                                <i class="bi bi-eye-fill view"  @click="setStore(itemlocalidade)"></i>
                                <i class="bi bi-pencil-square edit" data-bs-toggle="modal" data-bs-target="#editarLocalidadeModal" @click="setStore(itemlocalidade)" v-if="admin"></i>
                                <i class="bi bi-trash-fill delete" data-bs-toggle="modal" data-bs-target="#removerLocalidadeModal" @click="setStore(itemlocalidade)" v-if="admin"></i>
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
    @import '../../css/locais.css';
    @import '../../css/modal.css';
    @import '../../css/accordion.css';
</style>

<script>
    import axios from 'axios';
    import { mapState } from 'vuex';

    export default {
        data(){
            return{
                urlBase: import.meta.env.VITE_API_URL,
                provincias: "",
                provinciasMunicipios: "",
                provinciasComMunicipios:[],
                municipios: "",
                localidadesDoMunicipio:[],
                designacaoLocalidade: "",
                localidade: "",
                proviciaSelecionada:"",
                municipioSelecionado:"",
                municipioDaLocalidade:"",
                provinciaDaLocalidade: "",
                permissao: "",
                admin: false,

                transacaoStatus: "",
                transacaoDetalhes: {},
            };
        },

   /*      computed: {

        }, */

        methods:{

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

            setStore(itemlocalidade){
                this.$store.state.transacaoStatus =''
                this.$store.state.transacao.mensagem=''
                this.$store.state.transacao=''
                this.$store.state.item = itemlocalidade
                this.designacaoLocalidade = itemlocalidade
                this.obterLocalidadePorID(this.designacaoLocalidade)
            },

            carregarProvincias(){
                const url = `${this.urlBase}provincia`
                axios.get(url)
                     .then( response =>{
                        this.provincias = response.data
                     })
                     .catch(error =>{
                        this.provincias = error.response.data
                     })
            },

            obterProvinciaComMunicipio(){
                const url = `${this.urlBase}provinciasComMunicipios`
                axios.get(url)
                    .then(response => {
                        this.provinciasMunicipios = response.data
                    }).catch(error => { })
            },

            obterLocalidadesdeMunicipio(){

                const url = `${this.urlBase}localidades_de_municipios`

                axios.get(url)
                     .then(response =>{

                        const localidade =  response.data.reduce( (acc, current) => {

                            const provincia = current.Designacao_Provincia
                            const municipio = current.Designacao_Municipio
                            const municipio_id = current.municipio_id
                            const localidade = current.Designacao_Localidade
                            const id = current.id

                            const municipioExistente = acc.find(item => item.municipio == municipio )

                            if(municipioExistente){

                                municipioExistente.numero_localidades++
                                municipioExistente.localidades.push({id: id, localidade: localidade})

                            } else{

                                acc.push({provincia, municipio_id, municipio, numero_localidades: 1, localidades: [{id: id, localidade: localidade}]});
                            }

                            return acc;

                        }, []);

                        this.localidadesDoMunicipio = localidade;

                    })
                     .then(error => {//
                });
            },

            obterProvinciaPorID(provincia_id){
                const url = `${this.urlBase}provincia/${provincia_id}`
                axios(url).then( response => {
                    this.provinciaDaLocalidade = response.data

                }).catch(error => { });
            },

            obterMunicipioPorID(municipio_id){
                const url = `${this.urlBase}municipio/${municipio_id}`
                axios(url).then( response => {
                    this.municipioDaLocalidade = response.data
                    this.obterProvinciaPorID(response.data.provincia_id)

                }).catch(error => { });
            },

            obterMunicipioDaPrvincia(provincia_id){
                const url = `${this.urlBase}municipio/?filtro=provincia_id:=:${provincia_id}`
                axios.get(url)
                     .then(response =>{
                        this.municipios = response.data })
                     .then(error => {//
                      });
            },

            obterLocalidadePorID(localidade){
                const url = `${ this.urlBase}localidade/${localidade.id}`
                axios.get(url)
                    .then(response =>{
                        this.designacaoLocalidade = response.data.Designacao_Localidade
                        this.obterMunicipioPorID(response.data.municipio_id)
                    })
                    .catch(error => {//
                });
            },

            salvar(){
                let config = {
                    headers:{
                        'content.Type': 'multpart/form-data'
                    }
                }
                const formData = new FormData()
                formData.append('Designacao_Localidade', this.designacaoLocalidade)
                formData.append('municipio_id', this.municipioSelecionado)

                const url = `${this.urlBase}localidade`
                axios.post(url, formData, config)
                    .then(response =>{
                        this.transacaoStatus='adicionado'
                        this.transacaoDetalhes = {
                            mensagem: "Nova Localidade Registada com sucesso"
                        }
                        this.obterLocalidadesdeMunicipio()
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
                formData.append('Designacao_Localidade', this.designacaoLocalidade)
                formData.append('municipio_id', this.municipioSelecionado)

                let url = `${this.urlBase}localidade/${this.$store.state.item.id}`

                let config = {
                    headers: { 'Content.Type': 'multipart/form-data'}
                }

                axios.post(url, formData, config)
                    .then(response => {
                        this.transacaoStatus='atualizado'
                        this.transacaoDetalhes = {
                            mensagem: "Registos da Localidade Atualizado com sucesso"
                        }
                        this.obterLocalidadesdeMunicipio()
                    })
                    .catch(errors => {
                        this.store.state.transacao.status = 'erro'
                        this.$store.state.transacao.mensagem = errors.response.data.message
                        this.$store.state.transacao.dados = errors.response.data.errors
                })
            },
        },

        computed:{
            titulos(){
                return this.provinciasComMunicipios.map(provincia => {
                    return provincia.municipios.map(municipio => {
                        const provinciaMunicipio_C = `${provincia.Designacao_Provincia} - ${municipio.Designacao_Municipio}`
                        return [provinciaMunicipio_C, municipio.id]
                    })

                }).flat()
            },

            ...mapState(['user']),
            usuario(){
                const usuario = this.user && this.user[0] ? this.user[0] : '';
                this.carragarDadosDoUtilizador(usuario)
                return this.user && this.user[0] ? this.user[0] : '';
            },
        },

        mounted(){
            this.carregarProvincias()
            this.obterProvinciaComMunicipio()
            this.obterLocalidadesdeMunicipio()
            this.obterLocalidadePorID()
            this.obterMunicipioPorID()
            this.obterProvinciaPorID()
            this.obterMunicipioDaPrvincia()
            this.carragarDadosDoUtilizador();
        }
    }

</script>
