<template>

    <adicionarMembro-component></adicionarMembro-component>
    <adicionarCoordenacao-component></adicionarCoordenacao-component>
    <adicionarLocalidade-component></adicionarLocalidade-component>


    <div class = "cover">
        <img src="../../../public/imagens/Cover.png" class="img-fluid" alt="...">
        <div class="container" id="content-cover">
            <h1>PRA-JÁ Servir Angola</h1>
            <h4>Por Angola, serei sempre servidor!</h4>
        </div>
    </div>

    <div class="container">

        <div class="card mb-5 coordenacao">
            <div class="card-body">
                <h3 class="mb-1">Coordenação Provincial de Luanda</h3>
                <hr>
                <div class="info-coordenacao">
                    <span class="card-subtitle mb-2"><i class="bi bi-envelope-fill"></i> coordenacao@luanda.com</span>
                    <span class="card-subtitle mb-2 ml-5"><i class="bi bi-phone-fill"></i> 923 451 241</span>
                    <span class="card-subtitle mb-2 ml-5"><i class="bi bi-geo-alt-fill"></i> Avenida Deolinda Rodrigues 23</span>
                </div>
            </div>
        </div>

        <div class="row cards mb-5">
            <div class="col-md-3">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#membroModal">
                    <div class="card menu-card">
                        <div><i class="bi bi-person"></i></div>
                        <p>Adicionar Membro</p>
                    </div>
                </button>
            </div>

            <div class="col-md-3">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#coordenacaoModal">
                    <div class="card menu-card">
                        <div><i class="bi bi-person"></i></div>
                        <p>Adicionar Coordenação</p>
                    </div>
                </button>

            </div>

            <div class="col-md-3">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#provinciaModal">
                    <div class="card menu-card">
                        <div><i class="bi bi-pin-map-fill"></i></div>
                        <p>Adicionar Província</p>
                    </div>
                </button>
            </div>

            <div class="col-md-3">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#localidadeModal">
                    <div class="card menu-card">
                        <div><i class="bi bi-pin-map-fill"></i></div>
                        <p>Adicionar Município</p>
                    </div>
                </button>
            </div>

            <!--div class="col-md-3">
                <button>
                    <div class="card menu-card">
                        <div><i class="bi bi-calendar3"></i></div>
                        <p>Agendar Atividade</p>
                    </div>
                </button>
            </div-->

        </div>
    </div>

</template>

<style scoped>
    @import '../../css/home.css';
</style>

<script>
import AdicionarCoordenacao from './AdicionarCoordenacao.vue';

</script>
