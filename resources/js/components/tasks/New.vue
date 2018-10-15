<template>
  <div>
    <v-card class="elevation-12">
      <v-toolbar dark color="primary">
        <v-toolbar-title>Add Project</v-toolbar-title>
      </v-toolbar>
      <v-card-text>
        <form>
          <v-text-field
            v-validate="'required|min:3'"
            v-model="task.name"
            :counter="10"
            :error-messages="errors.collect('name')"
            label="Name"
            data-vv-name="name"
            required
          ></v-text-field>
          <v-text-field
            v-validate="'required|min:3'"
            v-model="task.contact_name"
            :counter="10"
            :error-messages="errors.collect('contact_name')"
            label="Contact Name"
            data-vv-name="contact_name"
            required
          ></v-text-field> 
          <v-text-field
            v-validate="'required|min:10|numeric'"
            v-model="task.contact_phone"
            :counter="10"
            :error-messages="errors.collect('contact_phone')"
            label="Contact Phone"
            data-vv-name="contact_phone"
            required
          ></v-text-field> 
          <v-text-field
            v-validate="'required|url'"
            v-model="task.website"
            :error-messages="errors.collect('website')"
            label="Website"
            data-vv-name="website"
            required
          ></v-text-field> 
          <v-text-field
            v-validate="'required|numeric'"
            v-model="task.cost"
            :error-messages="errors.collect('cost')"
            label="Cost"
            data-vv-name="cost"
            required
          ></v-text-field>               
          <v-select
            v-validate="'required'"
            :items="status"
            v-model="task.status"
            :error-messages="errors.collect('status')"
            label="Select Status"
            data-vv-name="status"
            required
          ></v-select>  
          <v-checkbox
            label="Add Comment"
            v-model="addComment"
            @click="comments = !comments"
            type="checkbox"
          ></v-checkbox>  
          <v-textarea
            v-validate="'required'"
            v-model="task.notes"
            :error-messages="errors.collect('notes')"
            label="Notes"
            data-vv-name="notes"
            v-if="comments"
            required
          ></v-textarea>          
          <v-btn @click="submit">submit</v-btn>
          <v-btn @click="clear">clear</v-btn>
        </form>        
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
  import validate from 'validate.js'
  export default {
    $_veeValidate: {
      validator: 'new'
    },
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
          notes: ''
        },
        // errors: null,
        addComment: false,
        comments: false,
        name: '',
        email: '',
        select: null,
        status: [
          'Done',
          'Working',
          'Pending',
          'Closed'
        ],
        checkbox: null,
        dictionary: {
          attributes: {
            contact_name: 'Contact Name',
            contact_phone: 'Contact Phone',
            name: 'Name',
            status: 'Status',
            website: 'Website',
            cost: 'Cost'
          },
          custom: {
            name: {
              required: () => 'Name can not be empty',
              max: 'The name field may not be greater than 10 characters'
              // custom messages
            }
          }
        }      
      }
    },
    methods: {
      submit () {
        this.$validator.validateAll().then((result) => {
          if(!result){
          return;
          }
          axios.post('/api/tasks/store', 
            {
              name: this.task.name,
              status: this.task.status,
              contact_name: this.task.contact_name,
              contact_phone: this.task.contact_phone,
              website: this.task.website,
              cost: this.task.cost,
              notes: this.task.notes,
              addComment: this.addComment        
            })
            .then(response => {
              console.log(response.data)
              this.clear()
              // this.$router.push('/tasks')
            })  
        })          
      },
      clear () {
        this.task = {}
        this.name = ''
        this.email = ''
        this.select = null
        this.checkbox = null
        this.$validator.reset()
      }            
    },
    mounted() {
      this.$validator.localize('en', this.dictionary)
    }
  }
</script>
<style scoped>
.errors{
  color: red;
}
</style>
