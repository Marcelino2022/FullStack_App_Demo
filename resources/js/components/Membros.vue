<template>

    <div class="container">
        <h1 class="margem-top">Membros</h1>
        <hr class="mb-3">

        <div class="row mb-5">
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
        </div>

        <div class="card mb-3 membro">
            <div class="card-body">
                <div class="cabecalho-card">
                    <img src="../../../public/imagens/User-1.jpg" class="float-start avatar" alt="...">
                    <div>
                        <h2 class="mb-1">Manuel Francisco Pedro Bungaló</h2>
                        <h6>Coordenador Provincial de Luanda</h6>
                    </div>
                </div>

                <hr class="mt-3">
                <div class="info-membro">
                    <div class="mb-2"><i class="bi bi-envelope-fill"></i> membro@luanda.com</div>
                    <div class="mb-2 ml-5"><i class="bi bi-phone-fill"></i> 923 451 241</div>
                    <div class="mb-2 ml-5"><i class="bi bi-geo-alt-fill"></i> Avenidada Deolinda Rodrigues 23</div>
                    <div class="mb-2 ml-5"><button type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</button></div>
                    <div class="mb-2 ml-5"><button type="button" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Eliminar</button></div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import '../../css/membros.css';
</style>

<script>

</script>
