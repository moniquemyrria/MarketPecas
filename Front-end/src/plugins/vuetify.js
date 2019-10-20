import Vue from 'vue'
import Vuetify from 'vuetify/lib'

Vue.use(Vuetify)

export default new Vuetify({
  theme: {
    themes: {
      light: {
        primary: 'purple',
        secondary: '#FAFAFA',
        tertiary: '#495057',
        accent: '#82B1FF',
        error: '#FF6060',
        info: '#2A73C5',
        success: '#5AB55E',
        warning: '#FB9514',
      },
    },
  },
  icons: {
    iconfont: 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4',
  },

})
