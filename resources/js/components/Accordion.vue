<template>
    <div class="accordion mt-3">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" :data-bs-target="dataBsTarget" aria-expanded="false" :aria-controls="ariaControls">
            <i class="bi bi-geo" id="icon-location"></i><h4>{{ titulo }}</h4>
          </button>
        </h2>
        <div  :id="parentId" class="accordion-collapse collapse" :data-bs-parent="dataBsParent">
          <slot name="items">
            <div class="accordion-body"></div>
          </slot>
        </div>
      </div>
    </div>
</template>

<style scoped>
    @import '../../css/accordion.css';
</style>
<script>
    export default {
        props:['id', 'titulo', 'class', 'localidade', 'parentId', 'dataBsToggle', 'dataBsTarget', 'ariaExpanded', 'ariaControls', 'dataBsParent']
    }
</script>
