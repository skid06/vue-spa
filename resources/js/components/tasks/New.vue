<template>
  <div class="task-new">
    <form @submit.prevent="add">
      <table class="table">
        <tr>
          <th>Name</th>
          <td><input type="text" class="form-control" v-model="task.name" /></td>
        </tr>
        <tr>
          <th>Status</th>
          <td><input type="email" class="form-control" v-model="task.status" /></td>
        </tr>       
        <tr>
          <th>Contact Name</th>
          <td><input type="text" class="form-control" v-model="task.contact_name" /></td>
        </tr>
        <tr>
          <th>Contact Phone</th>
          <td><input type="text" class="form-control" v-model="task.contact_phone" /></td>
        </tr>              
        <tr>
          <th>Website</th>
          <td><input type="text" class="form-control" v-model="task.website" /></td>
        </tr>  
        <tr>
          <th>Cost</th>
          <td><input type="text" class="form-control" v-model="task.cost" /></td>
        </tr>         
        <tr>
          <td class="text-right">
            <router-link to="/customers" class="btn btn-danger">Cancel</router-link>
            <input type="submit" value="Create" class="btn btn-success" />
          </td>
        </tr>        
      </table>
    </form>
    <div class="errors" v-if="errors">
      <ul>
        <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
          <strong>{{ fieldName }}</strong>: {{ fieldsError.join('\n') }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  import validate from 'validate.js'
  export default {
    name: 'new',
    data() {
      return {
        task: {
          name: '',
          status: '',
          contact_name: '',
          contact_phone: '',
          website: '',
          cost: '',
        },
        errors: null
      }
    },
    methods: {
      add() {
        this.errors = null
        const constraints = this.getConstraints()

        const errors = validate(this.task, constraints)

        if(errors){
          this.errors = errors
          return;
        }

        axios.post('/api/customers/store', this.customer)
        .then(response => {
          this.$router.push('/customers')
        })
      },
      getConstraints() {
        return {
          name: {
            presence: true,
            length: {
              minimum: 3,
              message: 'Must be at least 3 characters long.'
            }
          },
          status: {
            presence: true,
            length: {
              minimum: 3,
              message: 'Must be at least 3 characters long.'
            }
          },
          contact_name: {
            presence: true,
            length: {
              minimum: 3,
              message: 'Must be at least 3 characters long.'
            }
          },          
          contact_phone: {
            presence: true,
            numericality: true,
            length: {
              minimum: 10,
              message: 'Must be at least 10 digits long'
            }
          },
          cost: {
            presence: true,
            numericality: true,
          },          
          website: {
            presence: true,
            url: true
          }
        }
      }
    }
  }
</script>
<style scoped>
.errors{
  color: red;
}
</style>
