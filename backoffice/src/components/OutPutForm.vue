<template>
    <div>
        <v-flex xs12>

            <p>Ce type d'exercice permet d'ajouter un test unitaire à l'exercice </p>
            <p>Choisissez le fichier de test unitaire à télécharger</p>

            <v-text-field required v-model="title" name="title" label="titre"></v-text-field>

            <v-text-field required v-model="description" name="level" label="description"
                          :multi-line="line"></v-text-field>

            <v-text-field v-model="custom" name="custom" placeholder="ex : somme"
                          label="nom de la variable à tester "></v-text-field>
            <p> Instruction pour le test unitaire :</p>
            <ul>
                <li>les lignes de codes avec * en commentaire sont obligatoire afin que notre programme s'exécute
                    correctement
                </li>
                <li> Utilisation de la classe Test case: use PHPUnit\Framework\TestCase</li>
                <li>Classe doit se nommer Verify</li>
                <li>Créer une fonction exec</li>
            </ul>

            <p>Exemple de test unitaire :</p>

            <v-select :items="items" v-model="type" label="Select" class="input-group--focused"
                      item-value="text"></v-select>


        </v-flex>
        <code>
            <?php
      use PHPUnit\Framework\TestCase; // * , utilise PHP UNIT

      class Verify extends TestCase { // *, Votre classe doit se nomme Verify et étendre de Test Case

      public function exec($var=null) {   // *, Fonction exec obligatoire
      return $this->egalite($var,5); // *, appel de votre fonction
            }
            public function egalite ($rep,$req) { // Votre Fonction, en cas de réussite return true, sinon false
            try {
            $this->assertSame($rep, $req);
            return true;
            } catch (Exception $e) {
            return false;
            }
            }
            }
        </code>
        <label>Upload a file :
            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
        </label>


        <v-flex xs12>
            <v-btn @click="submitFile()">Ajouter l'exercice au parcours</v-btn>
            <!-- <v-btn color="success" @click="testExercice()">Tester votre test unitaire</v-btn> -->
        </v-flex>
    </div>

</template>

<script>


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
    import url from './../services/configJwt'
    import {mapMutations} from 'vuex'

    export default {
        name: "out-put-form",
        data() {
            return {
                parcours: '',
                // CodeMirror
                code: '',
                editor: '',
                codePhp: "<?php ",
                resultCode: "",
                // dialogue pour les consignes
                dialog: false,
                notifications: false,
                sound: true,
                widgets: false,
                loadingTest: false,
                custom: '',
                title: '',
                line: true,
                description: '',
                items: [
                    {text: 'fonction'},
                    {text: 'variable'}
                ],
                type: ''
            }

        },
        mounted() {
            this.parcours = this.$store.state.parcours
        },


        methods: {
            handleFileUpload() {

                this.file = this.$refs.file.files[0];

            },
            submitFile() {


                let formData = new FormData();
                formData.append('myfile', this.file);
                formData.append('title', this.title);
                formData.append('description', this.description);
                formData.append('custom', this.custom);
                formData.append('type', this.type);


                // axios
                // todo : recuperer l'id du bon parcours
                url.post('/connect/parcours/' + this.parcours.id + '/add', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    this.$router.push('/parcours/' + this.parcours.id + '/' + this.parcours.title)

                }).catch(error => {
                    console.log(error)
                })
            },
            // testExercice() {
            //    url.post('/sandbox/verify',{
            //       codePhp : this.codePhp,
            //         headers: {
            //             'Content-Type' : 'application/json'
            //         }
            //     }).then(response => {
            //         console.log(response)

            //     }).catch(error => {
            //         console.log(error)
            //     })
            // }
        }
    }
</script>

<style scoped>
    label {
        font-size: 1.2em;
    }

    code {
        width: 100%;
    }
</style>
