<template>
   <v-layout row wrap>
     <v-flex xs12>
       <p class="autocomplete"><i>Click to Ctrl for the autocomplete</i></p>
     </v-flex>

     <!-- CodeMirror -->
     <v-flex xs12 lg6>

        <!-- Conteneur CodeMirror -->
        <textarea class="codemirror-textarea" v-model="codePhp" name="codemirror-textarea" id="codemirror-textarea"/>

        <!-- Consigne -->
        <v-card-text style="height: 100px; position: relative">
            <v-fab-transition>
              <v-btn color="light-green lighten-1" class="btnConsigne" dark absolute top left fab v-show="!hidden">
                <v-icon>format_align_center</v-icon>
              </v-btn>
            </v-fab-transition>
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

      <!-- <v-layout row justify-center>
    <v-dialog v-model="dialog" fullscreen transition="dialog-bottom-transition" :overlay="false">
      <v-btn color="primary" dark slot="activator">Open Dialog</v-btn>
      <v-card>
        <v-toolbar dark color="primary">
          <v-btn icon @click.native="dialog = false" dark>
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Settings</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark flat @click.native="dialog = false">Save</v-btn>
          </v-toolbar-items>
        </v-toolbar>
        <v-list three-line subheader>
          <v-subheader>User Controls</v-subheader>
          <v-list-tile avatar>
            <v-list-tile-content>
              <v-list-tile-title>Content filtering</v-list-tile-title>
              <v-list-tile-sub-title>Set the content filtering level to restrict apps that can be downloaded</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile avatar>
            <v-list-tile-content>
              <v-list-tile-title>Password</v-list-tile-title>
              <v-list-tile-sub-title>Require password for purchase or use password to restrict purchase</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
        <v-divider></v-divider>
        <v-list three-line subheader>
          <v-subheader>General</v-subheader>
          <v-list-tile avatar>
            <v-list-tile-action>
              <v-checkbox v-model="notifications"></v-checkbox>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Notifications</v-list-tile-title>
              <v-list-tile-sub-title>Notify me about updates to apps or games that I downloaded</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile avatar>
            <v-list-tile-action>
              <v-checkbox v-model="sound"></v-checkbox>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Sound</v-list-tile-title>
              <v-list-tile-sub-title>Auto-update apps at any time. Data charges may apply</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile avatar>
            <v-list-tile-action>
              <v-checkbox v-model="widgets"></v-checkbox>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>Auto-add widgets</v-list-tile-title>
              <v-list-tile-sub-title>Automatically add home screen widgets</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>
      </v-card>
    </v-dialog>
  </v-layout>-->
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
          code:'',
          editor: '',
          codePhp : "<?php ",
          resultCode :''
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
</style>
