<template>
  <v-container >
    <v-layout row justify-center>
      <router-link to="/exercices/add"><v-btn color="light-green lighten-1" dark @click.stop="dialog3 = true">Ajouter un exercice</v-btn></router-link>
    </v-layout>
    <v-layout>
      <v-flex xs12 sm6 offset-sm3>

       <v-card v-for="exercice in exercices" :key="exercices.id">
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0 ">{{exercice.title}}</h3>
            <div class="">{{exercice.description}}</div>
            <div class="">Dernière modification : {{exercice.updated_at}}</div>
          </div>
        </v-card-title>
        <v-card-actions>
          <router-link to="/exercices"><v-btn flat color="light-green lighten-1">Accéder à l'exercice</v-btn></router-link>
        </v-card-actions>
        <v-card-actions>
          <router-link :to = "{
          name : 'modify',
          params : {
            id : exercice.id,
            type : exercice.unit_test,
            title_true : exercice.title,
            description : exercice.description
            }}"><v-btn flat color="light-green lighten-1">Modifier</v-btn></router-link>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</v-container>
</template>

<script>
import Url from './../services/configJwt'
import { mapMutations } from 'vuex'

export default {
  name: "exercices",
  data () {
    return {
      exercices: {}
    }
  },
  mounted(){
    Url.get('/connect/parcours/'+ this.$route.params.id).then(response => {

      console.log(response);
      this.exercices = response.data.exercices;
      this.loadingTest = true;
      this.setParcours(response.data.parcours);

    }).catch(error => {

      console.log(error)
    })
  },
  methods : {
    ...mapMutations(['setParcours'])
  }
}
</script>

<style scoped>

</style>
