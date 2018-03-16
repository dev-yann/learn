<template>
    <v-layout row wrap  v-if="isload">
      <v-flex xs12 lg7 offset-xs1 offset-lg3>
          <h1>Dis bonjour</h1>
        <h1>{{parcours.title}}</h1>
          <p>{{parcours.description}}</p>
          <p>proposez par {{parcours.author.username}}</p>

          <p v-if="!abonne"><v-btn color="success" @click="subscribe">S'incrire à se cours pour faire les exercices</v-btn></p>
          <p v-else>Vous êtes inscrit à ce parcours</p>
      </v-flex>

      <!-- Chat -->
       <Chat></Chat>

    </v-layout>
</template>

<script>
  import Url from './../services/config'
  import Chat from './Chat.vue'
  import { mapMutations } from 'vuex'


  export default{
    name : 'Parcours',
    components: {Chat},
    data () {
        return {
            ex : [],
            parcours : [],
            loadingTest: false
        }
    },
    methods:{

        // Ajouter le plugin interceptor pour envoyer le jwt automatiquement
        // https://github.com/martalexa/GeoQuizz_backoffice/blob/master/src/main.js


        // Permet la modification du parcours dans le state de vuex
        ...mapMutations(['setParcours']),
        subscribe () {
            Url.post('/connect/subscribe',{
                parcoursId : this.parcours.id,
                userId : this.$store.getters.getUser.id
            }).then(response => {
                console.log(response)
            }).catch(error => {
                console.log(error)
            })
        }

    },
      mounted () {

        // récupérer le parcours en question avec les exercices
          Url.get('/parcours/'+ this.$route.params.id ).then(response => {

              console.log(response);

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
        },
          abonne: function () {
              return this.parcours.subscribe;
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
