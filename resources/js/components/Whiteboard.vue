<template>
    <div id="drawing" class="rounded h-100">
    </div>
</template>

<script>
  import SVG from 'svg.js'
  import { mapGetters } from 'vuex'
  import axios from 'axios'

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
      ]),
    },

    mounted () {
      this.draw = SVG('drawing').size('100%', '100%')

      const room = (new URL(window.location.href)).searchParams.get('room')
      window.Echo.join(`room.${room}`).listen('DrawCompleted', (e) => {
        const {color, width, path} = e.shape
        const polyline = this.draw.polyline(path)
        this.stylePolyline(polyline, color, width)
      })

      this.draw.on('mousedown', () => {
        this.draw.on('mousemove', (e) => {
          const width = this.getSelectedTool === 'pencil' ? 1 : 8
          const color = this.getSelectedTool === 'eraser' ? '#FFF' : this.getSelectedColor

          this.drawingPath.push([e.offsetX, e.offsetY])
          if (this.polyline) this.polyline.remove()
          this.polyline = this.draw.polyline(this.drawingPath)
          this.stylePolyline(this.polyline, color, width)

          // Here we will emit the partial draw
        })
      })

      this.draw.on('mouseup', (e) => {
        this.draw.off('mousemove')

        // Here we emit the definitive polyline
        axios.post(`/api/rooms/${room}/lines`, {
          color: this.getSelectedTool === 'eraser' ? '#FFF' : this.getSelectedColor,
          width: this.getSelectedTool === 'pencil' ? 1 : 8,
          path: [...this.drawingPath],
        })

        this.polyline = null
        this.drawingPath = []
      })
    },

    methods: {
      stylePolyline (polyline, color, width) {
        polyline.fill('none')
        polyline.stroke({color, width, linecap: 'round', linejoin: 'round'})
      },
    },
  }
</script>

<style scoped>
    #drawing {
        background-color: white;
        border: solid black 2px;
    }
</style>
