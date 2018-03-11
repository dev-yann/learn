<template>
    <v-container fluid>
        <h1>Ajouter un exercice</h1>

        <v-flex xs8>

            <v-text-field v-model="title"
                          name="title"
                          label="titre"
            ></v-text-field>

            <v-text-field v-model="time"
                          name="time"
                          label="temps du parcours"
            ></v-text-field>


            <v-text-field v-model="level"
                          name="level"
                          label="Niveau de difficulté de 1 a 3 "
            ></v-text-field>

            <v-text-field v-model="description"
                          name="level"
                          label="description"
                          multi-line="true"
            ></v-text-field>

            <v-btn color="success" @click="add">Ajouter le parcours</v-btn>
        </v-flex>
    </v-container>
</template>

<script>
    export default {
        name: "add-exercice",
        data () {
            return {
                title : '',
                time : '',
                level: '',
                description: ''
            }
        }
    }
</script>

<style scoped>

</style>