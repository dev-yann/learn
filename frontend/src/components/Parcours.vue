<template>


    <v-layout row wrap>
      <v-flex xs12 lg7 offset-xs1 offset-lg3>
        <h1>{{parcours.title}}</h1>
      </v-flex>
      <Chat></Chat>
    </v-layout>

</template>

<script>
  import Url from './../services/config'
  import Chat from './Chat.vue'
  import { mapMutations } from 'vuex'
  export default{
    name : 'Parcours',
      components: {
        Chat
      },
    data () {
        return {
            ex : [],
            parcours : []
        }
    },
    methods:{

        ...mapMutations(['setParcours'])

    },
      mounted () {

        // récupérer le parcours en question avec les exercices
          Url.get('/parcours/'+ this.$route.params.id ).then(response => {

              this.ex = response.data.exercices
              this.parcours = response.data.parcours


              this.setParcours(this.parcours)

          }).catch(error => {
              console.log(error)
          })

      }
  }
</script>

<style scoped>

h1{
  margin:auto;
  text-align: center;
}
</style>
