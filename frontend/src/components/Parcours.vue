<template>
    <v-layout row wrap>
      <v-flex xs12 lg7 offset-xs1 offset-lg3>
        <h1>{{parcours.title}}</h1>
      </v-flex>
      <v-flex xs12 lg7>
         <!-- CodeMirror --> 
         <form id="preview-form" method="post">
            <textarea class="codemirror-textarea" v-model="codePhp" name="codemirror-textarea" id="codemirror-textarea"/>
            <input type="submit" value="Tester le code" />
         </form>

          <p class="autocomplete"><i>Click to Ctrl for the autocomplete</i></p>
       </v-flex>

      <Chat v-if="isload"></Chat>
    </v-layout>

</template>

<script>
  import Url from './../services/config'
  import Chat from './Chat.vue'
  import { mapMutations } from 'vuex'

  import $ from "jquery"
  import CodeMirror from "codemirror"
  import VueCodeMirror from "vue-codemirror"

   /* importation des plugins pour la coloration syntaxique du php */
   import clike from "./../../node_modules/codemirror/mode/clike/clike.js"
   import xml from "./../../node_modules/codemirror/mode/xml/xml.js"
   import javascript from "./../../node_modules/codemirror/mode/javascript/javascript.js"
   import css from "./../../node_modules/codemirror/mode/css/css.js"
   import htmlmixed from "./../../node_modules/codemirror/mode/htmlmixed/htmlmixed.js"
   import php from "./../../node_modules/codemirror/mode/php/php.js"

  /* Importation des plugins pour l'autocompletion */
  import showHint from './../../node_modules/codemirror/addon/hint/show-hint.js'
  import cssHint from './../../node_modules/codemirror/addon/hint/css-hint.js'

  /* importation du thème */
  import pastelOnDark from "./../../node_modules/codemirror/theme/pastel-on-dark.css"

  export default{
    name : 'Parcours',
    components: {Chat},
    data () {
        return {
            ex : [],
            parcours : [],
            loadingTest: false,
            code:'',
            editor: '',
            codePhp : "<?php "
        }
    },
    methods:{

        // Permet la modification du parcours dans le state de vuex
        ...mapMutations(['setParcours']),

    },
    mounted(){
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
      })
   },
      beforeMount () {

        // récupérer le parcours en question avec les exercices
          Url.get('/parcours/'+ this.$route.params.id ).then(response => {

              this.ex = response.data.exercices
              this.parcours = response.data.parcours

              this.setParcours(this.parcours)

          }).then(() => {
              // à partir de ce moment je peux lancer ma fonction de connection de chat
              // qui a besoin de l'id du parcours
              // fonction fleché pour garder le this

              this.loadingTest = true;

          }).catch(error => {
              console.log(error)
          })

      },
      computed: {
        // Permet la verification dynamiques de loadtesting
        isload: function () {
            return this.loadingTest
        }
      }
  }
</script>

<style scoped>

h1{
  margin:auto;
  text-align: center;
}
.autocomplete{
   font-size : 10pt;
   font-weight: 300;
   color:grey;
}
</style>
