<template>
  <div>
    <v-card-title class="info">
      List of Users
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title> 
    <v-data-table
      :headers="headers"
      :items="users"
      class="elevation-1"
      :search="search"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.name }}</td>
        <td class="text-xs-right">{{ props.item.name }}</td>
        <td class="text-xs-right">{{ props.item.email }}</td>
        <td class="text-xs-right">{{ props.item.phone }}</td>
        <td class="text-xs-right"><router-link :to="`/users/${props.item.id}`"><v-icon>pageview</v-icon></router-link></td>
      </template>  
      <template slot="footer">
        <td colspan="100%">
          <v-btn fab dark color="indigo" :to="{ path: 'users/new' }">
            <v-icon dark>add</v-icon>
          </v-btn>
        </td>
      </template>       
      <v-alert slot="no-results" :value="true" color="error" icon="warning">
        Your search for "{{ search }}" found no results.
      </v-alert>      
    </v-data-table>  
  </div>   
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'
  export default {
    name: 'list',
    data() {
      return {
        search: '',
        headers: [
          { text: 'Name', value: 'name', align: 'center' },
          { text: 'Email', value: 'email', align: 'center' },
          { text: 'Phone', value: 'phone', align: 'center' },
          { text: 'View', value: 'view', align: 'center' },
        ]           
      }
    },
    methods: {
      ...mapActions([
        'getUsers',
        'paginate'
      ])
    },
    computed: {
      ...mapGetters([
        'users'
      ])
    },    
    mounted() {
      this.getUsers()

      if(!this.users.length) {
        return
      }      
    }
  }
</script>

<style scoped>
.btn-wrapper{
  text-align: right;
  margin-bottom: 20px;
}
</style>
