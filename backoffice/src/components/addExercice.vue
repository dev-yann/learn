<template>
    <v-container fluid>
        <h1>Ajouter un exercice</h1>

        <v-flex xs8>

            <v-flex xs6>
                <v-subheader>Choisissez un type d'exercice</v-subheader>
            </v-flex>

            <v-flex xs6>
                <v-select :items="items" v-model="e2" label="Select" class="input-group--focused" item-value="text" ></v-select>
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

                items: [
                    { text: 'Fill in the blank' },
                    { text: 'Test output' }
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
        }
    }
</script>

<style scoped>

</style>
