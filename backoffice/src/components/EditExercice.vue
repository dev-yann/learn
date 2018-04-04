<template>
  <v-container fluid>
    <v-layout row wrap>
      <v-flex xs12 md6 offset-md3>
        <h1>Ajouter un exercice</h1>

          <v-subheader>Choisissez un type d'exercice :</v-subheader>

          <v-select :items="items" v-model="e2" label="Select" class="input-group--focused" item-value="text" ></v-select>
            <fill-in v-show="fill"></fill-in>
            <test-out-put v-show="out"></test-out-put>

        </v-flex>
      </v-layout>
    </v-container>
</template>

<script>
    import url from './../services/config';
    import fillIn from './FillInTheBlankForm';
    import testOutPut from './OutPutForm';
    export default {
        data () {
            return {   
                exercice : [],

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
