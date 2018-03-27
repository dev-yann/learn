<template>
    <v-container>
        <v-layout row wrap>

            <v-card-text @click.stop="dialog2 = true" style="height: 100px; position: relative">
                <v-btn
                        absolute
                        dark
                        fab
                        top
                        right
                        color="pink"
                >
                    <v-icon>add</v-icon>
                </v-btn>
            </v-card-text>

            <v-dialog v-model="dialog2" max-width="500px">
                <v-card>
                    <v-card-title>
                        Ajouter un forum à l'un de votre parcours
                    </v-card-title>
                    <v-card-text>
                        <v-select
                                :items="select"
                                label="Choisissez le parcours à associer"
                                item-value="text"
                        ></v-select>
                        <v-text-field
                                name="input-1"
                                label="Le titre du forum"
                                id="testing"
                        ></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" flat @click.stop="dialog2=false" @click="add">Ajouter</v-btn>
                        <v-btn color="primary" flat @click.stop="dialog2=false">fermer</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>

        </v-layout>
    </v-container>
</template>

<script>
    import Url from './../services/configJwt'
    export default {
        name: "forum",
        data () {
            return {
                dialog2: false,
                notifications: false,
                sound: true,
                widgets: false,
                items: [],
                select: []
            }
        },
        methods: {
            add () {

            }
        },

        mounted () {

            Url.get('/connect/author_parcours').then(response => {
                console.log(response)
            }).catch(error => {
                console.log(error)
            })
        }
    }
</script>

<style scoped>

</style>