<template>
  <div class="containerGeneral">

        <v-layout row wrap>
          <v-flex lg12>
            <h1>Exercices et parcours</h1>
          </v-flex>

          <v-flex lg3 offset-lg1>
            <v-container fluid grid-list-md>
              <v-flex xs11>
                <v-card>
                    <v-card-title><h2>3600 XP</h2></v-card-title>
                    <v-divider></v-divider>
                    <v-list dense>
                      <v-list-tile>
                        <v-list-tile-content><h3>Badges</h3></v-list-tile-content>
                      </v-list-tile>
                      <div v-if="ttBadges===false">
                        <v-list-tile >
                          <v-list-tile-content text-xs-center class="align-end"><v-icon x-large>crop_square</v-icon></v-list-tile-content>
                          <v-list-tile-content text-xs-center class="align-end"><v-icon x-large>crop_square</v-icon></v-list-tile-content>
                          <v-list-tile-content text-xs-center class="align-end"><v-icon x-large>crop_square</v-icon></v-list-tile-content>
                        </v-list-tile>
                      </div>

                    <div v-else>
                      <div v-for="(badge, index) in badges">
                            <v-list-tile>
                              <!-- Affiche le badge de l'index & le badge de l'index ++ et le badge de l'index +++ -->
                              <v-list-tile-content text-xs-center class="align-end"><v-icon x-large>crop_square</v-icon></v-list-tile-content>
                              <v-list-tile-content text-xs-center class="align-end"><v-icon x-large>crop_square</v-icon></v-list-tile-content>
                              <v-list-tile-content text-xs-center class="align-end"><v-icon x-large>crop_square</v-icon></v-list-tile-content>
                            </v-list-tile>
                        </div>
                    </div>

                      <v-list-tile>
                        <v-list-tile-content class="align-end"><a @click="totalBadge()">tous...</a></v-list-tile-content>
                      </v-list-tile>
                    </v-list>
                  </v-card>
                  </v-flex>
              </v-container>
              <v-container fluid grid-list-md>
                <v-flex xs11>
                    <div>
                      <div>
                        <h4>Filtrer par :</h4>
                      </div>
                      <v-flex xs6 offset-xs3>
                        <v-select label="Select" disabled></v-select>
                      </v-flex>
                    </div>
                </v-flex>
              </v-container>
          </v-flex>


          <v-flex lg7>
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
      ttBadges : false,
      rowsPerPageItems: [4, 8, 12],
      pagination: {
        rowsPerPage: 4
      },
      badges:[
        {'php5' : 'cake'},
        {'tableaux' : 'cake'},
        {'trou' : 'cake'},
        {'cool' : 'cake'}
      ],

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
    }),
    methods:{
      totalBadge(){
        console.log('coucou')
         return this.ttBadges = true;
      }
    }
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
