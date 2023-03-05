<template>
    <div class="form-floating" id="filter">
        <label :for="id" class="col-form-label">{{ titulo }}</label>
        <select class="form-select" :id="id" aria-label="Floating label select example">
            <option selected> <slot name="optionSelected"></slot> </option>
            <slot name='option'> {{ optionContent }}</slot>
        </select>
        <label for="floatingSelect"> <slot name="labelContent"></slot> </label>
        <span class="icon-form"><i :class="class"></i></span>
    </div>
</template>

<style scoped>
    @import '../../css/filtro.css';
</style>
<script>
    export default {
        props: ['id', 'titulo', 'value', 'optionSelected', 'optionContent', 'class']
    }
</script>
