<template>
    <v-layout row>
        <v-flex xs12 sm6>
            <v-card>
                <v-toolbar color="pink" dark>
                    <v-toolbar-title>Chat</v-toolbar-title>
                    <v-spacer></v-spacer>

                </v-toolbar>
                <v-list two-line>
                    <template v-for="(item, index) in items">
                        <v-list-tile avatar ripple :key="index" @click="">
                            <v-list-tile-content>
                                <v-list-tile-title>{{ item.username}}</v-list-tile-title>
                                <v-list-tile-sub-title class="text--primary">{{ item.message }}</v-list-tile-sub-title>
                            </v-list-tile-content>
                            <v-list-tile-action>
                                <v-list-tile-action-text>{{ item.action }}</v-list-tile-action-text>
                                <v-icon color="grey lighten-1">star_border</v-icon>
                            </v-list-tile-action>
                        </v-list-tile>
                        <v-divider v-if="index + 1 < items.length" :key="`divider-${index}`"></v-divider>
                    </template>
                    <v-list-tile-content>
                        <v-btn color="info" @click="connection">connect</v-btn>
                    </v-list-tile-content>
                </v-list>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>

    import { mapGetters } from 'vuex'
    import Url from './../services/config'

    export default {
        name: "Chat",
        data () {
            return {
                items: []
            }
        },
        methods: {
            connection () {

                // je perd la reference de this a partir de then response
                let dataThis = this;
                // connection au serveur chat en websocket
                let conn = new WebSocket('ws://localhost:9090');
                let username = this.getUser.username;
                let parcours = this.getParcours.id;

                conn.onopen = function(e) {

                    console.log("Connection established!");

                    let msg = {

                        'roomId': parcours,
                        'userName': username,
                        'action': 'connect'
                    };

                    // envoie des données utilisateur au serveur
                    conn.send(JSON.stringify(msg))

                    // Maintenant on peut charger les messages de cette conversation auprès de l'api ?
                    // Pour le début oui, le truc c'est qu'après les mess doivent etre push automatiquement

                    Url.get('/parcours/'+ parcours + '/posts').then(function (response){

                        console.log(response)

                        // Réorganisation des données recues

                        let data = response.data.parcours[0];
                        let posts = data.posts;
                        let users = data.users;

                        posts.forEach(item => {
                            users.forEach(user => {
                                if(item.user_id === user.id){
                                    item.username = user.username
                                }
                            })
                        });

                        dataThis.items = posts
                        console.log(dataThis.items)

                    }).catch(error => {
                        console.log(error)
                    })
                };
                conn.onmessage = function(e) {
                    console.log(e.data);
                };
            }
        },
        computed: {
            ...mapGetters(['getUser','getParcours']),
        }
    }
</script>

<style scoped>

</style>