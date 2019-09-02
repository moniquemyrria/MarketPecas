import Vue from 'vue'
import Router from 'vue-router'
import Formulario from '@/components/Formulario'
import Menu from '@/components/Menu'
import Listar from '@/components/Listar'
import AppHeader from '@/components/AppHeader'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [{
    path: '/',
    name: 'AppHeader',
    component: AppHeader,
    children: [
      {
        path: '/AppHeader',
        name: 'AppHeader',
        component: AppHeader
      },
      {
        path: '/Listar',
        name: 'Listar',
        component: Listar
      },
      
      {
        path: '/Cadastro',
        name: 'Cadastro',
        component: Formulario,
      },
      {
        props: true,
        path: '/Alterar/:id',
        name: 'Alterar',
        component: Formulario,
      }
      
    ]
  }]
})
