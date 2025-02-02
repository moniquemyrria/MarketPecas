/**
 * Define all of your application routes here
 * for more information on routes, see the
 * official documentation https://router.vuejs.org/en/
 */
export default [
  {
    path: '',
    // Relative to /src/views
    // view: 'Dashboard'
    view: 'PerfilUsuario',
  },
  {
    path: '/user-profile',
    name: 'User Profile',
    view: 'UserProfile',
  },
  {
    path: '/perfil-usuario',
    name: 'Perfil Usuario',
    view: 'PerfilUsuario',
  },
  {
    path: '/cadastro-empresa',
    name: 'Cadastro da Empresa',
    view: 'CadastroEmpresa',
  },
  {
    path: '/cadastro-produto',
    name: 'Cadastro de Produto',
    view: 'CadastroProduto',
  },
  {
    path: '/oferta-produto',
    name: 'Cadastro de Oferta de Produtos',
    view: 'CadastroOfertaProduto',
  },
  {
    path: '/table-list',
    name: 'Table List',
    view: 'TableList',
  },
  {
    path: '/typography',
    view: 'Typography',
  },
  {
    path: '/icons',
    view: 'Icons',
  },
  {
    path: '/maps',
    view: 'Maps',
  },
  {
    path: '/notifications',
    view: 'Notifications',
  },
  {
    path: '/upgrade',
    name: 'Upgrade to PRO',
    view: 'Upgrade',
  },
]
