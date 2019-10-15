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
    view: 'IndexSite',
  },
  {
    path: '/user-profile',
    name: 'User Profile',
    view: 'UserProfile',
  },
  {
    path: '/principal-profile',
    name: 'Principal',
    view: 'Principal',
  },  
  {
    path: '/perfil-usuario-cliente',
    name: 'Perfil Usuario',
    view: 'PerfilUsuarioCliente',
  },
  {
    path: '/perfil-usuario-empresa',
    name: 'Cadastro da Empresa',
    view: 'PerfilUsuarioEmpresa',
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
    path: '/login-cadastro-usuario',
    name: 'Cadastro de Usuarios e Login',
    view: 'LoginCadastroUsuario',
  },
  {
    path: '/index-site',
    name: 'Tela Princial',
    view: 'IndexSite',
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
