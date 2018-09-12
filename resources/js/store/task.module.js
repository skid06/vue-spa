export default {
  state: {
    tasks: [],
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
    tasks(state) {
      return state.tasks
    },
    tasksLength(state) {
      return state.tasks.length
    },    
    paginationItem(state) {
      let total
      return total = state.meta.total / state.meta.per_page
    }       
  },
  actions: {
    getTasks({commit}, page){
      console.log('hitting getTasks()')
      let url
      if (page == null) {
        url = '/api/tasks'
      } else {
        url = `/api/tasks?page=${page}`
      }
      axios.get(url)
      .then(response => {
        console.log(response.data)
        commit('getTasks', response.data)
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
    getTasks(state, tasks){
      state.tasks = tasks.data
      state.links = tasks.links
      state.meta = tasks.meta
    },
    paginate(state, tasks) {
      state.tasks = tasks.data
      state.links = tasks.links
      state.meta = tasks.meta    
    } 
  }
}