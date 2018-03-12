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
import Groupes from '@/components/Groupes'
import GroupeAdd from '@/components/GroupeAdd'
import GroupeEdit from '@/components/GroupeEdit'

Vue.use(Router)


export default new Router({
  routes: [
    {
      path: '/',
      component: Connexion
    },
    {
      path: '/connexion',
      name: 'Connexion',
      component: Connexion
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
      component: ParcoursListe
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
      path: '/exercice',
      name: 'Exercice',
      component: Exercice
    },
     /* route /chat devra être supprimé mais pas maintenant */
    {
      path: '/parcours',
      name: 'Parcours',
      component: Parcours
   },
/*   {
      path: '/parcours/:id/:name',
      name: 'parcours',
      components: {
        default : Parcours,
          chat : Chat
      },
   },*/
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
