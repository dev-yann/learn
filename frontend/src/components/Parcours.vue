<template>


    <v-layout row wrap>
      <v-flex xs12 lg7 offset-xs1 offset-lg3>
        <h1>{{parcours.title}}</h1>
      </v-flex>
      <Chat v-if="isload"></Chat>
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
            parcours : [],
            loadingTest: false
        }
    },
    methods:{

        // Permet la modification du parcours dans le state de vuex
        ...mapMutations(['setParcours'])

    },
      beforeMount () {

        // récupérer le parcours en question avec les exercices
          Url.get('/parcours/'+ this.$route.params.id ).then(response => {

              this.ex = response.data.exercices
              this.parcours = response.data.parcours

              this.setParcours(this.parcours)

          }).then(() => {
              // à partir de ce moment je peux lancer ma fonction de connection de chat
              // qui a besoin de l'id du parcours
              // fonction fleché pour garder le this

              this.loadingTest = true;

          }).catch(error => {
              console.log(error)
          })

      },
      computed: {

        // Permet la verification dynamiques de loadtesting
        isload: function () {

            return this.loadingTest

        }
      }
  }
</script>

<style scoped>

h1{
  margin:auto;
  text-align: center;
}
</style>
