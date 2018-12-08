const state = {
  selectedTool: 'pencil',
  selectedColor: '#000000',
}

const getters = {
  getSelectedTool: state => state.selectedTool,
  getSelectedColor: state => state.selectedColor,
}

const mutations = {
  setSelectedTool (state, payload) { state.selectedTool = payload.tool },
  setSelectedColor (state, payload) { state.selectedTool = payload.color },
}

const actions = {}

export default {
  state, getters, mutations, actions,
}