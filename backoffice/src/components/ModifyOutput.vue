<template>
    <div>
        <v-flex xs12>

            <p>Ce type d'exercice permet d'ajouter un test unitaire à l'exercice </p>
            <p>Choisissez le fichier de test unitaire à télécharger</p>

            <v-text-field required v-model="title_true" name="title" label="titre"></v-text-field>

            <v-text-field required v-model="description" name="level" label="description"
                          :multi-line="line"></v-text-field>

            <v-text-field v-model="custom" name="custom" placeholder="ex : somme"
                          label="nom de la variable à tester "></v-text-field>
            <p> Instruction pour le test unitaire :
            <ul>
                <li>les lignes de codes avec * en commentaire sont obligatoire afin que notre programme s'exécute
                    correctement
                </li>
                <li> Utilisation de la classe Test case: use PHPUnit\Framework\TestCase</li>
                <li>Classe doit se nommer Verify</li>
                <li>Créer une fonction exec</li>
            </ul>
            </p>
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
            <v-btn @click="submitFile()">Modifier l'exercice</v-btn>
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

    import Url from './../services/configJwt'

    import { mapGetters } from 'vuex'
    export default {
        name: "ModifyOutput",
        props: ['title_true','description','id','typeExercice'],
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
                line: true,
                items: [
                    {text: 'fonction'},
                    {text: 'variable'}
                ],
                type: ''
            }

        },
        methods: {
            handleFileUpload() {

                this.file = this.$refs.file.files[0];

            },
            submitFile() {


                let formData = new FormData();
                formData.append('myfile', this.file);
                formData.append('title', this.title_true);
                formData.append('description', this.description);
                formData.append('custom', this.custom);
                formData.append('type', this.typeExercice);
                formData.append('type_output', this.type);
                formData.append('id',this.id);


                // axios
                // todo : recuperer l'id du bon parcours
                url.post('/connect/exercice/modify', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    this.$router.push('/parcours/' + this.getParcours.id + '/' + this.getParcours.title)

                }).catch(error => {
                    console.log(error)
                })
            }
        },
        computed : {
            ...mapGetters(['getParcours'])
        }
    }
</script>

<style scoped>

</style>