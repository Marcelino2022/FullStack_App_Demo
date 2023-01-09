<template>
    <div class="container" id = "background">
        <div class="row justify-content-center card-login">
            <div class="col-md-5">
                <div class="card p-3">
                    <!--div class="card-header">Login (Component Vue)</div-->
                     <div id="Logo-Login">
                        <img src="../../../public/imagens/Logo-Web.png" class="" alt="...">
                     </div>

                     <div class="card-body">
                        <form method="POST" action="" @submit.prevent="login($event)">
                            <input type="hidden" name="_token" :value = "csrf_token">

                            <div class="mb-3">
                                <label for="email" class="col-md-4 col-form-label">Email</label>
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus v-model="email">
                                    <span class="invalid-feedback" role="alert">
                                        <strong></strong>
                                    </span>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="col-md-4 col-form-label">Senha</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="password">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6" id="rememberMe">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">Mantenha-me conectado</label>
                                    </div>
                                </div>

                                <div class="col-md-6" id="forgetPassword">
                                    <a class="btn btn-link" href="">Esqueci a senha</a>
                                </div>
                            </div>

                            <div class="d-grid gap-2 ml-auto">
                                <button class="btn btn-primary btn-entrar" type="submit">Entrar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    @import '../../css/login.css';
</style>

<script>
    export default{
        props: [ 'csrf_token'],
        data(){
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            login(e){
                let url = 'http://127.0.0.1:8000/api/login'
                let configuracao = {
                    method: 'post',
                    body:  new URLSearchParams({
                        'email': this.email,
                        'password': this.password
                    })
                }
                fetch(url, configuracao)
                    .then(response => response.json())
                    .then(data => {
                        if(data.token){
                            document.cookie = 'token='+data.token
                        }
                    })
                e.target.submit()
            }
        }
    }
</script>
