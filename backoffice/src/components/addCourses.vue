<template>

    <v-container fluid>
        <h1>Ajouter un parcours</h1>

        <v-flex xs8>
            <v-text-field v-model="name" name="name" label="Nom du parcours"></v-text-field>

            <v-text-field v-model="time" name="time" label="temps du parcours"></v-text-field>


            <v-text-field v-model="level" name="level" label="Niveau de difficulté de 1 a 3"></v-text-field>

            <v-text-field v-model="description" name="level" label="description" :multi-line="line" ></v-text-field>

            <v-btn color="success" @click="add">Ajouter le parcours</v-btn>
        </v-flex>
    </v-container>

</template>

<script>
    import Url from './../services/config';
    export default {
        name: "add-courses",
        data () {
            return {
                name : '',
                time : '',
                level: '',
                description: '',
                line: true,
            }
        },
        methods: {
            add () {
                Url.post('/parcours',{
                    title : this.name,
                    /**
                     * todo: ajouter le state sur cette app
                     */
                    author_id : 1 , // getters de l'auteur,
                    level : this.level,
                    temps : this.time,
                    description: this.description
                }).then(response => {
                  this.$router.push('/parcours')
                    console.log(response)
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>

<style scoped>

</style>
