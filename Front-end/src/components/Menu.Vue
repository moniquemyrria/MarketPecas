<template>
  <div id="app">
    <v-app id="inspire">
      <v-navigation-drawer absolute permanent left>
        <template v-slot:prepend>
          <v-list-item two-line>
            <!-- <v-list-item-avatar>
              <img src="https://randomuser.me/api/portraits/women/81.jpg" />
            </v-list-item-avatar> -->

            <v-list-item-content>
              <v-list-item-title>MARKET PEÇAS</v-list-item-title>
              <v-list-item-subtitle>Bem vindo (a) a sua Marketplace de Peças</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </template>

        <v-divider></v-divider>

        <v-list dense>
          <v-list-item v-for="item in items" :key="item.title" @click>
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
      <div>
        <v-card color="grey lighten-4" flat height="200px" tile>
          <v-toolbar prominent dense>
            <v-app-bar-nav-icon></v-app-bar-nav-icon>

            <v-toolbar-title>Title</v-toolbar-title>

            <div class="flex-grow-1"></div>

            <v-btn icon>
              <v-icon>mdi-magnify</v-icon>
            </v-btn>

            <v-btn icon>
              <v-icon>mdi-heart</v-icon>
            </v-btn>

            <v-btn icon>
              <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
          </v-toolbar>
        </v-card>
      </div>
    </v-app>

    <router-view />
  </div>
</template>

<script>
import Vue from "vue";
import Vuetify from "vuetify";
import 'vuetify/dist/vuetify.css';
Vue.component('reverse', {
  // ...
  //template: '<p v-html="reverseMessage(msgreverse)"></p>'  // DON'T DO THIS
  template: '<p>{{reverseMessageg(msgreverse)}}</p>'
})
export default {
  name: "Menu",
  vuetify: new Vuetify(),
  vue: new Vue(),
  data() {
    return {
      items: [
        { title: "Perfil do Usuário", icon: "mdi-account-group-outline" },
        { title: "Dados da Empresa", icon: "mdi-account" },
        { title: "Produtos", icon: "mdi-account-group-outline" },
        { title: "Ofertas de Produtos", icon: "mdi-account-group-outline" }
      ]
    };
  }
};
</script>


<style scoped>
</style>
