<template>
    <v-app id="inspire" dark>

        <!-- Side Bar -->
        <v-navigation-drawer clipped fixed v-model="drawer" app>
            <v-toolbar flat class="transparent" v-if="islog">
                <router-link to="/dashboard">
                    <v-list class="pa-0">
                        <v-list-tile avatar>
                            <v-list-tile-avatar>
                                <img class="profil" src="https://randomuser.me/api/portraits/men/85.jpg">
                            </v-list-tile-avatar>
                            <v-list-tile-content>
                                <v-list-tile-title class="nbXp">{{user.exp}} XP</v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list>
                </router-link>
            </v-toolbar>
            <v-divider></v-divider>

            <v-list dense>
                <router-link to="/dashboard" v-if="islog">
                    <v-list-tile>
                        <v-list-tile-action>
                            <v-icon v-if="this.$router.currentRoute.fullPath==='/dashboard'"
                                    color="light-green lighten-1">dashboard
                            </v-icon>
                            <v-icon v-else>dashboard</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                <span v-if="this.$router.currentRoute.fullPath==='/dashboard'" class="navCurrent">Dashboard</span>
                                <span v-else>Dashboard</span>
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </router-link>

                <router-link to="/parcoursliste">
                    <v-list-tile>
                        <v-list-tile-action>
                            <v-icon v-if="this.$router.currentRoute.fullPath==='/parcoursliste'"
                                    color="light-green lighten-1">code
                            </v-icon>
                            <v-icon v-else>code</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                <span v-if="this.$router.currentRoute.fullPath==='/parcoursliste'" class="navCurrent">Parcours</span>
                                <span v-else>Parcours</span>
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </router-link>

                <router-link to="/forum">
                    <v-list-tile>
                        <v-list-tile-action>
                            <v-icon v-if="this.$router.currentRoute.fullPath==='/forum'" color="light-green lighten-1">
                                forum
                            </v-icon>
                            <v-icon v-else>forum</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                <span v-if="this.$router.currentRoute.fullPath==='/forum'"
                                      class="navCurrent">Forum</span>
                                <span v-else>Forum</span>
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </router-link>


                <!-- Routes de connexion -->

                <v-divider></v-divider>

                <router-link to="/connexion" v-if="!islog">
                    <v-list-tile>
                        <v-list-tile-action>
                            <v-icon v-if="this.$router.currentRoute.fullPath==='/connexion'"
                                    color="light-green lighten-1">lock_open
                            </v-icon>
                            <v-icon v-else>lock_open</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                <span v-if="this.$router.currentRoute.fullPath==='/connexion'" class="navCurrent">Sign in</span>
                                <span v-else>Sign in</span>
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </router-link>

                <router-link to="/inscription" v-if="!islog">
                    <v-list-tile>
                        <v-list-tile-action>
                            <v-icon v-if="this.$router.currentRoute.fullPath==='/inscription'"
                                    color="light-green lighten-1">lock
                            </v-icon>
                            <v-icon v-else>lock</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                <span v-if="this.$router.currentRoute.fullPath==='/inscription'" class="navCurrent">Sign up</span>
                                <span v-else>Sign up</span>
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </router-link>

                <a @click="logout" v-if="islog">
                    <v-list-tile>
                        <v-list-tile-action>
                            <v-icon>lock</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>Log out</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </a>
            </v-list>


        </v-navigation-drawer>


        <!-- Nav Bar -->

        <v-toolbar app fixed clipped-left>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <router-link to="/dashboard">
                <v-toolbar-title class="nom" v-if="islog">{{user.username}}</v-toolbar-title>
            </router-link>

        </v-toolbar>


        <!-- Contenu Application -->

        <v-content>
            <v-container fluid fill-height>
                <v-layout>
                    <router-view></router-view>
                </v-layout>
            </v-container>
        </v-content>

        <!-- Footer -->

        <v-footer app fixed>
            <span class="contenuFooter">&copy; Environnement d'apprentissage 2018</span>
        </v-footer>
    </v-app>
</template>


<script>
    import {mapMutations} from 'vuex'
    import {mapGetters} from 'vuex'
    import url from './services/config'

    export default {
        name: 'App',
        data: () => ({
            drawer: null
        }),
        props: {
            source: String
        },
        methods: {

            ...mapMutations(['setDisconnectedUser']),

            logout() {

                this.setDisconnectedUser({});
            }

        },
        computed: {

            ...mapGetters(['isConnected', 'getUser']),


            islog() {

                if (this.$store.getters['isConnected']) {

                    this.$router.push({path: "/dashboard"})
                } else {
                    this.$router.push({path: "/connexion"})
                }

                return this.$store.getters['isConnected'];
            },

            user() {
                return this.$store.getters['getUser'];
            }
        }
    }
</script>

<style>
    .contenuFooter {
        color: grey;
        margin: auto;
    }

    a, .list__tile__content {
        text-decoration: none;
        color: white;
    }

    .nbXp {
        font-size: 1.1em;
        margin: auto;
    }

    .avatar {
        width: 5px;
    }

    .navCurrent {
        color: #9CCC65;
    }

    .nom {
        color: white;
    }
</style>
