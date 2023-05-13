<template>

    <adicionarLocalidade-component></adicionarLocalidade-component>

    <div class = "cover">
        <img src="../../../public/imagens/Cover.png" class="img-fluid" alt="...">
        <div class="container" id="content-cover">
            <h1>PRA-JÁ Servir Angola</h1>
            <h4>Por Angola, serei sempre servidor!</h4>
        </div>
    </div>

    <div class="container">

        <hr class="mb-3 mt-5">

        <card-component titulo="Coordenação Provincial de Luanda">
            <template v-slot:rodape>
                <span class="card-subtitle mb-2"><i class="bi bi-envelope-fill icon-color"></i> coordenacao@luanda.com</span>
                <span class="card-subtitle mb-2 ml-5"><i class="bi bi-phone-fill icon-color"></i> 923 451 241</span>
                <span class="card-subtitle mb-2 ml-5"><i class="bi bi-geo-alt-fill icon-color"></i> Avenida Deolinda Rodrigues 23</span>
            </template>
        </card-component>

        <br>
        <div class="row cards mb-5">

            <buttonHome-component href="/todos-os-membros">
                <template v-slot:icon><i class="bi bi-person"></i></template>
                <template v-slot:redirect>Membro</template>
            </buttonHome-component>


            <buttonHome-component href="/coordenacoes">
                <template v-slot:icon><i class="bi bi-building"></i></template>
                <template v-slot:redirect>Coordenação</template>
            </buttonHome-component>

            <buttonHome-component href="/provincias">
                <template v-slot:icon><i class="bi bi-map"></i></template>
                <template v-slot:redirect>Província</template>
            </buttonHome-component>

            <buttonHome-component href="/municipios">
                <template v-slot:icon><i class="bi bi-pin-map-fill"></i></template>
                <template v-slot:redirect>Município</template>
            </buttonHome-component>


            <buttonHome-component href="/localidades">
                <template v-slot:icon><i class="bi bi-geo"></i></template>
                <template v-slot:redirect>Localidade</template>
            </buttonHome-component>

            <buttonHome-component href="/funcoes">
                <template v-slot:icon><i class="bi bi-gear"></i></template>
                <template v-slot:redirect>Função</template>
            </buttonHome-component>

        </div>
    </div>

</template>

<style scoped>
    @import '../../css/home.css';
</style>

<script>


</script>
