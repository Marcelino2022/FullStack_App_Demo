<template>
    <div>

        <div class="card genericCard" :id="id">
            <div class="card-body">
                <div class="cabecalho-card">
                    <slot name="image"></slot>
                    <div>
                        <h3 class="mb-1"> {{ titulo }}</h3>
                        <h6>{{ subtitulo }}</h6>
                    </div>
                </div>

                <hr>

                <div class="info-footer">
                    <slot name="rodape"></slot>
                </div>
            </div>
        </div>

        <hr class="mb-3">
    </div>

</template>

<style scoped>
    @import '../../css/card.css';
</style>


<script>
    export default {
        props: ['id', 'titulo', 'subtitulo']
    }
</script>
