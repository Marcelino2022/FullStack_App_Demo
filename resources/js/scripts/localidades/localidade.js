
import axios from 'axios';
import Localidade from './localidades.calsse';

export default {

    data(){

        return{
            urlBase: "http://127.0.0.1:8000/api/localidade",
            urlProvincia: "http://127.0.0.1:8000/api/provincia",
            urlMunicipio: "http://127.0.0.1:8000/api/municipio",
            provincias: "",
            provinciasComMunicipios:[],
            municipios: "",
            localidadesPorMunicipio: [],
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
                    this.municipios = response.data
                 })
                 .then(error => {
                    //this.provincias = error.response.data
                 });
        },

        obterLocalidadesPorMunicipio_id(municipio_id){

            const municipio_da_localidade = new Localidade()

            let url = this.urlBase + '/?filtro=municipio_id' + municipio_da_localidade.criarmunicipio(municipio_id)

            console.log(url)
            /*axios.get(url)
                .then(response => {
                    //this.localidadesPorMunicipio[municipio_id]  = response.data
                    this.localidadesDoMunicipio = response.data
                })
                .catch(errors =>{
                    //
                });*/
        },

        obterProvíncasComMunicipios(){
            const url = this.urlProvincia+'/?atributos=id,Designacao_Provincia&atributos_municipios=id,Designacao_Municipio,provincia_id'

            axios.get(url)
                .then( response => {

                    let provinciasComMunicipios_Aux = []
                    for(let i = 0; i < (response.data).length; i++){

                        if((response.data[i].municipios).length > 0){
                            provinciasComMunicipios_Aux.push(response.data[i])
                            //this.provinciasComMunicipios[i] = response.data[i]
                        }
                    }

                    this.provinciasComMunicipios = provinciasComMunicipios_Aux

                })
                .catch(errors =>{
                    //
                })
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

        /*localidadesPorProvinciasMunicipios(){
            const procinciasMunicipios_C = {}

            for(const provincia_cumputada of this.this.provinciasComMunicipios){
                for(const municipio_computado of this.provincia){
                    const procinciaMunicipio_C = `${provincia_cumputada.Designacao_Provincia} - ${municipio_computado.Designacao_Municipio}`;
                    if(!procinciasMunicipios_C[procinciaMunicipio_C]){
                        procinciasMunicipios_C[procinciaMunicipio_C] = { procinciaMunicipio_C, numeroLocalidades: 0}
                    }
                }

                //for(const localidade of this.municipios.localidades)
            }

            return Object.values(procinciasMunicipios_C)
        }*/

    },

    mounted(){
        this.carregarProvincias()
        this.obterProvíncasComMunicipios()
        this.obterLocalidadesPorMunicipio_id()
    }
}
