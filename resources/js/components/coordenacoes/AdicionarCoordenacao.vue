<template>
    <modal-component id="coordenacaoModal" titulo="Adicionar Coordenação">
        <template v-slot:conteudo>
            <form>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="recipient-name" class="col-form-label">Designação da Coordenação:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-building"></i></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-envelope-fill"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Telefone:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-telephone-fill"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Telemóvel:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-phone-vibrate-fill"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Província</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Selecione aqui</option>
                            <option value="1">B.I</option>
                            <option value="2">Passaporte</option>
                            <option value="3">Cédula Pessoal</option>
                        </select>
                        <span class="icon-input"><i class="bi bi-map"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Municíplio</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Selecione aqui</option>
                            <option value="1">B.I</option>
                            <option value="2">Passaporte</option>
                            <option value="3">Cédula Pessoal</option>
                        </select>
                        <span class="icon-input"><i class="bi bi-pin-map-fill"></i></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="recipient-name" class="col-form-label">Localidade</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Selecione aqui</option>
                            <option value="1">B.I</option>
                            <option value="2">Passaporte</option>
                            <option value="3">Cédula Pessoal</option>
                        </select>
                        <span class="icon-input"><i class="bi bi-geo-fill"></i></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="recipient-name" class="col-form-label">Endereço:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-geo-alt-fill"></i></span>
                    </div>

                    <div class="col-md-6  mb-3">
                        <label for="text" class="col-form-label">Permissão</label>
                        <select class="form-select" name="" id="">
                            <option selected>Selecione aqui</option>
                            <option value="">Nível Naconal</option>
                            <option value="">Nível Provincial</option>
                            <option value="">Nível Municipal</option>
                            <option value="">Nível de Localidade</option>
                        </select>
                        <span class="icon-input"><i class="bi bi-check-all"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Palavra Passe:</label>
                        <input type="password" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-unlock-fill"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Confirme a Palavra Passe:</label>
                        <input type="password" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-lock-fill"></i></span>
                    </div>

                </div>
            </form>
        </template>

        <template v-slot:alertas>
            <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Registo Realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
            <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar Registar Província" v-if="transacaoStatus == 'erro'"></alert-component>
        </template>

        <template v-slot:rodape>
            <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-principal">Submeter</button>
        </template>

    </modal-component>
</template>

<style scoped>
    @import '../../../css/modal.css';
</style>

<script>

    export default {
        
    }

</script>
