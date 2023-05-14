<template>
     <div class="form-group mt-3">
<!--         <label :for="id" class="col-form-label">{{ titulo }}</label> -->
        <slot></slot>
        <div :id="idHelp" class="form-text text-muted"> {{ textoAjuda }}</div>
     </div>

</template>

<script>
    export default {
        props: ['id', 'titulo', 'idHelp', 'textoAjuda', 'placeholder']
    }
</script>
