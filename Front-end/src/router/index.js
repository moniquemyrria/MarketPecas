import Vue from 'vue'
import Router from 'vue-router'
import Formulario from '@/components/Formulario'
import MenuEmpresa from '@/components/MenuEmpresa'
import Listar from '@/components/Listar'

import LoginCadastroUsuario from '@/components/LoginCadastroUsuario'
import CadastroProduto from '@/components/CadastroProduto'
import PerfilUsuarioEmpresa from '@/components/PerfilUsuarioEmpresa'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [{
    path: '/',
    name: 'LoginCadastroUsuario',
    component: LoginCadastroUsuario,
  },
  {
    path: '/MenuEmpresa',
    name: 'MenuEmpresa',
    component: MenuEmpresa,
  },
  {
    path: '/CadastroProduto',
    name: 'CadastroProduto',
    component: CadastroProduto,
  },
  {
    path: '/PerfilUsuarioEmpresa',
    name: 'PerfilUsuarioEmpresa',
    component: PerfilUsuarioEmpresa,
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
  },
    
  ]
})
