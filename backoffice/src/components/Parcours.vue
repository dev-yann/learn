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
                    <router-link to="/exercices"><v-btn flat color="light-green lighten-1">Accéder au parcours</v-btn></router-link>
                </v-card-actions>
            </v-card>
        </v-flex>
</template>

<script>
    import Url from './../services/config'
    export default {
        name: "parcours",
        data: () => ({
          items: []
        }),

        mounted () {

            Url.get('/parcours').then(response => {
                this.items = response.data.parcours
            }).catch(error => {
                console.log(error)
            })
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
