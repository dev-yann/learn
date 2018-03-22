<template>
    <v-flex xs6>
        <v-text-field v-model="title"
                      name="title"
                      label="titre"
        ></v-text-field>

        <v-text-field v-model="description"
                      name="level"
                      label="description"
                      multi-line= "true"
        ></v-text-field>

        <label>File
            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
        </label>

        <v-btn color="success" @click="submitFile()">Ajouter l'exercice au parcours</v-btn>
    </v-flex>
</template>

<script>
    export default {
        name: "out-put-form"
    }
</script>

<style scoped>

</style>