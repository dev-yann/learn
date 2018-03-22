<template>
    <v-layout>
        <v-flex xs12 sm6 offset-sm3>
            <v-card>
                <v-card-title primary-title>
                    <div>
                        <h3 class="headline mb-0">Parcours 1 </h3>
                        <div>Located two hours south of Sydney in the <br>Southern Highlands of New South Wales, ...</div>
                    </div>
                </v-card-title>
                <v-card-actions>
                    <router-link to = "/exercices"><v-btn flat color="orange">Share</v-btn></router-link>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        name: "parcours"
    }
</script>

<style scoped>

</style>