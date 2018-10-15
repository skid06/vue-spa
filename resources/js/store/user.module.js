
export default {
  state: {
    users: [],
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
    },
    errors: []    
  },
  getters: {
    users(state) {
      return state.users
    }                  
  },
  actions: {
    getUsers(context, page){
      let url = null
      if (page == null) {
        url = '/api/users'
      } else {
        url = `/api/users?page=${page}`
      }
      axios.get(url)
      .then(response => {
        console.log(response.data)
        context.commit('getUsers', response.data)
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
    getUsers(state, users){
      state.users = users.data
      state.links = users.links
      state.meta = users.meta        
    },
    paginate(state, users) {
      state.users = users.data
      state.links = users.links
      state.meta = users.meta    
    }     
  }
}