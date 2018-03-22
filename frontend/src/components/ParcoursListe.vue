<template>
  <div class="containerGeneral">

        <v-layout row wrap>
          <v-flex xs10 offset-xs1>
            <h1 class="text-sm-left">Parcours</h1>
          </v-flex>

            <v-flex xs12 md11>
              <v-container fluid grid-list-md>
                <v-data-iterator content-tag="v-layout" row wrap :items="items" :rows-per-page-items="rowsPerPageItems" :pagination.sync="pagination">
                  <v-flex slot="item" slot-scope="props" xs12 sm6 md5 lg3 offset-md1>

                    <router-link :to="{ name : 'parcours', params : { id : props.item.id, name : props.item.title}}">
                      <v-card class="unCours">
                        <v-card-title>
                          <v-list-tile-content><h2>{{ props.item.title }}</h2></v-list-tile-content>
                        </v-card-title>
                        <div class="timeNdiff">
                          <v-divider></v-divider>
                          <v-list dense>
                            <v-list-tile>
                              <v-list-tile-content><div><v-icon color="grey" class="timerIcon">timelapse</v-icon>{{ props.item.temps }}</div></v-list-tile-content>
                              <v-list-tile-content v-if="props.item.level === 1" class="align-end"><div><v-icon color="light-green lighten-1">grade</v-icon></div></v-list-tile-content>
                              <v-list-tile-content v-if="props.item.level === 2" class="align-end"><div><v-icon color="orange lighten-2">grade</v-icon><v-icon color="orange lighten-2">grade</v-icon></div></v-list-tile-content>
                              <v-list-tile-content v-if="props.item.level === 3" class="align-end"><div><v-icon color="red lighten-2">grade</v-icon><v-icon color="red lighten-2">grade</v-icon><v-icon color="red lighten-2">grade</v-icon></div></v-list-tile-content>
                            </v-list-tile>
                          </v-list>
                        </div>
                      </v-card>
                    </router-link>

                  </v-flex>
                </v-data-iterator>
              </v-container>
            </v-flex>
        </v-layout>

  </div>
</template>

<script>

    import Url from './../services/config'
export default {
   name: 'ParcoursListe',
     data: () => ({
        rowsPerPageItems: [3, 6, 9],
        pagination: {
          rowsPerPage: 6
        },
        items: []
      }),

    mounted () {

       // Récupération des données

        Url.get('/parcours').then(response => {

            this.items = response.data.parcours

        }).catch(error => {

            console.log(error)
        })
    }
 }
</script>


<style scoped>
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
  font-weight: 400;
  margin-bottom: 8  px;
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
