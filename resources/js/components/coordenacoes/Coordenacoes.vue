<template>

    <adicionarCoordenacao-component id="CoordenacaoModal"></adicionarCoordenacao-component>
    <div class="container  margem-top">
        <div class="row  mt-5">

            <div class="col-md-1"></div>

            <div class="col-md-10">
                <br><br>
                <div class="row">
                    <div class="col-md-3 form-floating" id="filter">
                        <h2 class="">Coordenações</h2>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3 col-float-right">
                        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#CoordenacaoModal"><i class="bi bi-plus"></i></button>
                    </div>
                </div>

                <hr>

                <table class="table table-striped table-borderless table-hover table-bordered mt-3">
                    <thead class="tableHeader">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Designação</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Email:</th>
                            <th scope="col">Telefone:</th>
                            <th scope="col">Telemóvel:</th>
                            <th scope="col"><i class="bi bi-tools"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="coordenacao in coordenacoes" :key="coordenacao.id">
                            <td scope="row">{{ coordenacao.id }}</td>
                            <td>{{ coordenacao.Designacao_Coordenacao }}</td>
                            <td>{{ coordenacao.Endereco_Coordenacao }}</td>
                            <td>{{ coordenacao.Email }}</td>
                            <td>{{ coordenacao.Telefone }}</td>
                            <td>{{ coordenacao.Telemovel }}</td>
                            <th class="tools">
                                <i class="bi bi-eye-fill view"></i>
                                <i class="bi bi-pencil-square edit"></i>
                                <i class="bi bi-trash-fill delete"></i>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>


        <!--ADICIONAR LOCALIDADE-->
<!--         <modal-component id="CoordenacaoModal" titulo="Adicionar Coordenação">

        </modal-component> --><!--ADICIONAR LOCALIDADE-->

</template>

<style scoped>
    @import '../../../css/coordenacoes.css';
</style>

<script>

    import axios from 'axios'
    export default {
        data(){
           return{
                urlBase: "http://127.0.0.1:8000/api/",
                coordenacoes: [],
                permissoes:[]
           }
        },

        methods: {
            carregarCoordenacoes(){

                const url = this.urlBase+'coordenacao';

                axios.get(url)
                    .then( response => {
                        this.coordenacoes = response.data
                        console.log(response.data);
                    }).catch( error =>{
                        console.log(error);
                     })
            },

 /*            carregarPermissoes(){
                const url = this.urlBase + 'permissoes'
                axios.get(url)
                    .then( response =>{
                        this.permissoes = response.data
                        console.log(this.permissoes);
                    }).catch(error =>{

                    })
            } */
        },

        mounted(){
            this.carregarCoordenacoes()
      /*       this.carregarPermissoes() */
        }
    }

</script>
