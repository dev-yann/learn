import Vue from 'vue'
import Router from 'vue-router'
import addCourses from '@/components/addCourses'
import Parcours from '@/components/Parcours'
import Exercices from '@/components/Exercices'
import addExercice from '@/components/addExercice'
import NotFound from '@/components/Notfound'
import Inscription from '@/components/Inscription'
import Connexion from '@/components/Connexion'

Vue.use(Router);

export default new Router({
  routes: [
    {
        path: '*',
        component: NotFound
    },
    {
      path: '/',
      name: NotFound,
      component: NotFound
    },
    {
      path: '/inscription',
      name: 'Inscription',
      component: Inscription
    },
    {
      path: '/connexion',
      name: 'Connexion',
      component: Connexion
    },
    {
      path: '/add',
        name: 'add-courses',
        component: addCourses
    },
    {
      path: "/parcours",
        name: 'Parcours',
        component: Parcours
    },
    {
      path: "/exercices",
        name:"Exercices",
        component: Exercices
    },
    {
        path: "/exercices/add",
        name: "add-exercice",
        component: addExercice
    }
  ]
})
