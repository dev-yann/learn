<template>
    <v-container grid-list-md>
        <v-layout row wrap>
            <v-flex xs12>
                <h1>{{title}}</h1>
            </v-flex>

            <v-flex xs12>
                <v-data-iterator content-tag="v-layout" :items="items" :rows-per-page-items="rowsPerPageItems"
                                 :pagination.sync="pagination">
                    <v-flex slot="item" slot-scope="props" lg4 offset-lg1>

                        <router-link
                                :to="{ name : 'forum-response', params : { id : props.item.forum_id, name : props.item.title, idr : props.item.id }}">
                            <v-card class="unCours">
                                <v-card-title>
                                    <v-list-tile-content>
                                        <h2>{{ props.item.title }}</h2>
                                        <p>{{ props.item.description}}</p>
                                    </v-list-tile-content>
                                </v-card-title>
                                <div class="timeNdiff">
                                    <v-divider></v-divider>
                                    <v-list dense>
                                        <v-list-tile>
                                            <v-list-tile-content>
                                                <div>
                                                    <v-icon color="grey" class="timerIcon">timelapse</v-icon>
                                                    {{ props.item.temps }}
                                                </div>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </div>
                            </v-card>
                        </router-link>

                    </v-flex>
                </v-data-iterator>

            </v-flex>


            <v-dialog v-model="dialog3" max-width="500px">
                <v-card>
                    <v-card-title>
                        <span>Ajouter une question concernant le parcours</span>
                        <v-spacer></v-spacer>
                    </v-card-title>

                    <v-card-text>
                        <v-text-field
                                label="titre"
                                v-model="titre"
                                required
                        ></v-text-field>

                        <v-text-field
                                label="description"
                                v-model="description"
                                multi-line
                                required
                        ></v-text-field>


                    </v-card-text>

                    <v-card-actions>
                        <v-btn @click="add" color="primary" flat>envoyer</v-btn>
                        <v-btn color="primary" flat @click.stop="dialog3=false">Close</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-btn
                    color="pink"
                    dark
                    bottom
                    right
                    fab
                    fixed
                    @click.stop="dialog3 = true"

            >
                <v-icon>add</v-icon>
            </v-btn>
        </v-layout>
    </v-container>
</template>
<script>
    import Url from './../services/config'
    import UrlJ from './../services/configJwt'

    export default {
        name: 'ForumSujet',
        props: ['id', 'title'],
        data: () => ({

            rowsPerPageItems: [3, 6, 9],
            pagination: {
                rowsPerPage: 3
            },

            dialog3: false,
            mybool: true,
            titre: '',
            description: '',
            myBool: true,
            items : []
        }),
        methods: {
            add() {
                UrlJ.post("/connect/add_subject", {
                    id_forum: this.id,
                    titre: this.titre,
                    description: this.description
                }).then(response => {
                    console.log(response)
                }).catch(error => {
                    console.log(error)
                })
            }
        },
        mounted() {

            Url.get("/forum/subject/" + this.id).then(response => {

                this.items.push(...response.data.data)
                console.log(this.items)

            }).catch(error => {
                console.log(error)
            })
        }
    }
</script>

<style scoped>

    h1 {
        margin: auto;
        text-align: center;
    }

</style>
