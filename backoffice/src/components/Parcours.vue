<template>
        <v-flex xs12 sm6 offset-sm3 class="conteneur">
        <router-link to="add" class="creerParcours"><v-btn color="light-green lighten-1" dark @click.stop="dialog3 = true">Ajouter un parcours</v-btn></router-link>
            <v-card v-for="parcours in items" :key="parcours.id">
                <v-card-title primary-title>
                    <div>
                        <h3 class="headline mb-0 parcoursTitle">{{parcours.title}}</h3>
                        <div class="descriptionparcours">{{parcours.description}}</div>
                        <div class="dateMAJ">Dernière modification : {{parcours.updated_at}}</div>
                    </div>
                </v-card-title>
                <v-card-actions>
                   <router-link :to="{ name : 'exercices-list', params : { id : parcours.id, name : parcours.title}}"><v-btn flat color="light-green lighten-1">Accéder au parcours</v-btn></router-link>
                   <router-link :to="{ name : 'edit-parcours', params : { id : parcours.id, name : parcours.title}}"><v-btn flat @click="del()">   <v-icon  flat color="orange">edit</v-icon></v-btn></router-link>
                       <v-btn flat @click="del(parcours.id)">   <v-icon  flat color="red">delete</v-icon></v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
</template>

<script>
    import Url from './../services/configJwt'
    export default {
        name: "parcours",
        data: () => ({
          items: []
        }),

        mounted () {
          this.getParcours();
        
        },
        methods : {
          getParcours () {
                Url.get('/connect/author_parcours').then(response => {
                this.items = response.data.parcours
            }).catch(error => {
                console.log(error)
            })
          },
          del(id) {
               Url.delete('/connect/parcours/'+id+'/delete').then(response => {
                  this.$router.push('/parcours')
                 this.getParcours();
              }).catch(error => {
                console.log(error)
            })
          }
        }
    }
</script>

<style scoped>
.conteneur{
  text-align:center;
}
.descriptionparcours, .parcoursTitle{
  text-align:left;
}
.descriptionparcours{
  margin-top : 20px;
}
.dateMAJ{
  color : #AAA;
  margin-top : 8px;
}
.card{
margin-top : 5px;
}
</style>
