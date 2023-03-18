<template>
    <div class="container mt-3">

        <h2 class="margem-top">Localidades</h2>

        <hr>
        <div class="row">
            <div class="col-md-3 form-floating" id="filter">
                <select-component class="bi bi-filter-circle-fill">
                    <template v-slot:optionSelected>Todas as Localidades</template>
                    <template v-slot:option>
                        <option value="">Luanda</option>
                        <option value="">Benguela</option>
                        <option value="">Cabinda</option>
                    </template>
                    <template v-slot:labelContent>Filtrar Município por:</template>
                </select-component>
            </div>

            <div class="col-md-6"></div>

            <div class="col-md-3 mt-1 col-btn">
                <buttonComponent-component class="button-component" data-bs-toggle="modal" data-bs-target="#localidadeModal">
                    <template v-slot:icon><i class="bi bi-plus-circle"></i></template>
                    <template v-slot:conteudo>Adicionar Localidade</template>
                </buttonComponent-component>
            </div>
        </div>

        <hr>

        <!--LOCALIDADES-->
        <div v-for="provinciaMunicipio, index in titulos" :key="index">
            <div @mounted="obterLocalidadesPorMunicipio_id( provinciaMunicipio[1] )">
                <div v-if="typeof this.numero_localidades[index] == 'object'">
                    <card-component :titulo="provinciaMunicipio[0]" :subtitulo="this.numero_localidades[index][1]+' Localidade(s)'" >
                    <template v-slot:image><img src="../../../public/imagens/bandeira-angola.png" class="float-start avatar" alt="..."></template>
                    <template v-slot:localidades>
                        <accordion-component titulo="Localidades" class="bi bi-geo-alt-fill">
                            <template v-slot:items>
                                <div v-for="localidade in this.localidades" :key="localidade.id">
                                    <ul class="list-group" v-if="provinciaMunicipio[1] == localidade.municipio_id ">
                                        <li class="list-group-item">
                                            <h5 id="icon-location_2">
                                                <i class="bi bi-geo-alt-fill"></i> {{ localidade.Designacao_Localidade }}
                                            </h5>

                                            <div class="mYBtn-group">
                                                <slot name="butrons"></slot>
                                                <button type="button" class="btn btn-success mr" data-bs-toggle="modal" data-bs-target="#editarProvinciaModal" @click="setStore(obj)">
                                                    <i class="bi bi-pencil-square"></i> Editar
                                                </button>

                                                <button type="button" class="btn btn-danger ml-3" data-bs-toggle="modal" data-bs-target="#removerProvinciaModal" @click="setStore(obj)">
                                                    <i class="bi bi-trash3-fill"></i> Remover
                                                </button>
                                            </div>
                                        </li>
                                    </ul>
                                    <!--template v-slot:item_localidade>
                                        {{ provinciaMunicipio[1]}}
                                        {{ this.localidades}}
                                    </template-->
                                </div>
                            </template>
                            <template v-slot:item_localidade></template>
                        </accordion-component>
                        <div class="mt-3"></div>
                    </template>
                    <template v-slot:rodape>
                        <span class="text-muted"><small class="text-muted"></small></span>
                    </template>
                    </card-component>
                </div>
            </div>
        </div>


        <!--ADICIONAR LOCALIDADE-->
        <modal-component id="localidadeModal" titulo="Adicionar Localidade">

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
                                        <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id">{{ provincia.Designacao_Provincia }} </option>
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
    </div>
</template>

<style scoped>
    @import '../../css/locais.css';
    @import '../../css/modal.css';
    @import '../../css/accordion.css';
</style>

<script>

    import axios from 'axios';
    //import Localidade from 'localidade.js'

    export class Localidade{

        constructor(municipio_id){
            this.municipio_id = municipio_id
        }

        getmunicipioId(){
            return this.municipio_id
        }

        static criarmunicipio(municipio_id){
            const municipio = new Localidade(municipio_id)
            return municipio;
        }
    }

    export default {
        data(){
            return{
                urlBase: "http://127.0.0.1:8000/api/localidade",
                urlProvincia: "http://127.0.0.1:8000/api/provincia",
                urlMunicipio: "http://127.0.0.1:8000/api/municipio",
                provincias: "",
                provinciasComMunicipios:[],
                municipios: "",
                localidadesPorMunicipio:[],
                localidadesDoMunicipio:[],
                localidades:[],
                numero_localidades:"",
                proviciaSelecionada:"",
                municipioSelecionado:"",
                designacaoLocalidade:"",
                transacaoStatus: "",
                transacaoDetalhes: {},
                provinciaMunicipio:"",
                item_municipio:""
            }
        },

        setStore(obj){
            this.$store.state.transacaoStatus ='',
            this.$store.state.transacao.mensagem='',
            this.$store.state.transacao=''
            this.$store.state.item = obj
        },

        props:[''],
        methods:{
            carregarProvincias(){
                axios.get(this.urlProvincia)
                     .then( response =>{
                        this.provincias = response.data
                     })
                     .catch(error =>{
                        this.provincias = error.response.data
                     })
            },

            obterMunicipioDaPrvincia(provincia_id){
                const url = this.urlMunicipio + '/?filtro=provincia_id:=:' + provincia_id
                axios.get(url)
                     .then(response =>{

                        this.municipios = response.data })
                     .then(error => {//
                      });
            },

            obterLocalidadesPorMunicipio_id(municipio_id){
                let url = this.urlBase + '/?filtro=municipio_id' + municipio_id
                axios.get(url)
                    .then(response => {
                        this.obterLocalidadesPorMunicipio(response.data)
                    })
                    .catch(errors =>{});
            },

            obterLocalidadesPorMunicipio(localidade){
                const municipio_id = new Array()
                for (let i = 0; i < localidade.length; i++){
                    this.localidades.push(localidade[i])
                    municipio_id.push(localidade[i].municipio_id)
                }

                this.contarLodadesDeMunicipio(this.localidades)
                return this.localidades
            },

            contarLodadesDeMunicipio(localidades){
                const numero_localidades = localidades.reduce((acumuladorLocalPorMunicipioID, objectLocalidade) => {
                    const { id, municipio_id} = objectLocalidade;
                    const localidadeExistente = acumuladorLocalPorMunicipioID.find((item) => item[0] === municipio_id);
                    if(localidadeExistente){
                        localidadeExistente[1]++
                    } else{
                        acumuladorLocalPorMunicipioID.push([municipio_id, 1])
                    }
                    return acumuladorLocalPorMunicipioID;
                }, [])

                this.numero_localidades = numero_localidades;
                return thois.numero_localidades
            },

            obterProvíncasComMunicipios(){
                const url = this.urlProvincia+'/?atributos=id,Designacao_Provincia&atributos_municipios=id,Designacao_Municipio,provincia_id'
                axios.get(url)
                    .then( response => {

                        let provinciasComMunicipios_Aux = []
                        const localidade = response.data

                        for(let i = 0; i < (response.data).length; i++){
                            if((response.data[i].municipios).length > 0){

                                provinciasComMunicipios_Aux.push(localidade[i])
                            }
                        }

                        console.log(provinciasComMunicipios_Aux.length);

                        //console.log( provinciasComMunicipios_Aux.length);

                        this.provinciasComMunicipios = provinciasComMunicipios_Aux
                    })
                    .catch(errors =>{ })
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
                axios.post(this.urlBase, formData, config)
                    .then(response =>{
                        this.transacaoStatus='adicionado'
                        this.transacaoDetalhes = {
                            mensagem: "Nova Localidade Registada com sucesso"
                        }
                    })
                    .catch(errors => {
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors
                        }
                    })

            }
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
        },

        mounted(){
            this.carregarProvincias()
            this.obterMunicipioDaPrvincia()
            this.obterProvíncasComMunicipios()
            this.obterLocalidadesPorMunicipio_id()
            this.obterLocalidadesPorMunicipio()
            this.contarLodadesDeMunicipio()
        }
    }

</script>
