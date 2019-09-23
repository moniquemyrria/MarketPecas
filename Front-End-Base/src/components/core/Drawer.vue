<template>
  <v-navigation-drawer
    id="app-drawer"
    v-model="inputValue"
    :src="image"
    app
    color="grey darken-2"
    dark
    floating
    mobile-break-point="991"
    persistent
    :width="width"
  >
    <template v-slot:img="attrs">
      <v-img v-bind="attrs" gradient="to top, rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)" />
    </template>

    <v-list-item two-line>
      <v-list-item-avatar color="white">
        <!-- <v-img
          src="https://cdn.vuetifyjs.com/images/logos/v.png"
          height="34"
          contain
        />-->
      </v-list-item-avatar>

      <v-list-item-title class="title">MARKET PEÇAS</v-list-item-title>
    </v-list-item>

    <v-divider class="mx-3 mb-3" />

    <v-list nav>
      <!-- Bug in Vuetify for first child of v-list not receiving proper border-radius -->
      <div />

      <v-list-item
        v-for="(link, i) in links"
        :key="i"
        :to="link.to"
        active-class="primary white--text"
      >
        <v-list-item-action>
          <v-icon>{{ link.icon }}</v-icon>
        </v-list-item-action>

        <v-list-item-title v-text="link.text" @click="carregar(link.id)"/>
      </v-list-item>
    </v-list>

    <template v-slot:append>
      <v-list nav>
        <!-- <v-list-item
          to="/upgrade"
        >
          <v-list-item-action>
            <v-icon>mdi-package-up</v-icon>
          </v-list-item-action>

          <v-list-item-title class="font-weight-light">

          </v-list-item-title>
        </v-list-item>-->
      </v-list>
    </template>
  </v-navigation-drawer>
</template>

<script>
// Utilities
import { mapMutations, mapState } from "vuex";

export default {
  props: {
    opened: {
      type: Boolean,
      default: false
    }
  },
  data: () => ({
    width: 260,
    links: [
      {
        to: '/',
        icon: 'mdi-view-dashboard',
        text: 'Dashboard'
      },

      {
        to: "/perfil-usuario",
        icon: "mdi-account",
        text: "Perfil do Usuário",
        id: 1,
      },
      {
        to: "/cadastro-empresa",
        icon: "mdi-clipboard-outline",
        text: "Dados da Empresa",
        id: 2
      },
      {
        to: "/cadastro-produto",
        icon: "mdi-chart-bubble",
        text: "Produtos",
        id: 3,
      },
      {
        to: "/oferta-produto",
        icon: "mdi-view-dashboard",
        text: "Oferta de Produtos",
        id: 4
      },
      // {
      //   to: "/cadastro-usuario",
      //   icon: "mdi-view-dashboard",
      //   text: "Cadastro de Usuario",
      //   id: 5
      // }


      // {
      //   to: '/icons',
      //   icon: 'mdi-chart-bubble',
      //   text: 'Icons'
      // },
      // {
      //   to: '/maps',
      //   icon: 'mdi-map-marker',
      //   text: 'Maps'
      // },
      // {
      //   to: '/notifications',
      //   icon: 'mdi-bell',
      //   text: 'Notifications'
      // }
    ]
  }),

  computed: {
    ...mapState("app", ["image", "color"]),
    inputValue: {
      get() {
        return this.$store.state.app.drawer;
      },
      set(val) {
        this.setDrawer(val);
      }
    }
  },

  methods: {
    ...mapMutations("app", ["setDrawer", "toggleDrawer"]),

    carregar(id) {
      if (id == 5){
        this.width = 0; 
      }
      console.log(id)
    }
  },

  created: function() {
    this.carregar(5);
  }
};
</script>
