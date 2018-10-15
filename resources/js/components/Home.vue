<template>

</template>

<script>
  import { mapGetters } from 'vuex'
  import MainContainer from './MainContainer'
  export default {
      name: 'home',
      computed: {
        ...mapGetters([
          'isLoggedIn'
        ])
      },
      mounted() {
          console.log('Home mounted.')
      },
      components: {
          MainContainer
      }
  }
</script>
