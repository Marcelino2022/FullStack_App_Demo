<template>
    <div class="accordion genericAcc mt-3">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed " type="button" data-bs-toggle="collapse" :data-bs-target="dataBsTarget" aria-expanded="false" :aria-controls="ariaControls">
            <div class="cabecalho-acc">
                <slot name="image"></slot>
                <slot name="icone_i"></slot>
                <div>
                    <h4 class="mb-1"> {{ titulo }}</h4>
                    <h6>{{ subtitulo }}</h6>
                </div>
            </div>
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
        props:['id', 'titulo', 'subtitulo', 'class', 'localidade', 'parentId', 'dataBsToggle', 'dataBsTarget', 'ariaExpanded', 'ariaControls', 'dataBsParent','setStore']
    }
</script>
