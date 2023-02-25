<template>

    <div class="container mt-3">

        <adicionarCoordenacao-component></adicionarCoordenacao-component>
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
            
            <div class="col-md-6"></div>

            <div class="col-md-3 mt-1 col-btn">
                <buttonComponent-component class="button-component" data-bs-toggle="modal" data-bs-target="#coordenacaoModal">
                    <template v-slot:icon><i class="bi bi-plus-circle"></i></template>
                    <template v-slot:conteudo>Adicionar Coordenação</template>
                </buttonComponent-component>
            </div>

        </div>

        <hr class="mb-3 mt-5">
        <card-component titulo="Coordenação Provincial de Luanda">
            <template v-slot:image> <img src="../../../public/imagens/Logo-Web.png" class="float-start avatar" alt="..."></template>
            <template v-slot:rodape>
                <div class="mb-2"><i class="bi bi-envelope-fill icon-color"></i> coordenacao@luanda.com</div>
                <div class="mb-2 ml-5"><i class="bi bi-phone-fill icon-color"></i> 923 451 241</div>
                <div class="mb-2 ml-5"><i class="bi bi-geo-alt-fill icon-color"></i> Avenidada Deolinda Rodrigues 23</div>
                <div class="mb-2 ml-5"><button type="button " class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</button></div>
                <div class="mb-2 ml-5"><button type="button" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Eliminar</button></div>
            </template>
        </card-component>
    </div>

</template>

<style scoped>
    @import '../../css/coordenacoes.css';
</style>

<script>

</script>
