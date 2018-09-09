<template>
  <div class="login row justify-content-center">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          Login
        </div>
        <div class="card-body">
          <form >
            <div class="form-group row">
              <label for="email">Email:</label>
              <input type="email" v-model="form.email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group row">
              <label for="password">Password:</label>
              <input type="password" v-model="form.password" class="form-control" placeholder="Password">
            </div>          
            <div class="form-group row">
              <input type="submit" value="Login" @click.prevent="authenticate">
            </div>        
            <div class="form-group row" v-if="authError">
              <p class="error">
                {{ authError }}
              </p>
            </div>          
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {setAuthorization} from '../../services/route-checker'
import { mapGetters } from 'vuex'
// import axios from 'axios'
  export default {
    data () {
      return {
        form: {
          email: '',
          password: ''
        }
      }
    },
    methods: {
      authenticate() {
        // this.$store.dispatch('login')
        // login(this.$data.form)
        //   .then(response => {
        //     console.log(response.data)
        //     this.$store.commit("login_success", response)
        //     this.$router.push({path: '/'})
        //   })
        //   .catch(err => {
        //     this.$store.commit("login_failed", {err})
        //   })
      this.$store.dispatch('login')
      axios.post('/api/auth/login', this.form)
        .then(response => {
          console.log(response.data)
          setAuthorization(response.data.access_token)
          this.$store.commit("login_success", response.data)
          this.$router.push({path: '/'})          
        })
        .catch(err => {
          this.$store.commit("login_failed", 'Wrong email or password.')
          console.log({err})
        })
      }
    },
    computed: {
      ...mapGetters([
        'authError'
      ])
    }
  }
</script>

<style>
.error{
  text-align: center;
  color: red;
}
</style>
