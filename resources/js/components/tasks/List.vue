<template>
  <div>
    <v-card-title class="info">
      List of Projects
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
      :items="tasks"
      class="elevation-1"
      :search="search"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.name }}</td>
        <td class="text-xs-right">{{ props.item.status }}</td>
        <td class="text-xs-right">{{ props.item.contact_phone }}</td>
        <td class="text-xs-right">{{ props.item.contact_name }}</td>
        <td class="text-xs-right">{{ props.item.notes[0].notes }}</td>
        <td class="text-xs-right"><router-link :to="`/tasks/${props.item.id}`"><v-icon>pageview</v-icon></router-link></td>
      </template>  
      <template slot="footer">
        <td colspan="100%">
          <v-btn fab dark color="indigo" :to="{ path: 'tasks/new' }">
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
  import { mapGetters, mapActions, mapMutations } from 'vuex'
  export default {
    name: 'list-tasks',
    data(){
      return {
        search: '',
        headers: [
          { text: 'Name', value: 'name', align: 'center' },
          { text: 'Status', value: 'status', align: 'center' },
          { text: 'Contact Name', value: 'contact_name', align: 'center' },
          { text: 'Contact Phone', value: 'contact_phone', align: 'center' },
          { text: 'Notes', value: 'notes', align: 'center' },
          { text: 'View', value: 'view', align: 'center' },
        ]        
      }
    },
    methods: {
      ...mapActions([
        'getTasks',
        'paginate'
      ]),
      paginationItems() {
        return this.$store.state.task.meta.total
      }
    },
    computed: {
      ...mapGetters([
        'tasks',
        'paginationItem',
        'tasksLength'
      ])
    },    
    mounted() {
      this.getTasks()
    }
  }
</script>

<style scoped>
.btn-wrapper{
  text-align: right;
  margin-bottom: 20px;
}
</style>
