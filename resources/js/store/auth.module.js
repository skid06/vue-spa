import { getLocalUser } from "../services/auth"
// import axios from 'axios'

const user = getLocalUser();

export default {
  state: {
    currentUser: user,
    isLoggedIn: !! user,
    loading: false,
    auth_error: null,
    // customers: []
  },
  getters: {
    isLoading(state) {
      return state.loading
    },
    isLoggedIn(state) {
      return state.isLoggedIn
    },
    currentUser(state) {
      return state.currentUser
    },
    authError(state) {
      return state.auth_error
    },
    // customers(state) {
    //   return state.customers
    // }                  
  },
  actions: {
    login({commit}) {
      commit("login")
    },
    // getCustomers(context){
    //   console.log('hitting getCustomers()')
    //   axios.get('/api/customers')
    //   .then(response => {
    //     context.commit('getCustomers', response.data.customers)
    //   })
    //   .catch(err => console.log(err))
    // }
  },
  mutations: {
    // getCustomers(state, data){
    //   state.customers = data
    // },
    login(state) {
      state.loading = true
      state.auth_error = null
    },
    login_success(state, data) {
      state.auth_error = null
      state.isLoggedIn = true
      state.loading = false
      state.currentUser = Object.assign({}, data.user, {token: data.access_token})

      localStorage.setItem("user", JSON.stringify(state.currentUser))
    },
    login_failed(state, err) {
      state.loading = false
      state.auth_error = err
    },
    logout(state) {
      localStorage.removeItem("user")
      state.isLoggedIn = false
      state.currentUser = null
    }
  }
}