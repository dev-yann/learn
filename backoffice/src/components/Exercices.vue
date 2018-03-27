<template>
    <v-container>
      <v-layout row justify-center>
          <router-link to="/exercices/add"><v-btn color="light-green lighten-1" dark @click.stop="dialog3 = true">Ajouter un exercice</v-btn></router-link>
      </v-layout>
        <v-layout>
            <v-flex xs12 sm6 offset-sm3>
                <v-card>
                    <v-card-title primary-title>
                        <div>
                            <h3 class="headline mb-0">exercice du parcours 1 </h3>
                            <div>Bordel de description</div>
                        </div>
                    </v-card-title>
                    <v-card-actions>
                        <router-link to = "/exercices"><v-btn flat color="light-green lighten-1">Modifier</v-btn></router-link>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
  import Url from './../services/configJwt'

    export default {
        name: "exercices",
        data () {
            return {
              exercice: {}
            }
        },
        mounted(){
        /*  Url.get('/connect/parcours/'+ this.$route.params.id +'/exercice/'+ this.$route.params.ide).then(response => {

              console.log(response);
              this.codePhp = "<?php " + response.data.exercice.myFill.codeFalse;
              this.exercice = response.data.exercice;
              this.loadingTest = true;


          }).then(() => {

              this.code = $(".codemirror-textarea")[0];
              this.editor = CodeMirror.fromTextArea(this.code, {
                  // Numerotation des lignes
                  lineNumbers : true,
                  // coloration syntaxique PHP
                  mode : "application/x-httpd-php",
                  // autocompletion : ctrl
                  extraKeys : {"Ctrl" : "autocomplete"},
                  // theme noir
                  theme : "pastel-on-dark",
              });

              console.log(this.editor.getValue());

          }).catch(error => {

              console.log(error)
          })*/
        }
    }
</script>

<style scoped>

</style>
