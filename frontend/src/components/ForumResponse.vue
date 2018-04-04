<template>
    <v-layout row>
        <v-flex xs12 sm6 offset-sm3>
            <v-card>
                <v-list two-line>
                    <template v-for="(item, index) in items">
                        <v-list-tile
                                avatar
                                ripple
                                @click="toggle(index)"
                                :key="item.title"
                        >
                            <v-list-tile-content>
                                <v-list-tile-title>{{ item.user.username}}</v-list-tile-title>
                                <v-list-tile-sub-title>{{ item.post }}</v-list-tile-sub-title>
                            </v-list-tile-content>
                            <v-list-tile-action>
                                <v-list-tile-action-text>{{ item.created_at }}</v-list-tile-action-text>


                            </v-list-tile-action>
                        </v-list-tile>
                        <v-divider v-if="index + 1 < items.length" :key="index"></v-divider>
                    </template>
                </v-list>
            </v-card>
        </v-flex>


        <v-dialog v-model="dialog3" max-width="500px">
            <v-card>
                <v-card-title>
                    <span>Ajouter votre réponse</span>
                    <v-spacer></v-spacer>
                </v-card-title>

                <v-card-text>

                    <v-text-field
                            label="message"
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
</template>

<script>

    import Url from './../services/config'
    import UrlJ from './../services/configJwt'
    export default {
        name: "forum-response",
        props: ['id','idr'],
        data: () => ({

            selected: [2],
            items: [],
            description : '',
            dialog3 : false
        }),
        mounted () {

          this.getMessages()

        },
        methods: {
            toggle (index) {
                const i = this.selected.indexOf(index)

                if (i > -1) {
                    this.selected.splice(i, 1)
                } else {
                    this.selected.push(index)
                }
            },
            getMessages() {
                  Url.get("/forum/subject/" + this.idr + "/response").then(response => {
                this.items = response.data.data
                console.log(this.items)
            }).catch(error => {
                console.log(error)
            })
        },
            add () {
                UrlJ.post('/connect/subject/add_response',{

                    post: this.description,
                    subject_id: this.idr

                }).then(response => {
                    this.getMessages()
                    this.dialog3 = false
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