<template>
    <v-layout row wrap v-if="isload">

      <v-flex xs12 sm8 md6 offset-sm2 offset-md3 class="conteneurCard">
      <v-card class="card">
        <v-card-title primary-title>
          <div>
            <h1 class="headline mb-0">{{parcours.title}}</h1>
            <div class="auteur"><i>{{parcours.author}}</i></div>
            <div class="description">{{parcours.description}}</div>
          </div>
        </v-card-title>

        <v-card-actions>
          <p v-if="!abonne"><v-btn flat color="light-green lighten-1" @click="subscribe">S'incrire à ce cours</v-btn></p>
          <div v-else class="inscrit">Vous êtes inscrit à ce cours</div>
        </v-card-actions>

      </v-card>
    </v-flex>

    <v-flex xs12 sm8 md6 offset-sm2 offset-md3 class="conteneurCard">
      <v-divider></v-divider>
    </v-flex>

        <v-flex xs12 sm8 md6 offset-sm2 offset-md3  v-for="exercice in ex" :key="exercice.id" class="conteneurExercice">
            <v-card class="exercice">
                <v-card-title primary-title>
                    <div>
                        <h2 class="headline mb-0">{{exercice.title}}</h2>
                        <div>{{exercice.description}}</div>
                    </div>
                </v-card-title>
                <v-card-actions>
                    <router-link :to="{ name: 'exercice', params: { id : parcours.id, ide : exercice.id }}"><v-btn flat color="light-green lighten-1">Allez à l'exercice</v-btn></router-link>
                </v-card-actions>
            </v-card>
        </v-flex>

      <!-- Chat -->
       <Chat></Chat>

    </v-layout>
</template>

<script>
  import Url from './../services/config'
  import UrlJwt from './../services/configJwt'
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
            UrlJwt.post('/connect/subscribe',{
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
.description{
   text-align: justify;
   margin-top : 15px;
   text-indent : 10px;
}
.auteur{
   text-align: center;
   color : #DDD;
}
.inscrit{
   color : #DDD;
   text-indent : 10px;
   margin-bottom: 5px;
}
.conteneurCard{
   display: flex;
   align-items: center;
   justify-content:center;
   margin-bottom : 20px;
}
.card{
   width:100%;
}
.exercice{
  margin-bottom:10px;
}
</style>
