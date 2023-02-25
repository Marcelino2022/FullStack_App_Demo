<template>
    <div class="form-floating" id="filter">
        <select class="form-select" :id="id" aria-label="Floating label select example">
            <option selected> <slot name="optionSelected"></slot> </option>
            <slot name='option'> {{ optionContent }}</slot>
        </select>
        <label for="floatingSelect"> <slot name="labelContent"></slot> </label>
        <span class="icon-form"><i class="bi bi-filter-circle-fill"></i></span>
    </div>
</template>

<style scoped>
    @import '../../css/filtro.css';
</style>
<script>
    export default {
        props: ['id', 'value', 'optionSelected', 'optionContent']
    }
</script>
