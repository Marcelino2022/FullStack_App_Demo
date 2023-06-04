<template>

    <modal-component  id="membroModal" titulo="Adicionar Membros">

        <template v-slot:alertas>
            <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Registo Realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
            <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar Registar Província" v-if="transacaoStatus == 'erro'"></alert-component>
        </template>

        <template v-slot:conteudo>
            <form>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <input-container-component titulo="Coordenação" id="coordenacao" id-help="coordenacaoHelp" texto-ajuda="Selecione a coordenação">
                            <select class="form-select" v-model="inputCoordenacao" @change="obterMobilizador(inputCoordenacao)">
                                <option value="">Selecione aqui</option>
                                <option v-for="coordenacao in this.coordenacoes" :key="coordenacao.id" :value=coordenacao.id> {{ coordenacao.Designacao_Coordenacao }}</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-building"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mt-2">
                        <input-container-component titulo="Nome Completo:" id="nomeCompleto" id-help="nomeHelp" texto-ajuda="Informe o Nome Completo">
                            <input type="text" class="form-control" id="nomeCompleto" aria-describedby="idHelp" placeholder="Nome Completo" v-model="inputNomeCompleto">
                            <span class="icon-input"><i class="bi bi-person-lines-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mt-2">
                        <input-container-component titulo="Numero Documento" id="numeroDocumento" id-help="nomeHelp" texto-ajuda="Informe o Número de Documento">
                            <input type="text" class="form-control" id="numeroDocumento" aria-describedby="idHelp" placeholder="Número de Documento" v-model="inputNumeroDocumento">
                            <span class="icon-input"><i class="bi bi-credit-card-2-front-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mt-2">
                        <input-container-component titulo="Tipo Documento" id="tipoDocumento" id-help="tipoDocHelp" texto-ajuda="Selecione o Tipo de Documento">
                            <select class="form-select" v-model="inputTipoDocumento">
                                <option value="">Selecione aqui</option>
                                <option value="Bilhete de Identidade">B.I</option>
                                <option value="Passaporte">Passaporte</option>
                                <option value="Cédula Pessoal">Cédula Pessoal</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-card-checklist"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mt-2">
                        <input-container-component titulo="Data de nascimento" id="dataNascimento" id-help="dataNascimentoHelp" texto-ajuda="Informe a data de nascimento">
                            <input type="date" class="form-control" id="dataNascimento" aria-describedby="idHelp" placeholder="Data de Nascimento" v-model="inputDataNascimento">
                            <span class="icon-input"><i class="bi bi-calendar3"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mt-2">
                        <input-container-component titulo="Telemóvel" id="telemovel" id-help="telemovelHelp" texto-ajuda="Informe o telemovel">
                            <input type="number" class="form-control" id="telemovel" aria-describedby="idHelp" placeholder="telemovel" v-model="inputTelemovel">
                            <span class="icon-input"><i class="bi bi-phone-vibrate-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mt-2">
                        <input-container-component titulo="Morada" id="morada" id-help="moradaHelp" texto-ajuda="Informe a Morada">
                            <input type="text" class="form-control" id="morada" aria-describedby="idHelp" placeholder="Morada" v-model="inputMorada">
                            <span class="icon-input"><i class="bi bi-pin-map-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mt-2">
                        <input-container-component titulo="Email" id="email" id-help="emailHelp" texto-ajuda="Informe o email">
                            <input type="text" class="form-control" id="email" aria-describedby="idHelp" placeholder="Email" v-model="inputEmail">
                            <span class="icon-input"><i class="bi bi-envelope-fill"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mt-2">
                        <input-container-component titulo="Função" id="funcao" id-help="funcaoHelp" texto-ajuda="Selecione a função">
                            <select class="form-select" v-model="inputFuncao">
                                <option value="">Selecione aqui</option>
                                <option v-for="funcao in this.funcoes" :key="funcao.id" :value="funcao.id"> {{ funcao.Designacao_Funcao }}</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-tools"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mt-2">
                        <input-container-component titulo="Data de Alistamento" id="dataAlistamento" id-help="dataAlistamentoHelp" texto-ajuda="Informe a Data de alistamento">
                            <input type="date" class="form-control" id="dataAlistamento" aria-describedby="idHelp" placeholder="Data de alistamento" v-model="inputDataAlistamento">
                            <span class="icon-input"><i class="bi bi-calendar3"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-3 mt-2">
                        <input-container-component titulo="Categoria" id="categoria" id-help="categoriaHelp" texto-ajuda="Selecione a categoria">
                            <select class="form-select" v-model="inputCategoria">
                                <option value="">Selecione aqui</option>
                                <option v-for="categoria in this.categorias" :key="categoria.id" :value="categoria.id"> {{ categoria.Designacao_Categoria }}</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-card-checklist"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mb-2">
                        <input-container-component titulo="Mobilzador" id="mobilzador" id-help="mobilzadorHelp" texto-ajuda="Selecione o Mobilzador">
                            <select class="form-select" v-model="inputMobilzador">
                                <option value="">Selecione aqui</option>
                                <option v-for="mobilizador in mobilizadores" :key="mobilizador.id"  :value="mobilizador.id">{{ mobilizador.Nome_Membro }}</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-person-check"></i></span>
                        </input-container-component>
                    </div>

                    <div class="col-md-6 mb-2">
                        <input-container-component titulo="Cópia do Documento" id="dataAlistamento" id-help="dataAlistamentoHelp" texto-ajuda="Carregar Ficheiro">
                            <input type="file" class="form-control" id="dataAlistamento" aria-describedby="idHelp" placeholder="Cópia do documento" disabled>
                            <span class="icon-input"><i class="bi bi-card-text"></i></span>
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
    @import '../../css/modal.css';
</style>

<script>

    import axios from 'axios';

    export default {
        data(){
            return{
                urlBase:import.meta.env.VITE_API_URL,
                inputCoordenacao: "",
                inputNomeCompleto: "",
                inputNumeroDocumento: "",
                inputSiglaTipoDocumento: "",
                inputMobilzador: "",
                inputDataNascimento: "",
                inputTelemovel: "",
                inputMorada: "",
                inputEmail: "",
                inputFuncao: "",
                inputDataAlistamento: "",
                inputCategoria: "",
                inputMobilzador: "",

                coordenacoes: [],
                categorias: [],
                funcoes: [],
                mobilizadores: [],
                membros: [],

                transacaoStatus: "",
                transacaoDetalhes: {},

            }
        },

        methods:{

            setStore(obj) {
                this.$store.state.transacao.status = 'avisar'
                this.$store.state.transacao.mensagem = ''
                this.$store.state.transacao.dados = ''
                this.$store.state.item = obj
                this.categoria_id = obj.categoria_id
              /*   this.obterProvinciaPorID(this.provincia_id) */
            },

/*             LstarMebros(){

                const url = `${this.urlBase}membro`
                axios.get(url)
                    .them( response => {
                        this.membros = response.data
                    }).catch( errors => {

                    })
            },
 */
            salvar(){
                const url = this.urlBase+'membro'
                let config = {
                    headers:{ 'content.Type': 'multpart/form-data' }
                }

                const formData = new FormData()

                formData.append('Nome_Membro', this.inputNomeCompleto)
                formData.append('Data_Nascimento', this.inputDataNascimento)
                formData.append('Numero_Documento', this.inputNumeroDocumento)
                formData.append('Tipo_Documento', this.inputTipoDocumento)
                formData.append('Sigla_Tipo_Documento', this.inputSiglaTipoDocumento)
                formData.append('Morada_Membro', this.inputMorada)
                formData.append('Email_Membro', this.inputEmail)
                formData.append('Telemovel_Membro', this.inputTelemovel)
                formData.append('mobilizador_id', this.inputMobilzador)
                formData.append('funcao_id', this.inputFuncao)
                formData.append('categoria_id', this.inputCategoria)
                formData.append('Data_Alistamento', this.inputDataAlistamento)
                formData.append('coordenacao_id', this.inputCoordenacao)


                axios.post(url,formData, config)
                     .then( response => {

                        this.inputNomeCompleto = ""
                        this.inputDataNascimento = ""
                        this.inputNumeroDocumento = ""
                        this.inputNumeroDocumento = ""
                        this.inputSiglaTipoDocumento = ""
                        this.inputMorada = ""
                        this.inputEmail = ""
                        this.inputTelemovel = ""
                        this.inputMobilzador = ""
                        this.inputFuncao = ""
                        this.inputCategoria = ""
                        this.inputDataAlistamento = ""
                        this.inputCoordenacao = ""

                        this.transacaoStatus = "adicionado"
                        this.transacaoDetalhes = {
                            mensagem: `Membro ${this.inputNomeCompleto} adicionada com Sucesso`
                        }

                        /*     this.LstarMebros(); */

                     }).catch( errors =>{
                        console.log(errors.response);
                        this.transacaoStatus = "erro"
                        if(errors.response.status == 500){
                                this.transacaoDetalhes = {
                                mensagem: "Verifique se preencheu todos os Campo Corretamente",
                                //dados: errors.response.data.errors
                            }
                        }else{
                            this.transacaoDetalhes = {
                                mensagem: errors.response.data.message,
                                //dados: errors.response.data.errors
                            }
                        }

                     })
            },

            carregarCoordenacoes(){
                const url = `${this.urlBase}coordenacao`
                axios.get(url)
                    .then( response => {
                        this.coordenacoes = response.data
                    }).catch( errors => {
                        this.coordenacoes = ""
                })
            },

            carregarCategorias(){
                const url = `${this.urlBase}categoria`
                axios.get(url)
                    .then( response => {
                        this.categorias = response.data
                    }).catch( errors => {
                        this.categorias = ""
                })
            },

            carregarFuncoes(){
                const url = `${this.urlBase}funcoes/listar`
                axios.get(url)
                    .then( response => {
                        this.funcoes = response.data
                    }).catch( errors => {
                        this.funcoes = ""
                })
            },

            obterMobilizador(coordenacao_id){

        /*         const url = `${this.urlBase}?filtro=coordenacao_i:d=:${coordenacao_id}`

                axios.get(url)
                    .then( response => {
                        this.mobilizadores = response.data
                    }).catch( errors => {
                        this.mobilizadores = ""
                }) */
            },

        },

        mounted(){
            this.carregarCoordenacoes();
            this.carregarCategorias();
            this. carregarFuncoes();
            this.obterMobilizador();
          /*   this.LstarMebros() */
        }
    }
</script>
