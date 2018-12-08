<template>
    <div id="drawing" class="rounded">
    </div>
</template>

<script>
    import SVG from 'svg.js'

  export default {
    name: 'whiteboard',
    mounted () {
        SVG('drawing').height(500)
    },
  }
</script>

<style scoped>
    #drawing {
        background-color: white;
        border: solid black 2px;
    }
</style>
