<template>
        <button type="button" :class="class" :id="id">
                <span><slot name="icon"></slot></span>
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
