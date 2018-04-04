<template>
  <v-container fluid>
    <v-layout row wrap>
      <v-flex xs12 md6 offset-md3>

        <h1>Modifier un parcours</h1>
        <v-text-field v-model="parcours.title" name="name" label="Nom du parcours"></v-text-field>
        <v-text-field v-model="parcours.temps" name="time" label="temps du parcours"></v-text-field>
        <v-text-field v-model="parcours.level" name="level" label="Niveau de difficulté de 1 a 3"></v-text-field>
        <v-text-field v-model="parcours.description" name="level" label="description" :multi-line="line" ></v-text-field>
        <v-btn color="light-green lighten-1" @click="edit">Modifier le parcours</v-btn>

    </v-flex>
</v-layout>
</v-container>

</template>

<script>
import Url from './../services/configJwt';
import { mapMutations } from 'vuex';
export default {
    name: "edit-parcours",
    data () {
        return {
            parcours :[],
            line : true
        }
    },
    mounted() {
     Url.get('/parcours/'+ this.$route.params.id ).then(response => {



      this.ex = response.data.exercices
      this.parcours = response.data.parcours

      this.setParcours(this.parcours)

  }).then(() => {
              // à partir de ce moment je peux lancer ma fonction de connection de chat
              // qui a besoin de l'id du parcours
              // fonction fleché pour garder le this

              this.loadingTest = true;
                 this.parcours = this.$store.state.parcours

          }).catch(error => {
              console.log(error)
          })

      },
  
  methods: {
      ...mapMutations(['setParcours','getUser']),
    edit () {
        Url.patch('/connect/parcours/'+this.parcours.id+'/edit',{
            title : this.parcours.title,
                    /**
                     * todo: ajouter le state sur cette app
                     */
                    author_id : this.getUser.id, // getters de l'auteur,
                    level : this.parcours.level,
                    temps : this.parcours.temps,
                    description: this.parcours.description
                }).then(response => {
                  this.$router.push('/parcours')
                  console.log(response)
              }).catch(error => {
                console.log(error)
            })
          }
      }
}
</script>

<style scoped>

</style>
