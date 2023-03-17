<template>
        <button type="button" :class="class" :id="id">
                <samp><slot name="icon"></slot></samp >
                <slot name="conteudo"></slot>
        </button>
</template>

<style scoped>
    @import '../../css/buttonComponent.css';
</style>

<script>
    export default {
        props: ['id','class', 'name'],
    }
</script>
