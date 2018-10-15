<template>
  <div>
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
      <div class="container">
        <router-link class="navbar-brand" to="/">Vue App</router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <template v-if="!currentUser">
              <li><router-link to="/login" class="nav-link">Login</router-link></li>
            </template>
            <template v-else>
              <li><router-link to="/tasks" class="nav-link">Projects</router-link></li>
              <li><router-link to="/users" class="nav-link">Users</router-link></li>
              <li class="nav-item dropdown">
                <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                  {{ currentUser.name }} <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a href="#!" @click.prevent="logout" class="dropdown-item">Logout</a>
                </div>
              </li>
            </template>
          </ul>
        </div>
      </div>
    </nav>  
  </div>  
</template>

<script>
import {mapGetters} from 'vuex'
export default {
  name: 'app-header',
  methods: {
    logout(){
      this.$store.commit('logout')
      this.$router.push('/login')
    }
  },
  computed: {
    ...mapGetters([
      'currentUser'
    ])
  },
  created() {
    console.log('Header mounted.')
  }
}
</script>
