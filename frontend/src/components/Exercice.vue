<template>
   <v-layout row wrap>
     <v-flex xs12>
       <p class="autocomplete"><i>Click to Ctrl for the autocomplete</i></p>
     </v-flex>

     <!-- CodeMirror -->
     <v-flex xs12 lg6>

        <!-- Conteneur CodeMirror -->
        <textarea class="codemirror-textarea" v-model="codePhp" name="codemirror-textarea" id="codemirror-textarea"/>

        <!-- Consignes -->
     <v-card-text style="height: 100px; position: relative">


      <div>
         <v-layout row justify-center>
           <v-btn color="light-green lighten-1" dark absolute top left fab  v-show="!hidden" @click.stop="dialog = true"><v-icon>format_align_center</v-icon></v-btn>
           <v-dialog v-model="dialog" fullscreen transition="dialog-bottom-transition" :overlay="false" scrollable>
             <v-card tile>
               <v-toolbar card dark color="light-green lighten-1">
                 <v-btn icon>
                   <v-icon>format_align_center</v-icon>
                 </v-btn>
                 <v-toolbar-title color>Consignes</v-toolbar-title>
                 <v-spacer></v-spacer>
                 <v-toolbar-items>
                   <v-btn dark flat @click.native="dialog = false"><v-icon>close</v-icon></v-btn>
                 </v-toolbar-items>
               </v-toolbar>
               <v-card-text>
                 <v-list three-line subheader>
                      <v-layout row wrap>
                        <v-flex xs6 offset-xs3>
                           <v-list-tile-content>
                             <v-list-tile-title>Nom de l'exercice</v-list-tile-title>
                             <p class="consigne">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Require password for purchase or use password to restrict purchase Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                             </p>
                           </v-list-tile-content>
                        </v-flex>
                     </v-layout>
                 </v-list>
               </v-card-text>

               <div style="flex: 1 1 auto;"/>
             </v-card>
           </v-dialog>
        </v-layout>

        </div>
        </v-card-text>
     </v-flex>


      <!-- Prévisualisation -->
      <v-flex xs12 lg6>

         <!-- Conteneur Prévisualisation -->
         <div class="resultCode" v-model="resultCode"/>

         <!-- Tester le code -->
         <v-card-text style="height: 100px; position: relative">
             <v-fab-transition>
               <v-btn color="light-blue lighten-1" class="btnRafraiche" dark absolute top left fab v-show="!hidden">
                 <v-icon>cached</v-icon>
               </v-btn>
             </v-fab-transition>
         </v-card-text>

      </v-flex>

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
  name : 'Exercice',
  data () {
      return {
          /* CodeMirror */
          code:'',
          editor: '',
          codePhp : "<?php ",
          resultCode :'',
          /* dialogue pour les consignes */
          dialog: false,
          notifications: false,
          sound: true,
          widgets: false
      }
  },
  methods:{
     // Map Getter ...

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
 }
}
</script>

<style scoped>

.autocomplete{
   font-size : 10pt;
   font-weight: 300;
   color: #BBB;
   text-align: center;
   font-size: 8pt;
   margin-bottom: 15px

}
.resultCode{
   background-color: #E0E0E0;
   height: 75vh;
   width : 100%;
}
.consigne{
   color: #CCC;
   text-align: justify;
}
.CodeMirror-gutters{
   position: relative;
   z-index: 10000;
}
</style>
