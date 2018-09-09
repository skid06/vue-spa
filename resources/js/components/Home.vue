<template>
    <div id="home">
        <h3>Home</h3>
        <h5> {{ welcome }} </h5>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  export default {
      name: 'home',
      computed: {
        ...mapGetters([
          'welcome'
        ])
      },
      mounted() {
          console.log('Home mounted.')
      }
  }
</script>
