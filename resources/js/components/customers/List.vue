<template>
  <div>
    <div class="btn-wrapper">
      <router-link to="/customers/new" class="btn btn-primary btn-sm">New</router-link>
    </div>
    <table class="table">
      <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
      </thead>
      <tbody>
        <template v-if="!customers.length">
          <tr>
            <td colspan="4" class="text-center">No Customers Available</td>
          </tr>
        </template>
        <template v-else>
          <tr v-for="customer in customers" :key="customer.id">
            <td>{{ customer.name }}</td>
            <td>{{ customer.email }}</td>
            <td>{{ customer.phone }}</td>
            <td>
              <router-link :to="`/customers/${customer.id}`">View</router-link>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item" :class="{ disabled: !$store.state.customer.links.prev }">
          <a class="page-link" href="#" @click.prevent="paginate($store.state.customer.links.first)" tabindex="-1">First</a>
        </li>
        <li class="page-item" :class="{ disabled: !$store.state.customer.links.prev }">
          <a class="page-link" href="#" @click.prevent="paginate($store.state.customer.links.prev)" tabindex="-1"><<</a>
        </li>
        <!-- <li class="page-item" v-for="(item, index) in paginationItem" :key="index">
          <a class="page-link" href="#" @click.prevent="getcustomers(index + 1)">{{ index + 1 }}</a>
        </li> -->
        <li class="page-item disabled"> <a class="page-link" href="#"> {{ $store.state.customer.meta.current_page }} of {{ $store.state.customer.meta.last_page }} </a> </li>
        <li class="page-item" :class="{ disabled: !$store.state.customer.links.next }">
          <a class="page-link" href="#" @click.prevent="paginate($store.state.customer.links.next)" tabindex="-1">>></a>
        </li>
        <li class="page-item" :class="{ disabled: !$store.state.customer.links.next }">
          <a class="page-link" href="#" @click.prevent="paginate($store.state.customer.links.last)" tabindex="-1">Last</a>
        </li>
      </ul>
    </nav>      
  </div>
</template>

<script>
  import {mapGetters, mapActions} from 'vuex'
  export default {
    name: 'list',
    methods: {
      ...mapActions([
        'getCustomers',
        'paginate'
      ])
    },
    computed: {
      ...mapGetters([
        'customers'
      ])
    },    
    mounted() {
      this.getCustomers()

      if(this.customers.length) {
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
