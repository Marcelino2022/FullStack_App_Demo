<template>
    <div class="container mb-5 mt-5" id = "background">
        <div class="row justify-content-center card-register">
            <div class="col-md-8">
                <div class="card p-3">
                    <!--div class="card-header">register (Component Vue)</div-->
                    <div id="Logo-register">
                        <img src="../../../public/imagens/Logo-Web.png" class="" alt="...">
                    </div>

                    <div class="card-body">
                        <div class="mb-3 mt-3"><h3>Registar da Coordenação</h3></div><hr>
                        <form method="POST" action="">
                            <input type="hidden" name="_token">

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="col-form-label">Designação da Coordenação</label>
                                    <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
                                        <span class="invalid-feedback" role="alert">
                                            <strong></strong>
                                        </span>
                                </div>

                                <div class="col-md-3  mb-3">
                                    <label for="text" class="col-form-label">Telemóvel</label>
                                    <input id="text" type="text" class="form-control" name="text" required autocomplete="current-text">
                                </div>

                                <div class="col-md-3  mb-3">
                                    <label for="text" class="col-form-label">Telefone</label>
                                    <input id="text" type="text" class="form-control" name="text" required autocomplete="current-text">
                                </div>

                                <div class="col-md-6  mb-3">
                                    <label for="text" class="col-form-label">Email</label>
                                    <input id="text" type="text" class="form-control" name="text" required autocomplete="current-text">
                                </div>

                                <div class="col-md-3  mb-3">
                                    <label for="text" class="col-form-label">Província</label>
                                    <input id="text" type="text" class="form-control" name="text" required autocomplete="current-text">
                                </div>

                                <div class="col-md-3  mb-3">
                                    <label for="text" class="col-form-label">Município</label>
                                    <input id="text" type="text" class="form-control" name="text" required autocomplete="current-text">
                                </div>

                                <div class="col-md-6  mb-3">
                                    <label for="text" class="col-form-label">Localidade</label>
                                    <input id="text" type="text" class="form-control" name="text" required autocomplete="current-text">
                                </div>

                                <div class="col-md-6  mb-3">
                                    <label for="text" class="col-form-label">Endereço</label>
                                    <input id="text" type="text" class="form-control" name="text" required autocomplete="current-text">
                                </div>


                                <div class="col-md-6  mb-3">
                                    <label for="text" class="col-form-label">Permissão</label>
                                    <select class="form-select" name="" id="">
                                        <option value="">Nível Naconal</option>
                                        <option value="">Nível Provincial</option>
                                        <option value="">Nível Municipal</option>
                                        <option value="">Nível de Localidade</option>
                                    </select>
                                </div>

                                <div class="col-md-3  mb-3">
                                    <label for="text" class="col-form-label">Palavra Passe</label>
                                    <input id="text" type="text" class="form-control" name="text" required autocomplete="current-text">
                                </div>

                                <div class="col-md-3  mb-3">
                                    <label for="text" class="col-form-label">Confirme a Palavra Passe</label>
                                    <input id="text" type="text" class="form-control" name="text" required autocomplete="current-text">
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6" id="forgettext">
                                    <a class="btn btn-link" href="">Já estou registado</a>
                                </div>

                                <div class="col-md-6" id="rememberMe">
                                    <div class="form-check">
                                    </div>
                                </div>

                            </div>

                            <div class="d-grid gap-2 ml-auto">
                                <button class="btn btn-primary btn-entrar" type="submit">Registar-se</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import '../../css/register.css';
</style>

