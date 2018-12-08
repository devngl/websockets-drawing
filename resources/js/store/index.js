import Vue from 'vue'
import Vuex from 'vuex'
import Drawing from '@/js/store/modules/drawing'

Vue.use(Vuex)

export const store = new Vuex.Store({
  modules: {
    Drawing: {namespaced: true, ...Drawing},
  },
  strict: process.env.NODE_ENV !== 'production',
})

export default store