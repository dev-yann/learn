<template>
    <v-layout row wrap v-if="isload">
        <v-flex xs12>
            <p class="autocomplete"><i>Click to Ctrl to autocomplete</i></p>
        </v-flex>

        <!-- CodeMirror -->
        <v-flex xs12 lg6>

            <!-- Conteneur CodeMirror -->
            <textarea class="codemirror-textarea" v-model="codePhp" name="codemirror-textarea" id="codemirror-textarea"/>

            <!-- Pop up consignes -->
            <v-card-text class="btnConsigne">
                <div>
                    <v-layout row justify-center>
                        <v-btn color="light-green lighten-1" dark absolute top left fab :v-show="!hidden"
                        @click.stop="dialog = true">
                        <v-icon>format_align_center</v-icon>
                    </v-btn>
                    <v-dialog v-model="dialog" fullscreen transition="dialog-bottom-transition" :overlay="false"
                    scrollable>
                    <v-card tile>
                        <v-toolbar card dark color="light-green lighten-1">
                            <v-btn icon>
                                <v-icon>format_align_center</v-icon>
                            </v-btn>
                            <v-toolbar-title color>Consignes</v-toolbar-title>
                            <v-spacer/>
                            <v-toolbar-items>
                                <v-btn dark flat @click.native="dialog = false">
                                    <v-icon>close</v-icon>
                                </v-btn>
                            </v-toolbar-items>
                        </v-toolbar>
                        <v-card-text>
                            <v-list three-line subheader>
                                <v-layout row wrap>
                                    <v-flex xs6 offset-xs3>
                                        <v-list-tile-content>
                                            <v-list-tile-title>{{exercice.title}}</v-list-tile-title>
                                            <p class="consigne">{{exercice.description}}</p>
                                            <p class="consigne">{{exercice.variables_test}}</p>
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
    <v-dialog v-model="state" persistent max-width="290">
        <v-card>
            <v-card-text>L'exercice est <span v-model="this.state_message">{{state_message}}</span></v-card-text>
            <v-card-actions> 
                <v-spacer></v-spacer>
                <v-btn color="green darken-1" flat @click.native="state = false">Ok</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>


    <!--<v-btn @click="test">test</v-btn>-->
</v-flex>


<!-- Prévisualisation  -->
<v-flex xs12 lg6>

    <!-- Conteneur Prévisualisation -->
    <div class="resultCode">
        <p v-model="resultCode" class="prevCode">{{resultCode}}</p>
    </div>

    <!-- Tester le code -->
    <v-card-text v-show="exercice.fillinType" class="btnTester">
        <v-fab-transition>
            <v-btn color="light-blue lighten-1" class="btnRafraiche" dark absolute top left fab v-show="!hidden"
            @click="test">
            <v-icon>cached</v-icon>
        </v-btn>
    </v-fab-transition>
</v-card-text>
<v-card-text v-show="!exercice.fillinType" class="btnTester">
  <v-fab-transition>
    <v-btn color="green lighten-1" class="btnRafraiche" dark absolute top right  fab
    @click="verifyCode">
    <v-icon>check</v-icon>
</v-btn>
</v-fab-transition>
<v-fab-transition>
    <v-btn color="red lighten-1" class="btnRafraiche" dark absolute top left fab
    @click="runPhp">
    <v-icon>cached</v-icon>
</v-btn>
</v-fab-transition>
</v-card-text>
</v-flex>
</v-layout>
</template>

<script>

import Url from './../services/configJwt'

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

    // Importation des plugins pour l'autocompletion
    import showHint from './../../node_modules/codemirror/addon/hint/show-hint.js'
    import cssHint from './../../node_modules/codemirror/addon/hint/css-hint.js'

    // importation du thème /
    import pastelOnDark from "./../../node_modules/codemirror/theme/pastel-on-dark.css"

    import {mapGetters} from "vuex";

    export default {
        name: 'Exercice',
        data() {
            return {
                // CodeMirror
                code: '',
                editor: '',
                codePhp: "<?php ",
                dialog: false,
                notifications: false,
                sound: true,
                widgets: false,
                loadingTest: false,
                exercice: {},
                resultCode: '',
                hidden:false,
                state :false,
                state_message : ""
            }
        },
        methods: {

            test() {
                Url.post('/connect/parcours/1/exercice/' + this.$route.params.ide, {
                    fillin: "yes",
                    //
                    // UN PEU SPECIAL, ON DOIT PASSER PAR LA FONCTION DE CODE MIRROR
                    // POUR RECUPERER LE BON TXT !!!!!!!!
                    userCode: this.editor.getValue(),
                    user: this.getUser,
                    exId: this.$route.params.ide,
                    parcId: this.getParcours.id


                }).then(response => {
                    this.state=true
                    this.state_message = response.data.message
                    console.log(response)

                }).catch(error => {

                    console.log(error)
                })
            },
            runPhp() {
                Url.post('/sandbox', {
                  user: this.getUser,
                  code: this.editor.getValue()


              }).then(response => {
                 this.resultCode = response.data
                 console.log(response)

             }).catch(error => {
                console.log(error.response.data.erreur)
                this.resultCode= error.response.data.erreur
            })
         },
         verifyCode() {

            Url.post('/parcours/' + this.$route.params.id + '/exercice/' + this.$route.params.ide + '/verify',{
                user: this.getUser,
                code: this.editor.getValue()

            }).then(response => {
                console.log(response)
                this.state = true
                if (response.data.valide ===true) {
                    this.state_message = "juste"
                }
                else    {
                    this.state_message ="faux"
                }

            }).catch(error => {
                console.log(error)
                this.state = true
                this.state_message ="faux"
            })

        }


    },
    mounted() {


        Url.get('/connect/parcours/' + this.$route.params.id + '/exercice/' + this.$route.params.ide).then(response => {

            console.log(response);
            if (typeof  response.data.exercice.myFill !== 'undefined') {
             this.codePhp = "<?php " + response.data.exercice.myFill.codeFalse;
             this.exercice = response.data.exercice;
             this.loadingTest = true;
         }
         else    {
             this.codePhp = "<?php ";
             this.exercice = response.data.exercice;
             this.loadingTest = true;
         }



     }).then(() => {

        this.code = $(".codemirror-textarea")[0];
        this.editor = CodeMirror.fromTextArea(this.code, {
                    // Numerotation des lignes
                    lineNumbers: true,
                    // coloration syntaxique PHP
                    mode: "application/x-httpd-php",
                    // autocompletion : ctrl
                    extraKeys: {"Ctrl": "autocomplete"},
                    // theme noir
                    theme: "pastel-on-dark"
                });


    }).catch(error => {

        console.log(error)
    })
},
computed: {
            // Permet la verification dynamiques de loadtesting
            isload: function () {
                return this.loadingTest
            },
            ...mapGetters(['getUser', 'getParcours'])
        }
    }
    </script>

    <style scoped>
    .autocomplete {
        font-weight: 300;
        color: #BBB;
        text-align: center;
        font-size: 10pt;
        margin-bottom: 15px
    }

    .resultCode {
        background-color: #E0E0E0;
        height: 75vh;
        width: 100%;
        color: black;
    }

    .consigne {
        color: #CCC;
        text-align: justify;
    }

    .CodeMirror-gutters {
        position: relative;
        z-index: 10000;
    }

    .btnTester, .btnConsigne {
        height: 100px;
        position: relative
    }
    .prevCode{
      margin : 0;
      color:black;
  }
  </style>
