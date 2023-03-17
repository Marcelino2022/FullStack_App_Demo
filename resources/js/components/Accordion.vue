<template>
    <div class="accordion mt-3" :id="id">
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" :data-bs-target="data-bs-target" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                <i class="bi bi-geo" id="icon-location"></i><h4>{{ titulo }}</h4>
            </button>
            </h2>
            <div :id="id" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
            <div class="accordion-body">
                <ul class="list-group">
                    <li class="list-group-item">


                        <h5 id="icon-location_2">
                            <i :class="class"></i><slot name="localidade"></slot>
                        </h5>

                        <div class="mYBtn-group">
                            <slot name="butrons"></slot>
                            <!--button type="button" class="btn btn-success mr" data-bs-toggle="modal" data-bs-target="#editarProvinciaModal" @click="setStore(obj)">
                                <i class="bi bi-pencil-square"></i> Editar
                            </button>

                            <button type="button" class="btn btn-danger ml-3" data-bs-toggle="modal" data-bs-target="#removerProvinciaModal" @click="setStore(obj)">
                                <i class="bi bi-trash3-fill"></i> Remover
                            </button-->
                        </div>

                    </li>
                </ul>
            </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import '../../css/accordion.css';
</style>
<script>
    export default {
        props:['id', 'titulo', 'class', 'localidade', 'data-bs-target', 'id']
    }
</script>
