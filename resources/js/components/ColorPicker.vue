<template>
    <div class="d-flex flex-column align-items-end colors-container">
        <div class="color-box"
             :class="{selected: selectedColor === color}"
             v-for="color in colors"
             :style="{'background-color': color}"
             @click="selectColor(color)"></div>
    </div>
</template>

<script>
  import { mapGetters, mapMutations } from 'vuex'

  const colors = [
    '#000000',
    '#797979',
    '#eb3c35',
    '#96a9eb',
    '#cbb825',
    '#005aff',
    '#3aff00',
    '#e915ff',
    '#ff9c00',
    '#00ffe7',
  ]

  export default {
    name: 'ColorPicker',
    data () {
      return {
        colors,
      }
    },
    computed: {
      ...mapGetters('Drawing', [
        'getSelectedColor',
      ]),
      selectedColor: {
        get () { return this.getSelectedColor },
        set (color) { this.setSelectedColor({color})},
      },
    },
    methods: {
      ...mapMutations('Drawing', [
        'setSelectedColor',
      ]),
      selectColor (color) {
        this.selectedColor = color
      },
    },
  }
</script>

<style scoped>
    .colors-container {
        border: 1px solid #CCC;
        background: #CCC;
        padding: 3px;
    }

    .color-box {
        width: 24px;
        height: 24px;
        border: 2px solid #000;
        margin-bottom: 1px;
        cursor: pointer;
    }

    .color-box.selected {
        border: 4px solid #FFF;
    }
</style>