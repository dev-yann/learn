<template>
  <div class="container">
    <form @submit="log" >
      <v-container  grid-list-md text-xs-center>

        <v-layout row wrap>
          <v-flex lg12>
            <h1>Connexion</h1>
          </v-flex>

          <v-flex lg6 offset-lg3>
              <v-text-field  type="text" label="Name" v-model="name" :rules="nameRules" required></v-text-field>
          </v-flex>

          <v-flex lg6 offset-lg3>
              <v-text-field type="password" label="Password" v-model="password" :rules="passwordRules" required></v-text-field>
          </v-flex>

          <v-flex lg6 offset-lg3>
            <v-btn type='submit'>Se connecter</v-btn>
          </v-flex>

          <v-flex lg6 offset-lg3>
            <router-link to="/inscription">Je n'ai pas encore de compte</router-link>
          </v-flex>

        </v-layout>
      </v-container>
    </form>
  </div>
</template>

<script>
import Inscription from '@/components/Inscription.vue'
import Dashboard from '@/components/Dashboard.vue'
export default {
   name: 'Connexion',
   components:{Inscription, Dashboard},
   data: () => ({
     name: '',
     password: '',
     passwordBis: '',
     nameRules: [
       v => !!v || 'name is required',
       v => v.length <= 30 || 'name must be less than 30 characters'
     ]
   }),
   methods :{
     log(){
         if(this.passwordBis===this.password){
            this.$router.push('/dashboard')
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
