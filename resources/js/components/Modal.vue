<template>
    <div class="modal fade" :id = "id" tabindex="-1" aria-labelledby="membroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalMembroLabel">{{titulo}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <slot name="alertas"></slot>

                    <slot name="conteudo">

                    </slot>
                </div>

                <div class="modal-footer">
                    <slot name="rodape"></slot>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>
    @import '../../css/modal.css';
</style>

<script>
    export default {
        props: ['id','titulo'],
    }
</script>
