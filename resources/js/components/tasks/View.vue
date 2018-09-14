<template>
  <div class="task-view">
    <!-- <div class="user-img">
      <img src="https://www.scottsdaleazestateplanning.com/wp-content/uploads/2018/01/user.png" alt="">
    </div> -->
    <div class="user-info">
      <table class="table">
        <tr>
          <th>ID</th>
          <td>{{ task.id }}</td>
        </tr>
        <tr>
          <th>Project Name</th>
          <td>{{ task.name }}</td>
        </tr>
        <tr>
          <th>Status</th>
          <td>{{ task.status }}</td>
        </tr>
        <tr>
          <th>Contact Name</th>
          <td>{{ task.contact_name }}</td>
        </tr>  
        <tr>
          <th>Contact Phone</th>
          <td>{{ task.contact_phone }}</td>
        </tr>                              
      </table>
      <ul>
        <li v-for="note in task.notes" :key="note.id" >{{ note.notes }} by: {{ note.customer.name }}</li>
      </ul>
      <router-link to="/tasks">Back</router-link>
    </div>
    
  </div>
</template>
<script>
  import {mapGetters, mapActions} from 'vuex'
  export default {
    name: 'view-task',
    data() {
      return {
        task: {},
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
        // console.log(this.task)
      }
      else{
        // console.log('else')
        axios.get(`/api/tasks/${this.$route.params.id}`)
        .then(response => {
          console.log(response.data)
          this.task = response.data
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
.task-view {
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

</style>
