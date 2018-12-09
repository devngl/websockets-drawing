<template>
    <div id="drawing" class="rounded h-100">
    </div>
</template>

<script>
  import SVG from 'svg.js'
  import { mapGetters } from 'vuex'

  export default {
    name: 'whiteboard',
    data () {
      return {
        draw: null,
        drawing: false,
        polyline: null,
        drawingPath: [],
      }
    },
    computed: {
      ...mapGetters('Drawing', [
        'getSelectedTool',
        'getSelectedColor',
      ])
    },
    mounted () {
      this.draw = SVG('drawing').size('100%', '100%')
      this.draw.on('mousedown', () => {
        this.draw.on('mousemove', (e) => {
          const width = this.getSelectedTool === 'pencil' ? 1 : 8
          const color = this.getSelectedTool === 'eraser' ? '#FFF' : this.getSelectedColor

          this.drawingPath.push([e.offsetX, e.offsetY])
          if(this.polyline) this.polyline.remove()
          this.polyline = this.draw.polyline(this.drawingPath)
          this.polyline.fill('none')
          this.polyline.stroke({ color, width, linecap: 'round', linejoin: 'round' })

          // Here we will emit the partial draw
        })
      })

      this.draw.on('mouseup', (e) => {
        this.draw.off('mousemove')

        // Here we will emit the definitive polyline

        this.polyline = null;
        this.drawingPath = []
      })
    },
  }
</script>

<style scoped>
    #drawing {
        background-color: white;
        border: solid black 2px;
    }
</style>
