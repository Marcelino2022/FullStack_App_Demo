import axios from 'axios';

export default {

    computed: {
        token() {
            let token = document.cookie.split(";").find(indice => {
                return indice.includes("token=");
            });
            token = token.split("=")[1];
            token = "Bearer" + token;
            return token;
        }
    },

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

            this.$store.state.item = obj

        },

        carregarProvincias() {
            let config = {
                headers: {
                    "Accept": "application/json",
                    "authorization": this.token
                }
            };
            axios.get(this.urlBase, config)
                .then(response => {
                this.provincias = response.data;
            })
                .catch(errors => {
                console.log(errors);
            });
        },

        recarregarCarregarProvincias(removido) {

            let config = {
                headers: {
                    "Accept": "application/json",
                    "authorization": this.token
                }
            };

            if(removido === removido){
                axios.get(this.urlBase, config)
                .then(response => {
                this.provincias = response.data;
            })
                .catch(errors => {
                console.log(errors);
            });
            }
        }
    },

    mounted() {
        this.carregarProvincias();
        this.recarregarCarregarProvincias()
    },
}












