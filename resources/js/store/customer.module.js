
export default {
  state: {
    customers: []
  },
  getters: {
    customers(state) {
      return state.customers
    }                  
  },
  actions: {
    getCustomers(context){
      console.log('hitting getCustomers()')
      axios.get('/api/customers')
      .then(response => {
        context.commit('getCustomers', response.data.customers)
      })
      .catch(err => console.log(err))
    }
  },
  mutations: {
    getCustomers(state, data){
      state.customers = data
    },
  }
}