<template>
   <v-layout row wrap>
      <v-flex xs12>
        <h1>Tableau de bord</h1>

        <v-data-table :headers="headers" :items="items" hide-actions class="elevation-1">
           <p>Mes exercices en cours</p>
          <template slot="items" slot-scope="props">
            <td></td>
          </template>
       </v-data-table>
      </v-flex>
   </v-layout>
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
h1{
   text-align: center;
}
</style>
