<template>
  <div class="container">
    <form @submit="log" >
      <v-container  grid-list-md text-xs-center>

        <v-layout row wrap>
          <v-flex xs12>
            <h1>Connexion</h1>
          </v-flex>

          <v-flex xs12 sm8 md6 offset-sm2 offset-md3>
              <v-text-field  type="text" label="Name" v-model="name" :rules="nameRules" required></v-text-field>
          </v-flex>

          <v-flex xs12 sm8 md6 offset-sm2 offset-md3>
              <v-text-field type="password" label="Password" v-model="password" required></v-text-field>
          </v-flex>

          <v-flex xs12 sm8 md6 offset-sm2 offset-md3>
            <v-btn type='submit'>Se connecter</v-btn>
          </v-flex>

          <v-flex xs12 sm8 md6 offset-sm2 offset-md3>
            <router-link to="/inscription">Je n'ai pas encore de compte</router-link>
          </v-flex>

        </v-layout>
      </v-container>
    </form>
  </div>
</template>

<script>
import Inscription from '@/components/Inscription'
import url from './../services/config'
import ls from './../services/localStorage'
import { mapMutations } from 'vuex'

export default {
   name: 'Connexion',
   components:{Inscription},
   data: () => ({
     name: '',
     password: '',
     passwordBis: '',
     nameRules: [
       v => !!v || 'name is required',
       v => v.length <= 30 || 'name must be less than 30 characters'
     ],
       csrf_name : '',
       csrf_value : ''
   }),
   methods :{
       ...mapMutations(['setConnectedUser']),

     log(){
             url.post('/author',{
                 csrf_name : this.csrf_name,
                 csrf_value : this.csrf_value

             }, {
                 // Envoie du header base 68
                 headers: {
                     'Authorization': 'Basic ' + window.btoa(this.name + ':' + this.password)
                 }

             }).then(response => {

                 // L'api nous renvoie un token que l'on enregistre dans le ls

                 ls.set('tokenAuthor',response.data.token);

                 // Méthode de mutation du store
                 this.setConnectedUser(response.data.user);

                 this.$router.push('/parcours')
             }).catch(error => {
                 console.log(error)
             })
      }
   }
 }
</script>

<style scoped>

.container{
  margin-top : 5vh;
}
a{
  color:grey;
}
a:hover{
  color:white;
  transition: 0.2s;
}
</style>
