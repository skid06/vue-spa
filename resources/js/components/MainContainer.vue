<template>
  <v-app id="inspire">
    <v-navigation-drawer
      fixed
      v-model="drawer"
      app
    >
      <v-list dense>
        <v-list-tile router to="users">
          <v-list-tile-action>
            <v-icon>person</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Users</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile router to="tasks">
          <v-list-tile-action>
            <v-icon>assignment</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Projects</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile v-if="isLoggedIn">
          <v-list-tile-action>
            <v-icon>power</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>Logout</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>        
      </v-list>
    </v-navigation-drawer>
    <v-toolbar  dark fixed app>
      <v-toolbar-side-icon @click.stop="drawer = !drawer" class="hidden-md-and-up"></v-toolbar-side-icon>
      <v-toolbar-title class="toolbar-title">Vue App</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-sm-and-down" v-if="isLoggedIn">
        <v-btn flat dark router to="/users">Users</v-btn>
        <v-btn flat dark router to="/tasks">Projects</v-btn>
      </v-toolbar-items>
      <v-toolbar-items class="hidden-sm-and-down" v-if="isLoggedIn">
        <v-btn flat dark router to="/logout">Logout</v-btn>
      </v-toolbar-items>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height>
        <router-view> </router-view>
      </v-container>
    </v-content>
    <Footer />
  </v-app>  
</template>

<script>
  import { mapGetters, mapMutations } from 'vuex'
  import Footer from './Footer'

  export default {
    name: 'MainContainer',
    data() {
      return {
        drawer: false,
        drawerRight: false,
        right: null,
      }
    },
    computed: {
      ...mapGetters([
        'isLoggedIn'
      ]),
      ...mapMutations([
        'logout'
      ])
    },
    actions: {
      userLogout() {
        this.$store.commit('logout')
      }
    },
    components: {
      Footer
    }
  }
</script>
<style>
.toolbar-title{
  margin-left: 100px;
}
</style>
