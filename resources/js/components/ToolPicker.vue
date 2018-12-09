<template>
    <div class="d-flex flex-column">
        <div class="btn-group-vertical">
            <button type="button"
                    :class="{'btn-success': selectedTool === 'pencil'}"
                    class="btn btn-sm btn-primary"
                    @click="enableTool('pencil')">
                <i class="ti ti-pencil-alt2"></i>
            </button>
            <button type="button"
                    :class="{'btn-success': selectedTool === 'brush'}"
                    class="btn btn-sm btn-primary"
                    @click="enableTool('brush')">
                <i class="ti ti-brush-alt"></i>
            </button>
            <button type="button"
                    :class="{'btn-success': selectedTool === 'eraser'}"
                    class="btn btn-sm btn-primary"
                    @click="enableTool('eraser')">
                <i class="ti ti-eraser"></i>
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