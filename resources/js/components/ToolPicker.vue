<template>
    <div class="d-flex">
        <div class="btn-group-vertical">
            <button type="button"
                    :class="{'btn-success': selectedTool === 'pencil'}"
                    class="btn btn-sm btn-primary"
                    @click="enableTool('pencil')">
                Pencil
            </button>
            <button type="button"
                    :class="{'btn-success': selectedTool === 'brush'}"
                    class="btn btn-sm btn-primary"
                    @click="enableTool('brush')">
                Brush
            </button>
            <button type="button"
                    :class="{'btn-success': selectedTool === 'eraser'}"
                    class="btn btn-sm btn-primary"
                    @click="enableTool('eraser')">
                Eraser
            </button>
        </div>
    </div>
</template>

<script>
  import { mapGetters, mapMutations } from 'vuex'

  export default {
    name: 'ToolPicker',
    computed: {
      ...mapGetters('Drawing', [
        'getSelectedTool',
      ]),
      selectedTool: {
        get () { return this.getSelectedTool },
        set (tool) { this.setSelectedTool({tool})},
      },
    },
    methods: {
      ...mapMutations('Drawing', [
        'setSelectedTool',
      ]),
      enableTool (tool) {
        this.selectedTool = tool
      },
    },
  }
</script>

<style scoped>

</style>