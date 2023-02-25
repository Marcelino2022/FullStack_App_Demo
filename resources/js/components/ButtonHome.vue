<template>
    <div class="col-md-2">
        <a :href="href" :id="id">
            <div class="card button-card">
                <div><slot name="icon"></slot></div>
                <p><slot name="redirect"></slot></p>
            </div>
        </a>
    </div>
</template>

<style scoped>
    @import '../../css/buttonHome.css';
</style>

<script>
    export default {
        props: ['href', 'titulo'],
    }
</script>
