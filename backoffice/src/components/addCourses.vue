<template>
  <v-container fluid>
    <v-layout row wrap>
      <v-flex xs12 md6 offset-md3>

        <h1>Ajouter un parcours</h1>
        <v-text-field v-model="name" name="name" label="Nom du parcours"></v-text-field>
        <v-text-field v-model="time" name="time" label="temps du parcours"></v-text-field>
        <v-text-field v-model="level" name="level" label="Niveau de difficulté de 1 a 3"></v-text-field>
        <v-text-field v-model="description" name="level" label="description" :multi-line="line" ></v-text-field>
        <v-btn color="light-green lighten-1" @click="add">Ajouter le parcours</v-btn>

      </v-flex>
    </v-layout>
  </v-container>

</template>

<script>
    import Url from './../services/configJwt';
    import { mapGetters } from 'vuex';
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
                Url.post('/connect/parcours',{
                    title : this.name,
                    /**
                     * todo: ajouter le state sur cette app
                     */
                    author_id : this.getUser.id, // getters de l'auteur,
                    level : this.level,
                    temps : this.time,
                    description: this.description
                }).then(response => {
                  this.$router.push('parcours')
                    console.log(response)
                }).catch(error => {
                    console.log(error)
                })
            }
        },
        computed: {
            ...mapGetters(['getUser'])
        }
    }
</script>

<style scoped>

</style>
