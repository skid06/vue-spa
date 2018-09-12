<template>
  <div>
    <div class="btn-wrapper">
      <router-link to="/tasks/new" class="btn btn-primary btn-sm">New</router-link>
    </div>
    <table class="table">
      <thead>
        <th>Name</th>
        <th>Status</th>
        <th>Contact Phone</th>
        <th>Contact Name</th>
        <th>Actions</th>
      </thead>
      <tbody>
        <template v-if="!tasksLength">
          <tr>
            <td colspan="4" class="text-center">No Tasks Available</td>
          </tr>
        </template>
        <template v-else>
          <tr v-for="task in tasks" :key="task.id">
            <td>{{ task.name }}</td>
            <td>{{ task.status }}</td>
            <td>{{ task.contact_name }}</td>
            <td>{{ task.contact_phone }}</td>
            <td>
              <router-link :to="`/tasks/${task.id}`">View</router-link>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item" :class="{ disabled: !$store.state.task.links.prev }">
          <a class="page-link" href="#" @click.prevent="paginate($store.state.task.links.first)" tabindex="-1">First</a>
        </li>
        <li class="page-item" :class="{ disabled: !$store.state.task.links.prev }">
          <a class="page-link" href="#" @click.prevent="paginate($store.state.task.links.prev)" tabindex="-1"><<</a>
        </li>
        <!-- <li class="page-item" v-for="(item, index) in paginationItem" :key="index">
          <a class="page-link" href="#" @click.prevent="getTasks(index + 1)">{{ index + 1 }}</a>
        </li> -->
        <li class="page-item disabled"> <a class="page-link" href="#"> {{ $store.state.task.meta.current_page }} of {{ $store.state.task.meta.last_page }} </a> </li>
        <li class="page-item" :class="{ disabled: !$store.state.task.links.next }">
          <a class="page-link" href="#" @click.prevent="paginate($store.state.task.links.next)" tabindex="-1">>></a>
        </li>
        <li class="page-item" :class="{ disabled: !$store.state.task.links.next }">
          <a class="page-link" href="#" @click.prevent="paginate($store.state.task.links.last)" tabindex="-1">Last</a>
        </li>
      </ul>
    </nav>    
  </div>
</template>

<script>
  import {mapGetters, mapActions, mapMutations} from 'vuex'
  export default {
    name: 'list-tasks',
    totalPage: null,
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
