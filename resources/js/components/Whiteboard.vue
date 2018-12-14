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
        room: null,
        draw: null,
        drawing: false,
        polyline: null,
        currentPolylineId: null,
        drawingPath: [],
      }
    },
    computed: {
      ...mapGetters('Drawing', [
        'getSelectedTool',
        'getSelectedColor',
      ]),

      lineColor () {
        return this.getSelectedTool === 'eraser' ? '#FFF' : this.getSelectedColor
      },
      lineWidth () {
        return this.getSelectedTool === 'pencil' ? 1 : 8
      },
      jsonLine () {
        if (!this.currentPolylineId) return {}

        return {
          id: this.currentPolylineId,
          color: this.lineColor,
          width: this.lineWidth,
          path: [...this.drawingPath],
        }
      },
    },

    mounted () {
      this.draw = SVG('drawing').size('100%', '100%')
      this.room = (new URL(window.location.href)).searchParams.get('room')

      this.listenForDrawCompletion()
      this.listenForPartialDraw()

      this.draw.on('mousedown', () => {
        this.currentPolylineId = 'trace_' + Math.random().toString(36).substring(7)
        this.draw.on('mousemove', (e) => {
          this.drawingPath.push([e.offsetX, e.offsetY])
          if (this.polyline) this.polyline.remove()
          this.polyline = this.draw.polyline(this.drawingPath)
          this.polyline.id(this.currentPolylineId)

          this.stylePolyline(this.polyline, this.lineColor, this.lineWidth)

          this.whisperPartialDraw()
        })
      })

      this.draw.on('mouseup', (e) => {
        this.draw.off('mousemove')

        this.postCompletedDrawing()
        this.polyline = null
        this.currentPolylineId = null
        this.drawingPath = []
      })
    },

    methods: {
      stylePolyline (polyline, color, width) {
        polyline.fill('none')
        polyline.stroke({color, width, linecap: 'round', linejoin: 'round'})
      },

      removeOldTrace (id) {
        let oldTrace = document.getElementById(id)
        if (oldTrace) oldTrace.remove()
      },

      drawLine (lineParams) {
        const {id, color, width, path} = lineParams
        this.removeOldTrace(id)
        const polyline = this.draw.polyline(path)
        polyline.id(id)
        this.stylePolyline(polyline, color, width)
      },

      listenForPartialDraw () {
        window.Echo.private(`room.${this.room}`).listenForWhisper('drawing', shape => this.drawLine(shape))
      },

      listenForDrawCompletion () {
        window.Echo.join(`room.${this.room}`).listen('DrawCompleted', ({shape}) => this.drawLine(shape))
      },

      /**
       * Backend doesn't need to know about a partial draw, so we
       * create a simple whisper.
       */
      whisperPartialDraw: _.debounce(function () {
        window.Echo.private(`room.${this.room}`).whisper('drawing', this.jsonLine)
      }, 100, {maxWait: 500}),

      /**
       * We will use axios and a PresenceChannel here. We might be
       * interested in persisting the line somewhere in the future.
       */
      postCompletedDrawing () {
        axios.post(`/api/rooms/${this.room}/lines`, this.jsonLine)
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
