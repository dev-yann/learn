<template>
  <div class="container">
    <form @submit="log" >
      <v-container  grid-list-md text-xs-center>

        <v-layout row wrap>
          <v-flex xs12>
            <h1>inscription</h1>
          </v-flex>

          <v-flex xs12 sm8 md6 offset-sm2 offset-md3>
              <v-text-field  type="text" label="Name" v-model="name" :rules="nameRules" required></v-text-field>
          </v-flex>

          <v-flex xs12 sm8 md6 offset-sm2 offset-md3>
              <v-text-field type="password" label="Password" v-model="password" :rules="passwordRules" required></v-text-field>
          </v-flex>

          <v-flex xs12 sm8 md6 offset-sm2 offset-md3>
              <v-text-field type="password" label="Same password" v-model="passwordBis" required></v-text-field>
          </v-flex>

          <v-flex xs12 sm8 md6 offset-sm2 offset-md3>
            <v-btn type='submit'>S'inscrire</v-btn>
          </v-flex>

          <v-flex xs12 sm8 md6 offset-sm2 offset-md3>
            <router-link to="/connexion">J'ai déjà un compte</router-link>
          </v-flex>

        </v-layout>
      </v-container>
    </form>
  </div>
</template>

<script>
import Connexion from '@/components/Connexion.vue'
export default {
   name: 'Inscription',
   components:{Connexion},
   data: () => ({
     name: '',
     password: '',
     passwordBis: '',
     nameRules: [
       v => !!v || 'name is required',
       v => v.length <= 30 || 'name must be less than 30 characters'
     ],
     passwordRules: [
       v => !!v || 'password is required',
       v => v.length >= 15 || 'password must be less than 15 characters'
     ]
   }),
   methods :{
     log(){
         if(this.passwordBis===this.password){
            this.$router.push('/connexion')
         }
         else {
           console.log("erreur mdp")
         }
      }
   }
 }</script>


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
