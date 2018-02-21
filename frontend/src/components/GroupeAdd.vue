persGr<template>
  <div class="container">
    <form @submit="add" >
      <v-container  grid-list-md text-xs-center>

        <v-layout row wrap>
          <v-flex xs12>
            <h1>Créer un groupe</h1>
          </v-flex>

          <v-flex xs8 sm8 md6 offset-sm2 offset-md2>
            <v-layout row wrap>
              <v-flex xs12>
                <v-text-field  type="text" label="Name of group" v-model="name" prepend-icon="people"></v-text-field>
              </v-flex>

              <v-flex xs12 sm8 md10>
                <v-select :items="personnes" label="Select" v-model="addpersonne" single-line auto prepend-icon="personne" hide-details></v-select>
              </v-flex>

              <v-flex xs12 sm4 md2>
                <v-btn @click="addPers"><v-icon >add</v-icon></v-btn>
              </v-flex>
            </v-layout>
          </v-flex>

          <v-flex xs4 sm2 md4>
            <v-flex>
              <div v-for="(pers, index) in persGr">
                {{pers}}<v-icon @click="supprPers()" class="iconDelete" color="red lighten-2" small>delete</v-icon><br />
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
    name : 'GroupeAdd',
    data: () => ({
      name: '',
      addpersonne : '',
      persGr :['Monsieur'],
      personnes : ['Jean', 'Paul', 'Alexis', 'Coucou']
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

        // Sinon
        if(!present){
          this.persGr.push(this.addpersonne)
        }

      },
      supprPers(){
        console.log("supprimer cette personne")
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
</style>
