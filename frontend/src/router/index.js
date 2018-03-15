import Vue from 'vue'
import Router from 'vue-router'
import Connexion from '@/components/Connexion'
import Inscription from '@/components/Inscription'
import ParcoursListe from '@/components/ParcoursListe'

/* Routes uniquement pour les personnes connectées */
import Dashboard from '@/components/Dashboard'
import Forum from '@/components/Forum'
import ForumSujet from '@/components/ForumSujet'
import ForumAdd from '@/components/ForumAdd'
import Parcours from '@/components/Parcours'
import Chat from '@/components/Chat'

/* Routes uniquement pour les profs */
import Cours from '@/components/Cours'
import Groupes from '@/components/Groupes'
import GroupeAdd from '@/components/GroupeAdd'
import GroupeEdit from '@/components/GroupeEdit'

import store from '@/store'
import ls from '@/services/localStorage'

Vue.use(Router)

/**
 * Si un route nécessite une authorisation,
 * ajouter l'objet meta ( voir exemple sur parcours-liste )
 * @type {VueRouter}
 */

const router = new Router({
  routes: [
    {
      path: '/',
      component: Connexion
    },
    {
      path: '/connexion',
      name: 'Connexion',
      component: Connexion,
        meta : {
          requireAuth : false
        }
    },
    {
      path: '/inscription',
      name: 'Inscription',
      component: Inscription
    },
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: Dashboard
    },
    {
      path: '/parcoursliste',
      name: 'ParcoursListe',
      component: ParcoursListe,
        meta: {
          requireAuth : true
        }
    },
    {
      path: '/forum',
      name: 'Forum',
      component: Forum
    },
    {
      path: '/groupes',
      name: 'Groupes',
      component: Groupes
    },
    {
      path: '/cours',
      name: 'Cours',
      component: Cours
    },
     /* route /chat devra être supprimé mais pas maintenant */
   /* {
      path: '/parcours',
      name: 'Parcours',
      component: Parcours
   }, */
   {
      path: '/parcours/:id/:name',
      name: 'parcours',
      components: {
        default : Parcours,
          chat : Chat
      },
   },
    {
      path: '/forumsujet',
      name: 'ForumSujet',
      component: ForumSujet
    },
    {
      path: '/forumadd',
      name: 'ForumAdd',
      component: ForumAdd
    },
    {
      path: '/groupeadd',
      name: 'GroupeAdd',
      component: GroupeAdd
    },
    {
      path: '/groupeedit',
      name: 'GroupeEdit',
      component: GroupeEdit
   }
  ]
})

export default router;


// Interception globale de navigation
// Permet de rediriger en cas d'authorisation necessaire

router.beforeEach((to, from, next) => {

    console.log(to.matched)
    if(to.matched.some(record => record.meta.requireAuth)){

        if(store.getters['isConnected'] && ls.get('token')){
            next()
        } else {

            next({path: '/connexion', query: { redirect: to.path}})
        }

    } else {
        next();
    }

});
