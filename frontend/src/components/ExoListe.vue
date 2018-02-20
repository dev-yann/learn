<template>
  <div class="containerGeneral">

        <v-layout row wrap>
          <v-flex xs10 lg7 offset-xs1 offset-lg3>
            <h1>Parcours</h1>
          </v-flex>

          <v-flex xs10 lg9 offset-xs1 offset-lg2>
            <v-flex xs10 md10 lg11 offset-xs1>
              <v-container fluid grid-list-md>
                <v-data-iterator content-tag="v-layout" row wrap :items="items" :rows-per-page-items="rowsPerPageItems" :pagination.sync="pagination">
                  <v-flex slot="item" slot-scope="props" xs12 sm6 md5 lg3 offset-md1>

                    <router-link to="/exo">
                      <v-card class="unCours">
                        <v-card-title>
                          <v-list-tile-content><h2>{{ props.item.name }}</h2></v-list-tile-content>
                          <v-list-tile-content><router-link class="redacteur" to="#">{{ props.item.redacteur }}</router-link></v-list-tile-content>
                        </v-card-title>
                        <div class="timeNdiff">
                          <v-divider></v-divider>
                          <v-list dense>
                            <v-list-tile>
                              <v-list-tile-content><div><v-icon color="grey" class="timerIcon">timelapse</v-icon>{{ props.item.temps }}</div></v-list-tile-content>
                              <v-list-tile-content v-if="props.item.difficulte === 'easy'" class="align-end"><div><v-icon color="light-green lighten-1">grade</v-icon></div></v-list-tile-content>
                              <v-list-tile-content v-if="props.item.difficulte === 'medium'" class="align-end"><div><v-icon color="orange lighten-2">grade</v-icon><v-icon color="orange lighten-2">grade</v-icon></div></v-list-tile-content>
                              <v-list-tile-content v-if="props.item.difficulte === 'hard'" class="align-end"><div><v-icon color="red lighten-2">grade</v-icon><v-icon color="red lighten-2">grade</v-icon><v-icon color="red lighten-2">grade</v-icon></div></v-list-tile-content>
                            </v-list-tile>
                          </v-list>
                        </div>
                      </v-card>
                    </router-link>

                  </v-flex>
                </v-data-iterator>
              </v-container>
            </v-flex>
          </v-flex>


        </v-layout>

  </div>
</template>

<script>
import Exo from '@/components/Exo.vue'
export default {
   name: 'ExoListe',
     data: () => ({
        rowsPerPageItems: [3, 6, 9],
        pagination: {
          rowsPerPage: 6
        },
        items: [
          {
            name: 'Comment bien construire ses models en fonction des bases de données avec une architectures MVC',
            redacteur: 'Husson',
            difficulte : 'easy',
            temps: '24 min'
          },
          {
            name: 'Bien débuter avec les objets et les namespace en PHP',
            redacteur: 'Bouzayani',
            difficulte : 'medium',
            temps: '24 min'
          },
          {
            name: 'Les tableaux',
            redacteur: 'Clavelin',
            difficulte : 'medium',
            temps: '24 min'
          },
          {
            name: 'Connaître toutes les subtilités de l\'ORM Eloquent pour l\'utiliser de la manière manière possible',
            redacteur: 'Husson',
            difficulte : 'easy',
            temps: '24 min'
          },
          {
            name: 'Comment bien manipuler les requête avancées',
            redacteur: 'Frederic',
            difficulte : 'hard',
            temps: '24 min'
          },
          {
            name: 'Comment bien construire ses models en fonction des bases de données avec une architectures MVC',
            redacteur: 'Husson',
            difficulte : 'easy',
            temps: '24 min'
          },
          {
            name: 'Comment bien construire ses models en fonction des bases de données avec une architectures MVC',
            redacteur: 'Husson',
            difficulte : 'easy',
            temps: '24 min'
          },
          {
            name: 'Les tableaux',
            redacteur: 'Clavelin',
            difficulte : 'medium',
            temps: '24 min'
          },
          {
            name: 'Connaître toutes les subtilités de l\'ORM Eloquent pour l\'utiliser de la manière manière possible',
            redacteur: 'Husson',
            difficulte : 'easy',
            temps: '24 min'
          },
          {
            name: 'Comment bien manipuler les requête avancées',
            redacteur: 'Frederic',
            difficulte : 'hard',
            temps: '24 min'
          },
        ]
      })
 }</script>


<style scoped>

.containerGeneral{
  margin-top : 8vh;
}
a{
  color:grey;
}
a:hover{
  color:white;
  transition: 0.2s;
}
h1, h2, h4, .redacteur{
  margin:auto;
  text-align: center;
}
h1{
  margin-bottom: 3vh;
}
h2{
  font-size: 12pt;
}
.timerIcon{
  margin-right : 13px;
}
.unCours{
  min-height: 222px;
  margin-bottom: 40px;
}
.unCours:hover .timeNdiff{
  background-color: white;
}

.timeNdiff{
  position: absolute;
  bottom: 0;
  width:100%;
}
</style>
