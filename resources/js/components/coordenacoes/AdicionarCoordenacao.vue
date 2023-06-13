<template>
    <modal-component :id="id" titulo="Adicionar Secretariado">

        <template v-slot:alertas>
            <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Registo Realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
            <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar Registar Província" v-if="transacaoStatus == 'erro'"></alert-component>
        </template>

        <template v-slot:conteudo>
            <form ref="formInserirCoordenacao">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input-container-component titulo="Designação Secretariado:" id="designacaoCoordenacao" id-help="designacaoHelp" texto-ajuda="Designação do Secretariado">
                            <input type="text" class="form-control" id="designacaoCoordenacao" aria-describedby="idHelp" placeholder="Secretariado" v-model="inputDesignacaoCoordenacao">
                            <span class="icon-input"><i class="bi bi-building"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mb-3">
                        <input-container-component titulo="Email Secretariado:" id="emailCoordenacao" id-help="emailHelp" texto-ajuda="Email do Secretariado">
                            <input type="text" class="form-control" id="emailCoordenacao" aria-describedby="idHelp" placeholder="Eamil" v-model="inputEmailCoordenacao">
                            <span class="icon-input"><i class="bi bi-envelope-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mb-3">
                        <input-container-component titulo="Telefone Secretariado:" id="telefoneCoordenacao" id-help="telefoneHelp" texto-ajuda="Telefone do Secretariado">
                            <input type="text" class="form-control" id="telefoneCoordenacao" aria-describedby="idHelp" placeholder="Telefone" v-model="inputTelefoneCoordenacao">
                            <span class="icon-input"><i class="bi bi-telephone-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mb-3">
                        <input-container-component titulo="Telemóvel Secretariado:" id="telemovelCoordenacao" id-help="telemovelHelp" texto-ajuda="Telefone do Secretariado">
                            <input type="text" class="form-control" id="telemovelCoordenacao" aria-describedby="idHelp" placeholder="Telemóvel" v-model="inputTelemovelCoordenacao">
                            <span class="icon-input"><i class="bi bi-phone-vibrate-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mb-3">
                        <input-container-component titulo="Província Secretariado:" id="provinciaCoordenacao" id-help="provinciaHelp" texto-ajuda="Pronvíncia do Secretariado">
                            <select class="form-select" aria-label="Default select example" v-model="provinciaSelecionada"  @change="obterMunicipioDaPrvincia(provinciaSelecionada)">
                                <option value="">Selecione aqui</option>
                                <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id">{{ provincia.Designacao_Provincia }}</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-map"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mb-3">
                        <input-container-component titulo="Município Secretariado:" id="municipioCoordenacao" id-help="municipioHelp" texto-ajuda="Município do Secretariado">
                            <select class="form-select" aria-label="Default select example" v-model="municipioSelecionado" @change="ObterLocalidadesDoMunicipio(municipioSelecionado)">
                                <option value="">Selecione aqui</option>
                                <option v-for="municipio in municipios" :key="municipio.id" :value="municipio.id">{{ municipio.Designacao_Municipio }}</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-pin-map-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mb-3">
                        <input-container-component titulo="Localidade Secretariado:" id="localidadeCoordenacao" id-help="localidadeHelp" texto-ajuda="Selecione Distrito ou Comuna">
                            <select class="form-select" aria-label="Default select example" v-model="LocalidadeSelecionada">
                                <option value="">Selecione aqui</option>
                                <option v-for="localidade in localidades" :key="localidade.id" :value="localidade.id">{{ localidade.Designacao_Localidade }}</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-geo-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mb-3">
                        <input-container-component titulo="Endereço Secretariado:" id="enderecoCoordenacao" id-help="enderecoHelp" texto-ajuda="Endereço da Secretariado">
                            <input type="text" class="form-control" id="enderecoCoordenacao" aria-describedby="idHelp" placeholder="Endereço" v-model="inputEnderecoCoordenacao">
                            <span class="icon-input"><i class="bi bi-geo-alt-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mb-3">
                        <input-container-component titulo="Bairro Secretariado:" id="bairroCoordenacao" id-help="barrioHelp" texto-ajuda="Bairro da Secretariado">
                            <input type="text" class="form-control" id="bairroCoordenacao" aria-describedby="idHelp" placeholder="Bairro" v-model="inputBairroCoordenacao">
                            <span class="icon-input"><i class="bi bi-geo-alt"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3  mb-3">
                        <input-container-component titulo="Permissão Secretariado:" id="permissaoCoordenacao" id-help="permissaocaoHelp" texto-ajuda="Permissão da Secretariado">
                            <select class="form-select" v-model="permissaoSelecionada">
                                <option value="">Selecione aqui</option>
                                <option  v-for="permissao in permissoes" :key="permissao.id" :value="permissao.id">{{ permissao.Designacao_Permissao }}</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-check-all"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mb-3">
                        <input-container-component titulo="Palavra Passe:" id="passwordCoordenacao" id-help="passwordHelp" texto-ajuda="Password da Secretariado">
                            <input type="password" class="form-control" id="passwordCoordenacao" aria-describedby="idHelp" placeholder="Password" v-model="inputPasswordCoordenacao">
                            <span class="icon-input"><i class="bi bi-unlock-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mb-3">
                        <input-container-component titulo="Confirmar Palavra Passe:" id="confirmarPasswordCoordenacao" id-help="confimarPassHelp" texto-ajuda="Confirmar Password">
                            <input type="password" class="form-control" id="confirmarPasswordCoordenacao" aria-describedby="idHelp" placeholder="Repita a Password" v-model="inputConfirmarPasswordCoordenacao">
                            <span class="icon-input"><i class="bi bi-lock-fill"></i></span>
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
</template>

<style scoped>
    @import '../../../css/modal.css';
</style>

<script>

    import axios from 'axios'
    import carregarCoordenacoes from './Coordenacoes.vue'

    export default {
        data(){
            return{
                urlBase:import.meta.env.VITE_API_URL,
                permissoes: [],
                provincias: [],
                municipios: [],
                localidades: [],
                provinciaSelecionada: "",
                municipioSelecionado: "",
                LocalidadeSelecionada: "",
                permissaoSelecionada: "",
                inputDesignacaoCoordenacao: "",
                inputEmailCoordenacao: "",
                inputEnderecoCoordenacao: "",
                inputBairroCoordenacao: "",
                inputTelemovelCoordenacao: "",
                inputTelefoneCoordenacao: "",
                inputEnderecoCoordenacao: "",
                inputBairroCoordenacao: "",
                inputPasswordCoordenacao: "",
                inputConfirmarPasswordCoordenacao: "",

                transacaoStatus: "",
                transacaoDetalhes: {},
            }
        },
        props: ['id'],

        methods:{
            carregarPermissoes(){
                const url = this.urlBase + 'permissoes'
                axios.get(url)
                    .then( response =>{
                        this.permissoes = JSON.parse(JSON.stringify(response.data));

                    }).catch(error =>{ })
            },

            carregarProvincias(){

                const url = this.urlBase + 'provinciasComMunicipios'

                axios(url).then( response => {
                    this.provincias = response.data
                }).catch(error =>{ })
            },

            obterMunicipioDaPrvincia(provincia_id){

                const url = this.urlBase + 'municipioComLocalidades/' + provincia_id
                axios.get(url)
                     .then(response =>{
                        this.municipios = response.data })
                     .then(error => { });
            },

            ObterLocalidadesDoMunicipio(municipio_id){
                const url = this.urlBase + 'localidadePorMunicipio/' + municipio_id
                axios(url)
                .then(response =>{
                this.localidades = response.data
            })
                .then(error => { });
            },

            salvar(){
                const url = this.urlBase+'coordenacao'
                let config = {
                    headers:{ 'content.Type': 'multpart/form-data' }
                }

                const formData = new FormData()

                formData.append('Designacao_Coordenacao', this.inputDesignacaoCoordenacao)
                formData.append('Endereco_Coordenacao', this.inputEnderecoCoordenacao)
                formData.append('Bairro', this.inputBairroCoordenacao)
                formData.append('Telefone', this.inputTelefoneCoordenacao)
                formData.append('Telemovel', this.inputTelemovelCoordenacao)
                formData.append('Email', this.inputEmailCoordenacao)
                formData.append('localidade_id', this.LocalidadeSelecionada)
                formData.append('permissoes_id', this.permissaoSelecionada)
                formData.append('password', this.inputPasswordCoordenacao)
                formData.append('password_Confirmation', this.inputConfirmarPasswordCoordenacao)

                axios.post(url,formData, config)
                     .then( response => {
                        this.transacaoStatus = "adicionado"
                        this.transacaoDetalhes = {
                            mensagem: `Secretariado ${this.inputDesignacaoCoordenacao} adicionada com Sucesso`
                        }

                            this.$refs.formInserirCoordenacao.reset();
                            carregarCoordenacoes.methods.carregarCoordenacoes();

                     }).catch( errors =>{
                        this.transacaoStatus = "erro"
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            //dados: errors.response.data.errors
                        }
                     })
            }
        },

        mounted(){
            this.carregarPermissoes();
            this.carregarProvincias();
            this.obterMunicipioDaPrvincia();
            this.ObterLocalidadesDoMunicipio()
        }

    }

</script>
