<template>
  <div class="container">
<!-- Nom du groupe
Listes de gens des gens existants
Supprimer qqun
Supprimer un groupe -->

    <v-layout row wrap>
      <v-flex xs10 offset-xs1>
        <h1>Mes groupes <router-link to="/groupeadd"><v-icon medium color="light-green lighten-1">add_circle</v-icon></router-link></h1>
      </v-flex>

      <v-flex xs12 md12 lg8 offset-md2>
        <v-expansion-panel>
          <v-expansion-panel-content v-for="(groupe, indexGr) in groupes" :key="indexGr">
            <div slot="header"><h2>{{groupe.name}}</h2></div>
            <v-card>
              <v-card-text>
                  <v-layout row>
                    <v-flex xs12 sm6 offset-sm3>
                      <v-card>
                        <v-list>
                          <v-list-tile v-for="(pers, indexPers) in personnes" :key="indexPers" avatar @click="" v-if="pers.groupe===(indexGr+1)">
                            <v-list-tile-content>
                              <v-list-tile-title v-text="pers.name"></v-list-tile-title>
                            </v-list-tile-content>
                           <v-list-tile-avatar>
                              <v-icon @click="supprPers(indexPers)" color="red lighten-2">delete</v-icon>
                            </v-list-tile-avatar>
                          </v-list-tile>
                        </v-list>
                      </v-card>
                    </v-flex>
                  </v-layout>
              </v-card-text>
            </v-card>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-flex>

    </v-layout>
  </div>
</template>

<script>
export default {
  name: 'Groupes',
  data () {
      return {

        groupes: [
          {
            name: 'LP1 CISIIE',
            nbPers : 19
          },
          {
            name: 'LP2 CISIIE',
            nbPers : 25
          },
          {
            name: 'CISIIE',
            nbPers : 40
          }
        ],
        personnes: [
          {
            name: 'Jean-Louis',
            groupe : 1
          },
          {
            name: 'Jean-Louis',
            groupe : 1
          },
          {
            name: 'Paul',
            groupe : 1
          },
          {
            name: 'Thomas',
            groupe : 2
          },
          {
            name: 'Arthur',
            groupe : 3
          }
        ]
      }
    },
   methods :{
     supprPers(indexPers){
       console.log("supprimer la pers " + indexPers)
     }
   }
 }
 </script>


<style scoped>

.container{
  width: 100%;
}
</style>
