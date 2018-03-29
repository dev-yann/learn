<template>
    <div class="containerGeneral">

        <v-layout row wrap>
            <v-flex xs10 offset-xs1>
                <h1>Forum
                    <router-link to="/forumadd">
                        <v-icon medium color="light-green lighten-1">add_circle</v-icon>
                    </router-link>
                </h1>
            </v-flex>

            <v-flex xs12 md10 lg12 offset-md1 offset-lg0>
                <v-container fluid grid-list-md>
                    <v-data-iterator content-tag="v-layout" row wrap :items="items"
                                     :rows-per-page-items="rowsPerPageItems" :pagination.sync="pagination">
                        <v-flex slot="item" slot-scope="props" xs12>

                            <router-link :to="{name: 'forumsujet', params : { id : props.item.id, title : props.item.title}}">
                                <v-card>
                                    <v-card-title>
                                        <h2>{{props.item.title}}</h2>
                                    </v-card-title>
                                    <v-list dense>
                                        <v-list-tile>
                                            <v-list-tile-content class="redacteur">
                                                <div>{{ props.item.users.username}}</div>
                                            </v-list-tile-content>
                                            <v-list-tile-content class="align-end">
                                                <div>
                                                    <v-icon>chat_bubble_outline</v-icon>
                                                </div>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-card>
                            </router-link>
                        </v-flex>
                    </v-data-iterator>
                </v-container>
            </v-flex>

        </v-layout>
    </div>
</template>
<script>
    import Url from "./../services/config"

    export default {

        name: 'Forum',
        data: () => ({
            rowsPerPageItems: [4, 8, 12],
            pagination: {
                rowsPerPage: 4
            },
            items: []
        }),
        mounted() {
            Url.get("/user-forum").then(response => {
                console.log(response)
                this.items.push(...response.data.data);
                console.log(this.items)
            }).catch(error => {
                console.log(error)
            })
        }
    }
</script>


<style scoped>
    .containerGeneral {
        margin-top: 8vh;
    }

    a {
        color: grey;
    }

    a:hover {
        color: white;
        transition: 0.2s;
    }

    h1, h4 {
        margin: auto;
        text-align: center;
    }

    h1 {
        margin-bottom: 3vh;
    }

    .timerIcon {
        margin-right: 18px;
    }

    .redacteur {
        color: grey;
    }

    .nbMessage {
        position: relative;
        right: 10px;
    }

    .resolu {
        margin-left: 20px;
    }

</style>
