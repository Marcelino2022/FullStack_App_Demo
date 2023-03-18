<template>
    <div class="accordion mt-3" :id="id">
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" :data-bs-target="data-bs-target" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                <i class="bi bi-geo" id="icon-location"></i><h4>{{ titulo }}</h4>
            </button>
            </h2>
            <div :id="id" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                <slot name="items">
                    <div class="accordion-body">
                    </div>
                </slot>
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
