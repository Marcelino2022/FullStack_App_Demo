<template>

    <adicionarMembro-component></adicionarMembro-component>

    <div class = "cover">
        <img src="../../../public/imagens/Cover.png" class="img-fluid" alt="...">
        <div class="container" id="content-cover">
            <h1>PRA-JÁ Servir Angola</h1>
            <h4>Tudo por uma Angola melhor!</h4>
        </div>
    </div>

    <div class="container">

        <div class="card mb-5 coordenacao">
            <div class="card-body">
                <h1 class="mb-1">Coordenação Provincial de Luanda</h1>
                <hr>
                <div class="info-coordenacao">
                    <span class="card-subtitle mb-2"><i class="bi bi-envelope-fill"></i> coordenacao@luanda.com</span>
                    <span class="card-subtitle mb-2 ml-5"><i class="bi bi-phone-fill"></i> 923 451 241</span>
                    <span class="card-subtitle mb-2 ml-5"><i class="bi bi-geo-alt-fill"></i> Avenidada Deolinda Rodrigues 23</span>
                </div>
            </div>
        </div>

        <div class="row cards mb-5">
            <div class="col-md-3">
                <button class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                    <div class="card login-card">
                        <div><i class="bi bi-person"></i></div>
                        <h5>Adicionar Membro</h5>
                    </div>
                </button>
            </div>

            <div class="col-md-3">
                <a href="">
                    <div class="card login-card">
                        <div><i class="bi bi-building"></i></div>
                        <h5>Adicionar Coodenação</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="">
                    <div class="card login-card">
                        <div><i class="bi bi-pin-map-fill"></i></div>
                        <h5>Adicionar Localidade</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="">
                    <div class="card login-card">
                        <div><i class="bi bi-calendar3"></i></div>
                        <h5>Agendar Atividade</h5>
                    </div>
                </a>
            </div>

        </div>
    </div>
</template>

<style scoped>
    @import '../../css/home.css';
</style>

<script>

</script>
