<template>
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12 md6 offset-md3>
                <h1>Modifier un exercice</h1>

                <v-subheader>Choisissez un type d'exercice :</v-subheader>

                <v-select :items="items" v-model="e2" label="Select" class="input-group--focused"
                          item-value="text"></v-select>
                <fill-in
                        v-show="fill"
                        :title_true="title_true"
                        :description="description"
                        :type = "e2"
                        :id = "id"></fill-in>
                <test-out-put
                        v-show="out"
                        :title_true="title_true"
                        :description="description"
                        :typeExercice = "e2"
                        :id = "id"></test-out-put>

            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    import fillIn from './ModifyFillIn';
    import testOutPut from './ModifyOutput';

    export default {
        name: "Modify",
        components: {fillIn, testOutPut},
        props: ['type','title_true','description','id'],
        data() {
            return {
                items: [
                    {text: 'Fill in the blank'},
                    {text: 'Test output'}
                ],
                e2: null
            }
        },
        computed: {
            fill: function () {
                return this.e2 === 'Fill in the blank';
            },
            out: function () {
                return this.e2 === 'Test output';
            }
        },
        methods: {



        },
        mounted() {

            if (this.type === 1) {

                this.e2 = "Test output"

            } else {

                this.e2 = "Fill in the blank"
            }
        }
    }
</script>

<style scoped>

</style>