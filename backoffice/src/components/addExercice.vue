<template>
    <v-container fluid>
        <h1>Ajouter un exercice</h1>

        <v-flex xs8>

            <v-flex xs6>
                <v-subheader>Choisissez un type d'exercice</v-subheader>
            </v-flex>

            <v-flex xs6>
                <v-select
                        :items="items"
                        v-model="e2"
                        label="Select"
                        class="input-group--focused"
                        item-value="text"
                ></v-select>
            </v-flex>


            <fill-in v-show="fill"></fill-in>
            <test-out-put v-show="out"></test-out-put>

        </v-flex>
    </v-container>
</template>

<script>
    import url from './../services/config';
    import fillIn from './FillInTheBlankForm';
    import testOutPut from './OutPutForm';
    export default {
        name: "add-exercice",
        components: {fillIn, testOutPut},
        data () {
            return {
                title : '',
                description: '',
                file : '',
                items: [
                    { text: 'Fill in the blank' },
                    { text: 'Test output' }
                ],
                e2: null
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
        },
        computed: {
            fill: function () {
                return this.e2 === 'Fill in the blank';
            },
            out: function () {
                return this.e2 === 'Test output';
            }
        }
    }
</script>

<style scoped>

</style>