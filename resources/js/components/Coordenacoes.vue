<template>

    <div class="container mt-3">

        <h2 class="margem-top">Coordenações</h2>

        <hr class="mb-3">

        <div class="row mb-5">
            <div class="col-md-3 form-floating" id="filter">
                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                    <option selected>Clique aqui para filtrar</option>
                    <option value="1">Província</option>
                    <option value="2">Município</option>
                    <option value="3">Localidade</option>
                </select>
                <label for="floatingSelect">Filtrar por:</label>
                <span class="icon-form"><i class="bi bi-filter-circle-fill"></i></span>
            </div>
        </div>

        <div class="card mb-3 coordenacao">
            <div class="card-body">
                <div class="cabecalho-card">
                    <img src="../../../public/imagens/Logo-Web.png" class="float-start avatar" alt="...">
                    <div>
                        <h3 class="mb-1">Coordenação Provincial de Luanda</h3>
                    </div>
                </div>

                <hr>
                <div class="info-coordenacao">
                    <div class="mb-2"><i class="bi bi-envelope-fill"></i> coordenacao@luanda.com</div>
                    <div class="mb-2 ml-5"><i class="bi bi-phone-fill"></i> 923 451 241</div>
                    <div class="mb-2 ml-5"><i class="bi bi-geo-alt-fill"></i> Avenidada Deolinda Rodrigues 23</div>
                    <div class="mb-2 ml-5"><button type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</button></div>
                    <div class="mb-2 ml-5"><button type="button" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Eliminar</button></div>
                </div>
            </div>
        </div>

        <hr class="mb-3 mt-5">
    </div>

</template>

<style scoped>
    @import '../../css/coordenacoes.css';
</style>

<script>

</script>
