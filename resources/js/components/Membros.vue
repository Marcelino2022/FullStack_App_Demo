<template>

    <adicionarMembro-component></adicionarMembro-component>
    <div class="container">
        <h2 class="margem-top">Membros</h2>
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
            <div class="col-md-6"></div>

            <div class="col-md-3 mt-1 col-btn">
                <buttonComponent-component class="button-component" data-bs-toggle="modal" data-bs-target="#membroModal">
                    <template v-slot:icon><i class="bi bi-plus-circle"></i></template>
                    <template v-slot:conteudo>Adicionar Membro</template>
                </buttonComponent-component>
            </div>
        </div>

        <hr class="mb-3 mt-5">

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

    </div>
</template>

<style scoped>
    @import '../../css/membros.css';
</style>

<script>

</script>
