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
import Exercice from '@/components/Exercice'


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
      },
        beforeEnter: (to, from, next) => {

            if(store.getters['isConnected'] && ls.get('token')) {
                next({path: '/dashboard'})
            } else {
                next();
            }
      }
    },
    {
      path: '/inscription',
      name: 'Inscription',
      component: Inscription,
      meta : {
        requireAuth : false
      },
        beforeEnter: (to, from, next) => {

            if(store.getters['isConnected'] && ls.get('token')) {
                next({path: '/dashboard'})
            } else {
                next();
            }
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
    },
    {
      path: '/forum',
      name: 'Forum',
      component: Forum
    },

    {
      path: '/exercice',
      name: 'Exercice',
      component: Exercice
    },
    {
      path: '/parcours/:id/exercice/:ide',
      name: 'exercice',
      component: Exercice,
     meta: {
        requireAuth: true
     }
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
  ]
})

export default router;


// Interception globale de navigation
// Permet de rediriger en cas d'authorisation necessaire

router.beforeEach((to, from, next) => {

    if(to.matched.some(record => record.meta.requireAuth)){

        if(store.getters['isConnected'] && ls.get('token')){
          if(to.path === '/inscription' || to.path === "/connexion"){
              next({path: '/dashboard'})
          }
            next()
        } else {
            next({path: '/connexion', query: { redirect: to.path}})
        }
    } else {
        next();
    }
});
