export default {
  state: {
    welcomeMessage: 'Welcome to my vue app.'
  },
  getters: {
    welcome(state) {
      return state.welcomeMessage
    }
  },
  actions: {},
  mutations: {}
}