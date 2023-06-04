<template>

    <adicionarMembro-component></adicionarMembro-component>
    <div class="container">
        <div class="row margem-top">
            <div class="col-md-1"></div>
            <div class="col-md-10  mt-5 mb-3">

                <div class="row">
                    <div class="col-md-3 form-floating" id="filter">
                        <h2 class="">Membros</h2>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3 col-float-right">
                        <button type="button" class="btn-add" data-bs-toggle="modal" data-bs-target="#membroModal"><i class="bi bi-plus"></i></button>
                    </div>
                </div>
            </div>

            <hr>

            <table class="table table-striped table-borderless table-hover table-bordered ">
                    <thead class="tableHeader">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome Completo</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telemóvel</th>
                            <th scope="col">Coordenação</th>
                            <th scope="col">Função</th>
                            <th scope="col">Categoria</th>
                            <th scope="col"><i class="bi bi-tools"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                       <tr v-for="membro in membros" :key="membro.id">
                            <td scope="row">{{ membro.id }}</td>
                            <td>{{ membro.Nome_Membro }}</td>
                            <td>{{ membro.Email_Membro }}</td>
                            <td>{{ membro.Telemovel_Membro }}</td>
                            <td>{{ membro.coordenacao_id }}</td>
                            <td>{{ membro.funcao_id }}</td>
                            <td>{{ membro.categoria_id }}</td>
                            <td class="text-center tools">
                                <i class="bi bi-eye-fill view"></i>
                                <i class="bi bi-pencil-square edit" v-if="admin"></i>
                                <i class="bi bi-trash-fill delete" v-if="admin"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-1">
               <div hidden>  {{ usuario }} </div>
            </div>

        </div>
<!--         <h2 class="margem-top">Membros</h2> -->



<!--         <div class="row mb-5">
            <div class="col-md-3 form-floating" id="filter">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option selected>Clique aqui para filtrar</option>
                    <option value="1">Coordenadores</option>
                    <option value="2">Vice-Coordenadores</option>
                    <option value="3">Secretários Municipais</option>
                    <option value="3">Secretários Provinciais</option>
                    <option value="3">Todos</option>
                </select>
                <label for="floatingSelect">Filtrar por:</label>
                <span class="icon-form"><i class="bi bi-filter-circle-fill"></i></span>
            </div>
            <div class="col-md-6"></div>

            <div class="col-md-3 mt-1 col-btn">
                <buttonComponent-component class="button-component" data-bs-toggle="modal" data-bs-target="#membroModal">
                    <template v-slot:icon><i class="bi bi-plus-circle"></i></template>
                    <template v-slot:conteudo>Adicionar Membro</template>
                </buttonComponent-component>
            </div>
        </div>

        <hr class="mb-3 mt-5"> -->
<!--
        <card-component titulo="Manuel Francisco Pedro Bungaló" subtitulo="Coordenador Provincial de Luanda">
            <template v-slot:image><img src="../../../public/imagens/User-1.jpg" class="float-start avatar" alt="..."></template>
            <template v-slot:rodape>
                <div class="mb-2"><i class="bi bi-envelope-fill icon-color"></i> membro@luanda.com</div>
                <div class="mb-2 ml-5"><i class="bi bi-phone-fill icon-color"></i> 923 451 241</div>
                <div class="mb-2 ml-5"><i class="bi bi-geo-alt-fill icon-color"></i> Avenidada Deolinda Rodrigues 23</div>
                <div class="mb-2 ml-5"><button type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</button></div>
                <div class="mb-2 ml-5"><button type="button" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Eliminar</button></div>
            </template>
        </card-component>

    </div>-->
</template>

<style scoped>
    @import '../../css/membros.css';
</style>

<script>

import axios from 'axios';
import { mapState } from 'vuex';

export default {
    data(){
        return{
            urlBase:import.meta.env.VITE_API_URL,
            membros: [],
            permissao: "",
            admin: false,
            acessorURL:"",
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

    methods:{

        ListarMebros(url){
        axios.get(url)
            .then( response => {
                this.membros = response.data

                if(this.membros.length > 0){

                }
            }).catch( errors => {

            })
        },

        carragarDadosDoUtilizador(usuario){
            const url = `${this.urlBase}user/autenticado/dados/?id=${usuario.coordenacao_id}`
             axios.get(url)
                .then( response => {
                    this.permissao =response.data.coordenacao[0].Designacao_Permissao

                    if(this.permissao == 'Nível Nacional'){
                        this.admin = true
                        this.acessorURL =`${this.urlBase}membro`
                    } else{
                        this.acessorURL =`${this.urlBase}membro/listarMembros?id=${usuario.coordenacao_id}`
                    }

                    this.ListarMebros(this.acessorURL)
            })
        }
    },

    mounted(){
            this.ListarMebros()
            this.carragarDadosDoUtilizador();
        }
}

</script>
