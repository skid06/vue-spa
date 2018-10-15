<template>
  <div>
    <v-card class="elevation-12">
      <v-toolbar dark color="primary">
        <v-toolbar-title>User & Activities</v-toolbar-title>
      </v-toolbar>
      <v-card-text>
        <form>
          <div slot="content">
            <v-text-field
              label="Name"
              v-model="user.name"
            >
            </v-text-field>
            <v-text-field
              label="Email"
              v-model="user.email"
            >
            </v-text-field>
            <v-text-field
              label="Phone"
              v-model="user.phone"
            >
            </v-text-field>
            <v-text-field
              label="Website"
              v-model="user.website"
            >
            </v-text-field>
          </div>
          <div class="news-list">
            <h3>User Notes:</h3>
            <ul>
              <li class="news-item" v-for="(item, index) in items" :key="index">
                <span class="text--primary">{{ item.notes }} </span> on {{ item.created_at | moment("dddd, MMMM Do YYYY") }} 
              </li>
            </ul>
          </div>     
        </form>
      </v-card-text>
    </v-card>
  </div>    
</template>
<script>
  import { mapGetters } from 'vuex'
  export default {
    name: 'view-user',
    mounted() {
      if(this.users.length) {
        this.user = this.users.find(user => user.id == this.$route.params.id)
        this.items = this.user.notes
      }
      else{
        axios.get(`/api/users/${this.$route.params.id}`)
          .then(response => {
            this.user = response.data
            console.log(this.user.notes)
            this.items = this.user.notes
            console.log(this.items)            
          })
      }
    },
    data() {
      return {
        user: '',
        items: {
          notes: []
        }
      }
    },
    computed: {
      currentUser() {
        return this.$store.getters.currentUser
      },
      ...mapGetters([
        'users'
      ])
    },  
  }
</script>

<style scoped>
.user-view {
  display: flex;
  align-items: center;
}
.user-img {
  flex: 1;
}
.user-img img {
  max-width: 160px;
}
.user-info {
  flex: 3;
  overflow-x: scroll;
}
.news-list{
  position: relative;
  margin: 30px 0;
  width: 100%;  
}
.news-list, .news-list-nav {
  background-color: #fff;
  border-radius: 2px;
}
.news-item {
  background-color: #eee;
  padding: 20px 30px 20px 80px;
  border-bottom: 1px solid #fff;
  position: relative;
  line-height: 20px;
}
.news-list ul {
  list-style-type: none;
  padding: 0;
  margin: 0;
}
</style>
