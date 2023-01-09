<template>

    <!--div class="modal fade" id="membroModal" tabindex="-1" aria-labelledby="membroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="membroModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div-->

    <modal-component  id="membroModal" titulo="Adicionar Membros">
        <template v-slot:conteudo>
            <form>
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="recipient-name" class="col-form-label">Nome Completo:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-person-lines-fill"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Número de Documento:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-credit-card-2-front-fill"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Tipo de Documento:</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Selecione aqui</option>
                            <option value="1">B.I</option>
                            <option value="2">Passaporte</option>
                            <option value="3">Cédula Pessoal</option>
                        </select>
                        <span class="icon-input"><i class="bi bi-card-checklist"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Data de Nascimento:</label>
                        <input type="date" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-calendar3"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Telemóvel:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-phone-vibrate-fill"></i></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="recipient-name" class="col-form-label">Morada:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-pin-map-fill"></i></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-envelope-fill"></i></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="recipient-name" class="col-form-label">Categoria:</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Selecione aqui</option>
                            <option value="1">Juventude</option>
                            <option value="2">Mulher</option>
                            <option value="3">Geral</option>
                        </select>
                        <span class="icon-input"><i class="bi bi-card-checklist"></i></span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="recipient-name" class="col-form-label">Função</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Selecione aqui</option>
                            <option value="1">Coordenador Provincia da Juventude</option>
                            <option value="2">Vice-Coordenador Provincia da Juventude</option>
                            <option value="3">Secrettário Geral de Luanda</option>
                        </select>
                        <span class="icon-input"><i class="bi bi-card-checklist"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Data de Alistamento:</label>
                        <input type="date" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-calendar3"></i></span>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="recipient-name" class="col-form-label">Telemóvel Mobilzador</label>
                        <input type="text" class="form-control" id="recipient-name">
                        <span class="icon-input"><i class="bi bi-phone-vibrate-fill"></i></span>
                    </div>
                </div>
            </form>
        </template>

        <template v-slot:rodape>
            <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-principal">Submeter</button>
        </template>

    </modal-component>


    <!--div class="modal fade" id="membroModal" tabindex="-1" aria-labelledby="membroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="membroModalLabel">Adicionar Membro</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="recipient-name" class="col-form-label">Nome Completo:</label>
                            <input type="text" class="form-control" id="recipient-name">
                            <span class="icon-input"><i class="bi bi-person-lines-fill"></i></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="recipient-name" class="col-form-label">Número de Documento:</label>
                            <input type="text" class="form-control" id="recipient-name">
                            <span class="icon-input"><i class="bi bi-credit-card-2-front-fill"></i></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="recipient-name" class="col-form-label">Tipo de Documento:</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Selecione aqui</option>
                                <option value="1">B.I</option>
                                <option value="2">Passaporte</option>
                                <option value="3">Cédula Pessoal</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-card-checklist"></i></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="recipient-name" class="col-form-label">Data de Nascimento:</label>
                            <input type="date" class="form-control" id="recipient-name">
                            <span class="icon-input"><i class="bi bi-calendar3"></i></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="recipient-name" class="col-form-label">Telemóvel:</label>
                            <input type="text" class="form-control" id="recipient-name">
                            <span class="icon-input"><i class="bi bi-phone-vibrate-fill"></i></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="recipient-name" class="col-form-label">Morada:</label>
                            <input type="text" class="form-control" id="recipient-name">
                            <span class="icon-input"><i class="bi bi-pin-map-fill"></i></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="recipient-name" class="col-form-label">Email:</label>
                            <input type="text" class="form-control" id="recipient-name">
                            <span class="icon-input"><i class="bi bi-envelope-fill"></i></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="recipient-name" class="col-form-label">Categoria:</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Selecione aqui</option>
                                <option value="1">Juventude</option>
                                <option value="2">Mulher</option>
                                <option value="3">Geral</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-card-checklist"></i></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="recipient-name" class="col-form-label">Função</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Selecione aqui</option>
                                <option value="1">Coordenador Provincia da Juventude</option>
                                <option value="2">Vice-Coordenador Provincia da Juventude</option>
                                <option value="3">Secrettário Geral de Luanda</option>
                            </select>
                            <span class="icon-input"><i class="bi bi-card-checklist"></i></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="recipient-name" class="col-form-label">Data de Alistamento:</label>
                            <input type="date" class="form-control" id="recipient-name">
                            <span class="icon-input"><i class="bi bi-calendar3"></i></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="recipient-name" class="col-form-label">Telemóvel Mobilzador</label>
                            <input type="text" class="form-control" id="recipient-name">
                            <span class="icon-input"><i class="bi bi-phone-vibrate-fill"></i></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondario" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-principal">Submeter</button>
            </div>
            </div>
        </div>
    </div-->
    <!-- Modal -->

</template>

<style scoped>
    @import '../../css/modalAdicionar.css';
</style>
