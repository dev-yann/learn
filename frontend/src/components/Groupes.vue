<template>
  <div class="container">
    <form @submit="log" >
      <v-container  grid-list-md text-xs-center>

        <v-layout row wrap>
          <v-flex lg12>
            <h1>Groupes</h1>
          </v-flex>
          
          <!--
            Nom du groupe
            Personne du groupe (liste des gens)
            Supprimer un groupe
            Supprimer un membre
          -->

        </v-layout>
      </v-container>
    </form>
  </div>
</template>

<script>
export default {
  name: 'Groupes',
   data: () => ({

   }),
   methods :{

   }
 }
 </script>


<style scoped>

.container{
  margin-top : 5vh;
}
</style>
