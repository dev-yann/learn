<template>
    <v-flex xs6>
        <v-text-field v-model="title"
                      name="title"
                      label="titre"
        ></v-text-field>

        <v-text-field v-model="description"
                      name="level"
                      label="description"
                      :multi-line="line"
        ></v-text-field>

        <label>File
            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
        </label>

        <v-btn color="success" @click="submitFile()">Ajouter l'exercice au parcours</v-btn>
    </v-flex>
</template>

<script>
    import url from './../services/config'
    export default {
        name: "out-put-form",
        data () {
            return {

                title:'',
                line: true,
                description: ''
            }
        },

    methods: {
        handleFileUpload(){

            this.file = this.$refs.file.files[0];

        },
        submitFile(){
            /**
             * Une indication pour connaître le nombre de tests qu'il va falloir écrire concerne les sorties possibles de la méthode. Dans le code présenté ci-dessus, vous voyez deux return :  il va falloir deux tests pour faire en sorte que tous les cas soient couverts.
             * @type {FormData}
             */


            let formData = new FormData();
            formData.append('file',this.file);
            formData.append('title',this.title);
            formData.append('description',this.description);


            // axios
            // todo : recuperer l'id du bon parcours
            url.post('/parcours/1/add',formData,{
                headers: {
                    'Content-Type' : 'multipart/form-data'
                }
            }).then(response => {
                console.log(response)
                this.file = ''
            }).catch(error => {
                console.log(error)
            })

        }

        }
    }
</script>

<style scoped>

</style>