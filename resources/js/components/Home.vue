<template>
    <div class="container" id="home">
        <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Home</div>
                <div class="card-body">
                <h5> {{ welcome }} </h5>
                </div>
            </div>
            </div>
        </div>
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
