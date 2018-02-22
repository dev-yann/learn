<template>
  <div class="container">
    <form @submit="add" >
      <v-container  grid-list-md text-xs-center>

        <v-layout row wrap>
          <v-flex xs12 sm10 md6 lg9 offset-sm1 offset-md2 offset-lg1>
            <v-alert outline color="orange lighten-2" icon="priority_high" :value="alertMembre">Ce membre fait partie du groupe</v-alert>
          </v-flex>
        </v-layout>

        <v-layout row wrap>
          <v-flex xs12 sm10 md7 lg6 offset-sm1 offset-lg1>
            <v-layout row wrap>

              <v-flex xs12>
                <h1>Modification</h1>
              </v-flex>  <v-flex xs12>
                  <v-text-field type="text" label="Name of group" v-model="name" prepend-icon="people"></v-text-field>
                </v-flex>

                <v-flex xs12 sm8 md10>
                  <v-select :items="personnes" label="Select" v-model="addpersonne" single-line auto prepend-icon="personne" hide-details></v-select>
                </v-flex>

                <v-flex xs12 sm4 md2>
                  <v-btn @click="addPers"><v-icon >add</v-icon></v-btn>
                </v-flex>
              </v-layout>
            </v-flex>

            <v-flex xs12 sm12 md4>
              <v-flex>
                <h2>Liste des membres :</h2>
                <div v-for="(pers, index) in persGr">
                  <div class="unMembre">
                    {{pers}}<v-icon @click="supprPers(index)" class="iconDelete" color="red lighten-2" small>delete</v-icon><br />
                  </div>
                </div>
              </v-flex>
            </v-flex>

            <v-flex>
              <v-flex xs12>
                <v-btn type='submit'>Créer</v-btn>
              </v-flex>

              <v-flex xs12>
                <router-link to="/groupes">Retour</router-link>
              </v-flex>
            </v-flex>

          </v-layout>
        </v-container>
      </form>
    </div>

  </template>


<script>
export default{
  name:'GroupeEdit',
  data: () => ({
    name: '',
    addpersonne : '',
    persGr :['Monsieur'],
    personnes : ['Jean', 'Paul', 'Alexis', 'Coucou'],
    value : true,
    alertMembre : false
  }),
  methods :{
    add(){
      console.log("créer le groupe")
    },
    addPers(){
      let present = false
      let persCurrent

      //Si le champ est vide
      if(this.addpersonne){
          persCurrent = this.addpersonne
      }else{
        present = true
      }

      //Si la personne fait déjà partie du groupe
      this.persGr.map(function(value, key) {
        if(persCurrent===value){
            present = true
        }
      });

      // Si le champs n'est pas vide et qu'il n'est pas déjà present dans le tableau, on l'ajoute
      if(!present){
        this.persGr.push(this.addpersonne)
        this.alertMembre=false
      }
      else{
        this.alertMembre=true;
      }
    },
    supprPers(indexPers){
      this.persGr.splice(indexPers, 1)
    }
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
.iconDelete{
  position: relative;
  left: 20px;
}
h2{
  font-size: 14pt;
  font-weight: 400;
  margin-bottom: 13px;
}
.unMembre{
  margin-bottom: 5px;
}
</style>
