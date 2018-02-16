<template>
  <div class="containerGeneral">

        <v-layout row wrap>
          <v-flex xs10 lg7 offset-xs1 offset-lg3>
            <h1>Parcours</h1>
          </v-flex>

          <v-flex xs10 lg7 offset-xs1 offset-lg3>
            <v-container fluid grid-list-md>
              <v-data-iterator content-tag="v-layout" row wrap :items="items" :rows-per-page-items="rowsPerPageItems" :pagination.sync="pagination">
                <v-flex slot="item" slot-scope="props" xs11 offset-xs1>

                  <v-card>
                    <v-card-title>
                      <h4>{{ props.item.name }}</h4>
                      <v-list-tile-content class="align-end redacteur"><router-link to="#">{{ props.item.redacteur }}</router-link></v-list-tile-content>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-list dense>
                      <v-list-tile>
                        <v-list-tile-content><div><v-icon class="timerIcon">timelapse</v-icon>{{ props.item.temps }}</div></v-list-tile-content>
                        <v-list-tile-content v-if="props.item.difficulte === 'easy'" class="align-end"><div><v-icon color="light-green lighten-1">grade</v-icon></div></v-list-tile-content>
                        <v-list-tile-content v-if="props.item.difficulte === 'medium'" class="align-end"><div><v-icon color="orange lighten-2">grade</v-icon><v-icon color="orange lighten-2">grade</v-icon></div></v-list-tile-content>
                        <v-list-tile-content v-if="props.item.difficulte === 'hard'" class="align-end"><div><v-icon color="red lighten-2">grade</v-icon><v-icon color="red lighten-2">grade</v-icon><v-icon color="red lighten-2">grade</v-icon></div></v-list-tile-content>
                      </v-list-tile>
                    </v-list>
                  </v-card>
                </v-flex>
              </v-data-iterator>
            </v-container>
          </v-flex>

        </v-layout>

  </div>
</template>

<script>
export default {
   name: 'ExoListe',
   data: () => ({
      rowsPerPageItems: [4, 8, 12],
      pagination: {
        rowsPerPage: 4
      },
      items: [
        {
          name: 'Les variables en PHP',
          redacteur: 'Husson',
          difficulte : 'easy',
          temps: '24 min'
        },
        {
          name: 'Les objets en PHP',
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
          name: 'Eloquent',
          redacteur: 'Husson',
          difficulte : 'easy',
          temps: '24 min'
        },
        {
          name: 'Les requête avancées',
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
h1, h2, h4{
  margin:auto;
  text-align: center;
}
h1{
  margin-bottom: 3vh;
}
.timerIcon{
  margin-right : 18px;
}
</style>
