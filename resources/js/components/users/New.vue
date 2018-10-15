<template>
  <div>
    <v-card class="elevation-12">
      <v-toolbar dark color="primary">
        <v-toolbar-title>Add User</v-toolbar-title>       
        <v-spacer></v-spacer>
        <v-tooltip bottom>
          <v-btn
            icon
            large
            :href="source"
            target="_blank"
            slot="activator"
          >
            <v-icon large>add</v-icon>
          </v-btn>
        </v-tooltip>        
      </v-toolbar>
      <v-card-text>  
        <form>
          <v-text-field
            v-validate="'required|min:3'"
            v-model="user.name"
            :error-messages="errors.collect('name')"
            label="Name"
            data-vv-name="name"
            prepend-icon="person"
            required
          ></v-text-field>

          <v-text-field
            v-validate="'required|email'"
            v-model="user.email"
            :error-messages="errors.collect('email')"
            label="Email"
            prepend-icon="email"
            data-vv-name="email"
            required
          ></v-text-field> 

          <v-text-field
            v-validate="'required|min:10|numeric'"
            v-model="user.phone"
            :counter="10"
            :error-messages="errors.collect('phone')"
            label="Phone"
            prepend-icon="phone"
            data-vv-name="phone"
            required
          ></v-text-field> 

          <v-text-field
            v-validate="'required|url'"
            v-model="user.website"
            :error-messages="errors.collect('website')"
            label="Website"
            prepend-icon="keyboard"
            data-vv-name="website"
            required
          ></v-text-field> 
                    
          <v-text-field
            ref="password"
            name="password"
            label="Password"
            data-vv-name="password"
            data-vv-delay="300"
            min="6"
            v-validate="'required|min:6|max:100'"
            v-model="user.password"
            :error-messages="errors.collect('password')"
            hint="It should be a minimum of 6 characters"
            prepend-icon="lock"
            :append-icon="isPasswordVisible ? 'visibility' : 'visibility_off'"
            :append-icon-cb="() => (isPasswordVisible = !isPasswordVisible)"
            :type="isPasswordVisible ? 'text' : 'password'"
          ></v-text-field> 

          <v-text-field
            label="Password confirmation"
            data-vv-name="password_confirmation"
            data-vv-delay="300"
            target= "password"
            v-validate="'required|confirmed:password'"
            v-model="user.password_confirmation"
            :error-messages="errors.collect('password_confirmation')"
            prepend-icon="lock"
            :append-icon="isPasswordVisible2 ? 'visibility' : 'visibility_off'"
            :append-icon-cb="() => (isPasswordVisible2 = !isPasswordVisible2)"
            :type="isPasswordVisible2 ? 'text' : 'password'"
          ></v-text-field>           
          <v-btn @click="add">submit</v-btn>
          <v-btn @click="clear">clear</v-btn>
        </form>  
      </v-card-text>
    </v-card>
  </div>  
</template>

<script>
  // import validate from 'validate.js'
  export default {
    $_veeValidate: {
      validator: 'new'
    },    
    name: 'new',
    data() {
      return {
        user: {
          name: '',
          email: '',
          phone: '',
          password: '',
          password_confirmation: '',
          website: '',
        },
        isPasswordVisible: false,
        isPasswordVisible2: false,        
        dictionary: {
          attributes: {
            contact_name: 'Contact Name',
            contact_phone: 'Contact Phone',
            name: 'Name',
            status: 'Status',
            website: 'Website',
            cost: 'Cost'
          },
        }        
        // errors: null
      }
    },
    computed: {
      currentUser() {
        return this.$store.getters.currentUser
      }
    },
    methods: {
      add() {
        // this.errors = null
        // const constraints = this.getConstraints()

        // const errors = validate(this.user, constraints)

        // if(errors){
        //   this.errors = errors
        //   return;
        // }
        this.$validator.validateAll().then((result) => {
          if(!result){
          return;
          }
          axios.post('/api/users/store', this.user)
          .then(response => {
            this.$router.push('/users')
          })
          .catch(errors => console.log(errors))  
        })   
      },
      clear () {
        this.user = {}
        this.$validator.reset()
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
          email: {
            presence: true,
            email: true
          },
          phone: {
            presence: true,
            numericality: true,
            length: {
              minimum: 10,
              message: 'Must be at least 10 digits long'
            }
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
