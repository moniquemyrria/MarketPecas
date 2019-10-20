import Vue from 'vue'
import App from './App.vue'
import IndexSitePrincipal from './views/IndexSite.vue'
import router from './router'
import store from './store'
import './plugins'
import vuetify from '@/plugins/vuetify'
import colors from 'vuetify/lib/util/colors'
import { sync } from 'vuex-router-sync'
import Vuetify from 'vuetify'
import "../node_modules/vuetify/dist/vuetify.min.css";


Vue.use(Vuetify);
Vue.use(colors);


sync(store, router)

Vue.config.productionTip = false

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App),
}).$mount('#app')

// new Vue({
//   router,
//   store,
//   vuetify,
//   render: h => h(IndexSitePrincipal),
// }).$mount('#indexsite')

