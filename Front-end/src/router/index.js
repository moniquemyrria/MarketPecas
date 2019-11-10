import Vue from 'vue'
import Router from 'vue-router'
import Formulario from '@/components/Formulario'
import MenuEmpresa from '@/components/MenuEmpresa'
import MenuCliente from '@/components/MenuCliente'
import Listar from '@/components/Listar'

import LoginCadastroUsuario from '@/components/LoginCadastroUsuario'
import CadastroProduto from '@/components/CadastroProduto'
import PerfilUsuarioEmpresa from '@/components/PerfilUsuarioEmpresa'
import PerfilUsuarioCliente from '@/components/PerfilUsuarioCliente'
import OfertaProduto from '@/components/OfertaProduto'
import SiteCotacoes from '@/components/SiteCotacoes'
import MinhasCotacoesCliente from '@/components/MinhasCotacoesCliente'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [{
    path: '/',
    name: 'SiteCotacoes',
    component: SiteCotacoes,
  },
  {
    path: '/LoginCadastroUsuario',
    name: 'LoginCadastroUsuario',
    component: LoginCadastroUsuario,
  },
  {
    path: '/MenuEmpresa',
    name: 'MenuEmpresa',
    component: MenuEmpresa,
  },
  {
    path: '/MenuCliente',
    name: 'MenuCliente',
    component: MenuCliente,
  },
  {
    path: '/MinhasCotacoesCliente',
    name: 'MinhasCotacoesCliente',
    component: MinhasCotacoesCliente,
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
    path: '/PerfilUsuarioCliente',
    name: 'PerfilUsuarioCliente',
    component: PerfilUsuarioCliente,
  },
  {
    path: '/OfertaProduto',
    name: 'OfertaProduto',
    component: OfertaProduto,
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
