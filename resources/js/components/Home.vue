<template>

    <adicionarLocalidade-component></adicionarLocalidade-component>

    <div class = "cover">
        <img src="../../../public/imagens/Cover.png" class="img-fluid" alt="...">
        <div class="container" id="content-cover">
            <h1>PRA-JÁ Servir Angola</h1>
            <h4>Por Angola, serei sempre servidor!</h4>
        </div>
    </div>

    <div class="container">

        <hr class="mb-3 mt-5">

        <card-component :titulo="usuario.name">
            <template v-slot:rodape>
                <div class="mb-2"><i class="bi bi-envelope-fill icon-color"></i> {{ usuario.email }}</div>
                <div class="mb-2 ml-5"><i class="bi bi-phone-fill icon-color"></i> {{ this.telemovel }} </div>
                <div class="mb-2 ml-5"><i class="bi bi-geo-fill icon-color"></i> {{ this.endereco }}</div>
                <div class="mb-2 ml-5"><i class="bi bi-geo-alt-fill icon-color"></i> {{ this.bairro }}</div>
            </template>
        </card-component>

        <br>
        <div class="row cards mb-5">

            <buttonHome-component href="/todos-os-membros">
                <template v-slot:icon><i class="bi bi-person"></i></template>
                <template v-slot:redirect>Membro</template>
            </buttonHome-component>

            <buttonHome-component href="/coordenacoes">
                <template v-slot:icon><i class="bi bi-building"></i></template>
                <template v-slot:redirect>Coordenação</template>
            </buttonHome-component>

            <buttonHome-component href="/provincias">
                <template v-slot:icon><i class="bi bi-map"></i></template>
                <template v-slot:redirect>Província</template>
            </buttonHome-component>

            <buttonHome-component href="/municipios">
                <template v-slot:icon><i class="bi bi-pin-map-fill"></i></template>
                <template v-slot:redirect>Município</template>
            </buttonHome-component>


            <buttonHome-component href="/localidades">
                <template v-slot:icon><i class="bi bi-geo"></i></template>
                <template v-slot:redirect>Localidade</template>
            </buttonHome-component>

            <buttonHome-component href="/funcoes">
                <template v-slot:icon><i class="bi bi-gear"></i></template>
                <template v-slot:redirect>Função</template>
            </buttonHome-component>

        </div>
    </div>

</template>

<style scoped>
    @import '../../css/home.css';
</style>

<script>

    import axios from 'axios';
    import { mapState } from 'vuex';

    export default {
        data(){
            return{
                urlBase:import.meta.env.VITE_API_URL,
                dadosCoordenacao: "",
                endereco: "",
                telemovel: "",
                bairro: "",
            }
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
                    const url = `${this.urlBase}coordenacao/?filtro=id:=:${usuario.coordenacao_id}`
                    axios.get(url)
                        .then( response => {
                            this.telemovel = response.data[0].Telemovel
                            this.endereco = response.data[0].Endereco_Coordenacao
                            this.bairro = response.data[0].Bairro
                    })
            }
        },

        mounted(){
            this.carragarDadosDoUtilizador();
        }

    }

</script>
