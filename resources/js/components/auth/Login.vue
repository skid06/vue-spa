<template>
  <!-- <div class="login row justify-content-center">
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
  </div> -->
  <!-- <v-content> -->
    <v-container fluid fill-height>
      <v-layout align-center justify-center>
        <v-flex xs6>
          <v-card class="elevation-12">
            <v-toolbar dark color="primary">
              <v-toolbar-title>Login form</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-tooltip bottom>
                <v-btn
                  icon
                  large
                  :href="source"
                  target="_blank"
                  slot="activator"
                >
                  <v-icon large>code</v-icon>
                </v-btn>
                <span>Source</span>
              </v-tooltip>
            </v-toolbar>
            <v-card-text>
              <v-form>
                <v-alert
                  :value="true"
                  color="error"
                  icon="warning"
                  outline
                  v-if="authError"
                >
                  {{ authError }}
                </v-alert>                  
                <v-text-field 
                  prepend-icon="person" 
                  name="login" 
                  label="Login" 
                  type="text" 
                  v-model="form.email">
                </v-text-field>
                <v-text-field 
                  prepend-icon="lock" 
                  name="password" 
                  label="Password" 
                  id="password" 
                  type="password" 
                  v-model="form.password">
                </v-text-field>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>             
              <v-btn color="primary" @click.prevent="authenticate">Login</v-btn>
            </v-card-actions>
 
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  <!-- </v-content> -->
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
          this.$router.push({path: '/tasks'})          
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
  color: black;
}
</style>
