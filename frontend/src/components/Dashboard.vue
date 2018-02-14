<template>
  <div class="container">
    <form @submit="log" >
      <v-container  grid-list-md text-xs-center>

        <v-layout row wrap>
          <v-flex lg12>
            <h1>Tableau de bord</h1>
          </v-flex>

        </v-layout>
      </v-container>
    </form>
  </div>
</template>

<script>
export default {
  name: 'Dashboard',
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
