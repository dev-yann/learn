<template>
  <v-app id="inspire" dark>


    <!-- Side Bar -->
    <v-navigation-drawer
            clipped
            fixed
            v-model="drawer"
            app
    >
      <v-list dense>

        <router-link to ="/dashboard">
          <v-list-tile>
            <v-list-tile-action><v-icon>dashboard</v-icon></v-list-tile-action>
            <v-list-tile-content><v-list-tile-title>Dashboard</v-list-tile-title></v-list-tile-content>
          </v-list-tile>
        </router-link>

        <router-link to ="/listexercices">
          <v-list-tile>
            <v-list-tile-action><v-icon>code</v-icon></v-list-tile-action>
            <v-list-tile-content><v-list-tile-title>Exercices</v-list-tile-title></v-list-tile-content>
          </v-list-tile>
        </router-link>

        <router-link to ="/forum">
          <v-list-tile>
            <v-list-tile-action><v-icon>forum</v-icon></v-list-tile-action>
            <v-list-tile-content><v-list-tile-title>Forum</v-list-tile-title></v-list-tile-content>
          </v-list-tile>
        </router-link>


        <router-link to ="#">
          <v-list-tile>
            <v-list-tile-action><v-icon>settings</v-icon></v-list-tile-action>
            <v-list-tile-content><v-list-tile-title>Settings</v-list-tile-title></v-list-tile-content>
          </v-list-tile>
        </router-link>

        <!-- Routes uniquement pour les profs -->

          <v-list-tile>
            <v-list-tile-content><v-list-tile-title></v-list-tile-title></v-list-tile-content>
          </v-list-tile>

        <router-link to ="/groupes">
          <v-list-tile>
            <v-list-tile-action><v-icon>people</v-icon></v-list-tile-action>
            <v-list-tile-content><v-list-tile-title>Groupes</v-list-tile-title></v-list-tile-content>
          </v-list-tile>
        </router-link>

        <router-link to ="/cours">
          <v-list-tile>
            <v-list-tile-action><v-icon>business_center</v-icon></v-list-tile-action>
            <v-list-tile-content><v-list-tile-title>Mes cours</v-list-tile-title></v-list-tile-content>
          </v-list-tile>
        </router-link>


        <!-- Routes différentes si connecté ou non -->

          <v-list-tile>
            <v-list-tile-content><v-list-tile-title></v-list-tile-title></v-list-tile-title></v-list-tile-content>
        </v-list-tile>


      <router-link to ="/connexion">
        <v-list-tile>
          <v-list-tile-action><v-icon>lock_open</v-icon></v-list-tile-action>
          <v-list-tile-content><v-list-tile-title>Sign in</v-list-tile-title></v-list-tile-title></v-list-tile-content>
      </v-list-tile>
    </router-link>

        <router-link to ="/inscription">
          <v-list-tile>
            <v-list-tile-action><v-icon>lock_open</v-icon></v-list-tile-action>
            <v-list-tile-content><v-list-tile-title>Sign up</v-list-tile-title></v-list-tile-title></v-list-tile-content>
        </v-list-tile>
      </router-link>

      <router-link to ="/connexion">
        <v-list-tile>
          <v-list-tile-action><v-icon>lock</v-icon></v-list-tile-action>
          <v-list-tile-content><v-list-tile-title>Log out</v-list-tile-title></v-list-tile-content>
      </v-list-tile>
    </router-link>

      </v-list>
    </v-navigation-drawer>


    <!-- Nav Bar -->

    <v-toolbar app fixed clipped-left>
      <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
      <v-toolbar-title>Application</v-toolbar-title>
    </v-toolbar>


    <!-- Contenu Application -->

  <!--  <v-content>
      <v-container fluid fill-height>
        <v-layout justify-center align-center>
          <v-tooltip right>
            <v-btn icon large :href="source" target="_blank" slot="activator">
              <v-icon large>code</v-icon>
            </v-btn>
            <span>Source</span>
          </v-tooltip>
          <router-view></router-view>
        </v-layout>
      </v-container>
    </v-content> -->

    <router-view></router-view>

    <!-- Footer -->

    <v-footer app fixed>
      <span class="contenuFooter">&copy; Environnement d'apprentissage 2018</span>
    </v-footer>


  </v-app>
</template>


<script>
export default {
    name: 'App',
    data: () => ({
        drawer: null
    }),
    props: {
        source: String
    }
}
</script>

<style>

.contenuFooter{
  color: grey;
  margin:auto;
}

a, .list__tile__content{
  text-decoration:none;
  color:white;
}
body{
  margin-top:45px;
}


</style>
