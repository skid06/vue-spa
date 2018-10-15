<template>
  <v-container fluid fill-height>
    <v-layout>
      <v-flex xs12 md8 offset-md2 dark> 
        <router-view></router-view>
      </v-flex>    
    </v-layout>    
  </v-container>    
</template>

<script>
  export default {
    name: 'customer-main'
  }
</script>