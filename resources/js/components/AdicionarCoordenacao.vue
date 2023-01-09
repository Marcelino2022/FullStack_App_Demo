<template>
    <modal-component id="coordenacaoModal" titulo="Adicionar Coordenação">
        <template v-slot:conteudo>
            <form>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="recipient-name" class="col-form-label">Nome Completo:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-person-lines-fill"></i></span>
                    </div>
                </div>
            </form>
        </template>
        <template v-slot:rodape>
            <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-principal">Submeter</button>
        </template>
    </modal-component>
</template>

<style scoped>
    @import '../../css/modalAdicionar.css';
</style>
