<template>
    <v-container>
        <v-layout row justify-center>
            <router-link to="/exercices/add"><v-btn color="primary" dark @click.stop="dialog3 = true">Ajouter un exercice</v-btn></router-link>
            <v-dialog v-model="dialog3" max-width="500px">
                <v-card>
                    <v-card-title>
                        <span>Dialog 3</span>
                        <v-spacer></v-spacer>
                        <v-menu bottom left>
                            <v-btn icon slot="activator">
                                <v-icon>more_vert</v-icon>
                            </v-btn>
                            <v-list>
                                <v-list-tile v-for="(item, i) in items" :key="i" @click="">
                                    <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                                </v-list-tile>
                            </v-list>
                        </v-menu>
                    </v-card-title>
                    <v-card-actions>
                        <v-btn color="primary" flat @click.stop="dialog3=false">Close</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
        <v-layout>
            <v-flex xs12 sm6 offset-sm3>
                <v-card>
                    <v-card-title primary-title>
                        <div>
                            <h3 class="headline mb-0">exercice du parcours 1 </h3>
                            <div>Located two hours south of Sydney in the <br>Southern Highlands of New South Wales, ...</div>
                        </div>
                    </v-card-title>
                    <v-card-actions>
                        <router-link to = "/exercices"><v-btn flat color="orange">Share</v-btn></router-link>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        name: "exercices"
    }
</script>

<style scoped>

</style>