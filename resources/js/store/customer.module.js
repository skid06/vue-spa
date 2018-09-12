
export default {
  state: {
    customers: [],
    links:{
      first: null,
      last: null,
      next: null,
      prev: null
    },
    meta:{
      current_page: null,
      from: null,
      last_page: null,
      path: null,
      per_page: null,
      to: null,
      total: null
    }    
  },
  getters: {
    customers(state) {
      return state.customers
    }                  
  },
  actions: {
    getCustomers(context, page){
      let url = null
      if (page == null) {
        url = '/api/customers'
      } else {
        url = `/api/customers?page=${page}`
      }
      axios.get(url)
      .then(response => {
        console.log(response.data)
        context.commit('getCustomers', response.data)
      })
      .catch(err => console.log(err))
    },
    paginate({commit}, url) {
      axios.get(url)
      .then(response => {
        console.log(response.data)
        commit('paginate', response.data)
      })
      .catch(err => console.log(err))      
    }      
  },
  mutations: {
    getCustomers(state, customers){
      state.customers = customers.data
      state.links = customers.links
      state.meta = customers.meta        
    },
    paginate(state, customers) {
      state.customers = customers.data
      state.links = customers.links
      state.meta = customers.meta    
    }     
  }
}