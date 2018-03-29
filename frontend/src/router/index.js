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
import NotFound from '@/components/Notfound'
import ForumResponse from '@/components/ForumResponse'

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
            path: '*',
            component: NotFound
        },
        {
            path: '/',
            component: Connexion,

            beforeEnter: (to, from, next) => {

                if (store.getters['isConnected'] && ls.get('token')) {
                    next({path: '/dashboard'})
                } else {
                    next();
                }
            }

        },
        {
            path: '/connexion',
            name: 'Connexion',
            component: Connexion,
            meta: {
                requireAuth: false
            },
            beforeEnter: (to, from, next) => {

                if (store.getters['isConnected'] && ls.get('token')) {
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
            meta: {
                requireAuth: false
            },
            beforeEnter: (to, from, next) => {

                if (store.getters['isConnected'] && ls.get('token')) {
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
            meta: {
                requireAuth: false
            }
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
                default: Parcours,
                chat: Chat
            },
            meta: {
                requireAuth: false
            }
        },
        {
            path: '/forumsujet/:id/:title',
            name: 'forumsujet',
            component: ForumSujet,
            props: true,
            meta: {
                requireAuth: false
            }
        },
        {
            path: '/forumadd',
            name: 'ForumAdd',
            component: ForumAdd
        },
        {
            path: '/forum-response/:id/:title/subject/:idr',
            name: 'forum-response',
            props: true,
            component: ForumResponse
        }
    ]
})

export default router;


// Interception globale de navigation
// Permet de rediriger en cas d'authorisation necessaire


