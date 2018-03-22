import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import addCourses from '@/components/addCourses'
import Parcours from '@/components/Parcours'
import Exercices from '@/components/Exercices'
import addExercice from '@/components/addExercice'

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
      {
        path: '/add',
          name: 'Add',
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
