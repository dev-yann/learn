<template>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-flex xs12>
                <v-alert type="error" :value="true" dismissible v-model="alert">
                    This is a error alert.
                </v-alert>
            </v-flex>

            <v-flex xs12>
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
            </v-flex>

            <v-flex xs6 v-for="item in forum" key="item.id">
                <v-card>
                    <v-card-title primary-title>

                        <h1 class="headline mb-0">{{item.title}}</h1>

                    </v-card-title>
                    <v-card-actions>
                        <v-btn flat color="orange">Consulter</v-btn>
                        <v-btn flat color="orange">Suprimer</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>


            <v-dialog v-model="dialog2" max-width="500px">
                <v-card>
                    <v-card-title>
                        Ajouter un forum à l'un de votre parcours
                    </v-card-title>
                    <v-card-text>
                        <v-select
                                :items="select"
                                label="Choisissez le parcours à associer"
                                item-value="title"
                                v-model="parcours"
                                item-text="title"
                                :return-object="myBool"
                        ></v-select>
                        <v-text-field
                                name="input-1"
                                label="Le titre du forum"
                                id="testing"
                                v-model="titlef"
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
        data() {
            return {
                dialog2: false,
                notifications: false,
                sound: true,
                widgets: false,
                select: [],
                parcours: {},
                titlef: '',
                myBool: true,
                forum: [],
                alert: false
            }
        },
        methods: {
            add() {

                Url.post('/connect/author_forum', {

                    parcours: this.parcours,
                    title: this.titlef

                }).then(response => {

                    this.forum.push(response.data.message);

                }).catch(error => {
                    this.alert = true
                    console.log(error)
                })
            },

            searchForum() {

                Url.get('/connect/author_parcours').then(response => {
                    response.data.parcours.forEach((items) => {
                        this.select.push(items)
                    })
                    console.log(response)
                }).catch(error => {
                    console.log(error)
                })
            }
        },

        mounted() {

            Url.get('/connect/forum').then(response => {

                this.forum.push(...response.data);
                this.searchForum();

            }).catch(error => {
                console.log(error)
            })

        }
    }
</script>

<style scoped>

</style>