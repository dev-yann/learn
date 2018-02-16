<template>
  <div class="containerGeneral">
      <v-container  grid-list-md text-xs-center>

        <v-layout row wrap>
          <v-flex xs10 lg7 offset-xs1 offset-lg3>
            <h1>Forum</h1>
          </v-flex>

          <v-flex xs10 lg7 offset-xs1 offset-lg3>
            <v-container fluid grid-list-md>
              <v-data-iterator content-tag="v-layout" row wrap :items="items" :rows-per-page-items="rowsPerPageItems" :pagination.sync="pagination">
                <v-flex slot="item" slot-scope="props" xs11 offset-xs1 >

                  <v-card>
                    <v-card-title>
                      <h2>{{ props.item.name }}</h2>
                    </v-card-title>
                    <v-list dense>
                      <v-list-tile>
                        <v-list-tile-content class="redacteur"><div>{{ props.item.redacteur }}</div></v-list-tile-content>
                        <v-list-tile-content class="align-end"><div><span class="nbMessage">{{ props.item.message }}</span><v-icon>chat_bubble_outline</v-icon></div></v-list-tile-content>
                       </v-list-tile>
                    </v-list>
                  </v-card>
                </v-flex>
              </v-data-iterator>
            </v-container>
          </v-flex>

        </v-layout>
      </v-container>
  </div>
</template>
<script>
export default {
     name: 'Forum',
      data: () => ({
        rowsPerPageItems: [4, 8, 12],
        pagination: {
          rowsPerPage: 4
        },
        items: [
          {
            name: 'Les variables en PHP',
            redacteur: 'Husson',
            message: 6
          },
          {
            name: 'Les objets en PHP',
            redacteur: 'Bouzayani',
            message: 10
          },
          {
            name: 'Les tableaux',
            redacteur: 'Clavelin',
            message: 12
          },
          {
            name: 'Eloquent',
            redacteur: 'Husson',
            message: 4
          },
          {
            name: 'Les requête avancées',
            redacteur: 'Frederic',
            message: 15
          },
        ]
      })
 }
 </script>


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
  h1, h4{
    margin:auto;
    text-align: center;
  }
  h1{
    margin-bottom: 3vh;
  }
  .timerIcon{
    margin-right : 18px;
  }
  .redacteur{
    color:grey;
  }
  .nbMessage{
    position: relative;
    right:10px;
  }

</style>
