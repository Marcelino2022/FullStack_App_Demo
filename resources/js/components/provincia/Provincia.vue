<template>

    <div class="container mt-3">

        <adicionarProvincia-component></adicionarProvincia-component>
        <editarProvincia-component></editarProvincia-component>

        <h2 class="margem-top">Províncias</h2>

        <hr class="mb-3">

        <div class="row mb-3">
            <div class="col-md-3 form-floating" id="filter">

                <filtro-component>
                    <template v-slot:optionSelected>Todas as Províncias</template>
                    <template v-slot:option>
                        <option v-for="provincia in provincias" :key="provincia.id" :value="provincia.id"> {{ provincia.Designacao_Provincia }}</option>
                    </template>
                    <template v-slot:labelContent>Clique aqui para filtrar </template>
                </filtro-component>

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

        <card-component v-for="provincia in provincias" :key="provincia.id" :titulo="provincia.Designacao_Provincia"  :editar="true" :remover="true">
            <template v-slot:image> <img src="../../../../public/imagens/bandeira-angola.png" class="float-start avatar" alt="..."></template>

            <template v-slot:rodape>
                <div class="mb-2"><i class="bi bi-building icon-color"></i> -- Coordenações</div>
                <div class="mb-2 ml-5"><i class="bi bi-pin-map-fill icon-color"></i> -- Municípios </div>
                <div class="mb-2 ml-5"><i class="bi bi-geo-alt-fill icon-color"></i> -- Localidades </div>

                <div class="mb-2 ml-5">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarProvinciaModal">
                        <i class="bi bi-pencil-square"></i> Editar
                    </button>
                </div>

                <div class="mb-2 ml-5"><button type="button" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Remover</button></div>
            </template>

        </card-component>

    </div>

</template>

<style scoped>
    @import '../../../css/provincias.css';
</style>

<script>
import axios from 'axios';
import EditarProvincia from './EditarProvincia.vue';

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
        }
    },
    mounted() {
        this.carregarProvincias();
    },
    components: { EditarProvincia }
}
</script>
