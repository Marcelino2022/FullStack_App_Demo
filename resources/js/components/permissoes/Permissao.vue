<template>
    <div class="container  margem-top">
        <div class="row  mt-5">

            <div class="col-md-1"></div>

            <div class="col-md-10">
                <br><br>
                <div class="row">
                    <div class="col-md-3 form-floating" id="filter">
                        <h2 class="">Funções</h2>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3 col-float-right">
                        <button type="button" class="btn-add"><i class="bi bi-plus"></i></button>
                    </div>
                </div>

                <hr>

                <table class="table table-striped table-borderless table-hover table-bordered mt-3">
                    <thead class="tableHeader">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Função</th>
                            <th scope="col">Adicionado em:</th>
                            <th scope="col">Nº Membros</th>
                            <th scope="col"><i class="bi bi-tools"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <th>
                                <i class="bi bi-eye-fill"></i>
                                <i class="bi bi-pencil-square"></i>
                                <i class="bi bi-trash-fill"></i>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <th>
                                <i class="bi bi-eye-fill"></i>
                                <i class="bi bi-pencil-square"></i>
                                <i class="bi bi-trash-fill"></i>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                            <th>
                                <i class="bi bi-eye-fill"></i>
                                <i class="bi bi-pencil-square"></i>
                                <i class="bi bi-trash-fill"></i>
                            </th>
                        </tr>
                    </tbody>
                </table>
<!--
                <div class="card mt-5">
                    <div class="card-header"> <h4>Lista</h4></div>
                    <div class="card-body">

                    </div>
                    <div class="card-footer">
                        <footer class="blockquote-footer mt-3">Atualizado em:<cite title="Source Title">20-05-2023 07:34:00:00</cite></footer>
                    </div>
                </div> -->
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</template>

<style>
    @import '../../../css/table.css';
</style>

<script>

export default {
    data(){
        return{
            urlBase: "http://127.0.0.1:8000/api/municipio",
        }
    }
}

</script>
