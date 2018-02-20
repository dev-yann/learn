import Vue from 'vue'
import Router from 'vue-router'
import Connexion from '@/components/Connexion'
import Inscription from '@/components/Inscription'
import ParcoursListe from '@/components/ParcoursListe'

/* Routes uniquement pour les personnes connectées */
import Dashboard from '@/components/Dashboard'
import Forum from '@/components/Forum'
import UnSujet from '@/components/UnSujet'
import AddSujet from '@/components/AddSujet'
import Parcours from '@/components/Parcours'

/* Routes uniquement pour les profs */
import Cours from '@/components/Cours'
import Groupes from '@/components/Groupes'

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
      path: '/cours',
      name: 'Cours',
      component: Cours
    },
    {
      path: '/parcours',
      name: 'Parcours',
      component: Parcours
    },
    {
      path: '/unsujet',
      name: 'UnSujet',
      component: UnSujet
    },
    {
      path: '/addsujet',
      name: 'AddSujet',
      component: AddSujet
    }

  ]
})
