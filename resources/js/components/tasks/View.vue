<template>
  <div>
    <v-card class="elevation-12">
      <v-toolbar dark color="primary">
        <v-toolbar-title>Edit Project</v-toolbar-title>
      </v-toolbar>
      <v-card-text>
        <form>
          <div slot="content">
            <v-text-field
              label="Project Name"
              v-model="task.name"
              :rules="[required]">
            </v-text-field>
            <v-text-field
              label="Assigned To"
              v-model="task.user.name"
              disabled>
            </v-text-field>
            <v-text-field
              label="Status"
              v-model="task.status"
              :rules="[required]">
            </v-text-field>
            <v-text-field
              label="Contact Name"
              v-model="task.contact_name"
              :rules="[required]">
            </v-text-field>
            <v-text-field
              label="Contact Phone"
              v-model="task.contact_phone"
              :rules="[required]">
            </v-text-field>
          </div>
          <v-card>
            <v-card-title primary-title>
              <h3 class="headline mb-0">Notes</h3>
            </v-card-title>
            <v-list two-line>
              <template v-for="(item, index) in items.notes">
                <v-subheader
                  v-if="item.header"
                  :key="item.header"
                >
                  Notes
                </v-subheader>

                <v-divider
                  v-else-if="item.divider"
                  :inset="item.inset"
                  :key="index"
                ></v-divider>

                <v-list-tile
                  v-else
                  :key="item.title"
                  avatar
                  @click=""
                >
                  <!-- <v-list-tile-avatar>
                    <img :src="item.avatar">
                  </v-list-tile-avatar> -->

                  <v-list-tile-content>
                    <!-- <v-list-tile-title v-html="item.user.name"></v-list-tile-title> -->
                    <v-list-tile-sub-title><span class="text--primary">{{ item.notes }} </span> on {{ item.created_at | moment("dddd, MMMM Do YYYY") }} </v-list-tile-sub-title>
                    <v-list-tile-sub-title>by: {{ item.user.name }}</v-list-tile-sub-title>
                  </v-list-tile-content>
                </v-list-tile>
              </template>
            </v-list>
            </v-card>      
        </form>
      </v-card-text>
    </v-card>
  </div>     
</template>
<script>
  import {mapGetters, mapActions} from 'vuex'
  export default {
    name: 'view-task',
    data() {
      return {
        task: {},
        items: []
      }
    },    
    computed: {
      ...mapGetters([
        'tasks'
      ])
    },  
    mounted() {
      if(this.tasks.length) {
        // console.log('if')
        this.task = this.tasks.find(task => task.id == this.$route.params.id)
        this.items = this.task
        // console.log(this.task)
      }
      else{
        // console.log('else')
        axios.get(`/api/tasks/${this.$route.params.id}`)
        .then(response => {
          console.log(response.data)
          this.task = response.data
          this.items = this.task
          console.log(this.task)
        })
        .catch(err => {
          console.log(err)
          // console.log('else catch')
        })
      }
    }    
  }
</script>

<style scoped>
</style>
