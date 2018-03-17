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
import Exercice from '@/components/Exercice'
// On est d'accord c'est du back end, c'est a supprimer
// import Groupes from '@/components/Groupes'
// import GroupeAdd from '@/components/GroupeAdd'
// import GroupeEdit from '@/components/GroupeEdit'

import store from '@/store'
import ls from '@/services/localStorage'

Vue.use(Router)

/**
 * Si un route nécessite une authorisation,
 * ajouter l'objet meta (voir exemple sur parcours-liste)
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
      component: Inscription,
      meta : {
        requireAuth : false
      }
    },
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: Dashboard,
      meta: {
         requireAuth: true
      }
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
    // On est d'accord c'est du back end, c'est a supprimer
/*    {
      path: '/groupes',
      name: 'Groupes',
      component: Groupes
   }, */

    {
      path: '/exercice',
      name: 'Exercice',
      component: Exercice,
   /*   meta: {
        requireAuth: true
     }*/
    },
  {
      path: '/parcours/:id/:name',
      name: 'parcours',
      components: {
        default : Parcours,
        chat : Chat
      },
      meta: {
        requireAuth: true
      }
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
    // On est d'accord c'est du back end, c'est a supprimer
/*{
      path: '/groupeadd',
      name: 'GroupeAdd',
      component: GroupeAdd
    },
    {
      path: '/groupeedit',
      name: 'GroupeEdit',
      component: GroupeEdit
   }*/
  ]
})

export default router;


// Interception globale de navigation
// Permet de rediriger en cas d'authorisation necessaire

router.beforeEach((to, from, next) => {

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
