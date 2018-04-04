<template>
    <v-layout row wrap>
        <v-flex xs12>
            <h1>Tableau de bord</h1>

            <!-- Afficher les parcours auqquel l'utilisateur à souscrit -->
            <h2>Mes parcours</h2>
            <v-data-table
                    :headers="headers"
                    :items="items"
                    hide-actions
                    class="elevation-1"
            >
                <template slot="items" slot-scope="props">
                    <router-link :to="{ name : 'parcours', params : { id : props.item.id, name : props.item.title}}">
                    <td>{{ props.item.title }}</td>
                    <td>{{ props.item.level }}</td>
                    <td>{{ props.item.temps }}</td>
                    </router-link>
                </template>
            </v-data-table>
        </v-flex>
    </v-layout>
</template>


<script>
    import Url from './../services/configJwt';
    export default {
        name: 'Dashboard',
        data: () => ({
            headers: [
                {
                    text: 'Les parcours que je suis',
                    align: 'left',
                    sortable: false,
                    value: 'name'
                },
                { text: 'Difficulté', value: 'level' },
                { text: 'Temps conseillé', value: 'temps' },
                ],
            items: []
        }),
        methods: {},
        mounted () {

            Url.get("/connect/dashboard").then(response => {
                this.items = response.data.data.parcours

                console.log(this.items)
                console.log(response)
            }).catch(error => {
                console.log(error)
            })
        }
    }
</script>


<style scoped>
    h1 {
        text-align: center;
    }
    a {
        color : white;
    }
</style>
