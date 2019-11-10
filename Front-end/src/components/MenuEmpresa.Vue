<template>
  <div>
    <v-app-bar app color="#F5F5F5">
      <v-container mx-auto py-0>
        <v-layout>
          <v-col cols="12" sm="1">
            <v-img 
              :src="require('@/assets/logo.png')"
              class="mr-5"
              contain
              height="100"
              width="100"
              max-width="100"
            />
          </v-col>
          <v-col cols="12" sm="11" style="margin-top: 30px; margin-left: 30px;">
            <v-btn text @click="menuPerfilEmpresa">DADOS DA EMPRESA</v-btn>
            <v-btn text @click="menuProduto">SEUS PRODUTOS</v-btn>
            <v-btn text @click="menuOfertaProduto">OFERTAS DE PRODUTOS</v-btn>
          </v-col>

          <v-col cols="12" sm="1" style="margin-top: 25px;">
            <v-btn @click="sair" text icon color="#0277BD">
              <v-icon>mdi-exit-to-app</v-icon>
            </v-btn>
          </v-col>
        </v-layout>
      </v-container>
    </v-app-bar>
    <router-view />
  </div>
</template>

<script>
import axios from "../axios/client";
import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.css";

export default {
  name: "va-appbar-menu-emp",
  vuetify: new Vuetify(),
  vue: new Vue(),
  data() {
    return {
      items: [
        { title: "Dados da Empresa", icon: "mdi-account" },
        { title: "Produtos", icon: "mdi-account-group-outline" },
        { title: "Ofertas de Produtos", icon: "mdi-account-group-outline" }
      ]
    };
  },

  methods: {
    menuProduto() {
      this.$router.push({ path: "/CadastroProduto" });
    },

    menuPerfilEmpresa() {
      this.$router.push({ path: "/PerfilUsuarioEmpresa" });
    },

    menuOfertaProduto() {
      this.$router.push({ path: "/OfertaProduto" });
    },

    sair() {
      sessionStorage.clear();
      this.$router.push({ path: "/" });;
    },

    login() {
      this.$router.push({ path: "/LoginCadastroUsuario" });
    }
  }
};
</script>


<style scoped>
.something {
  color: var(--v-primary-base);
  background-color: var(--v-accent-lighten2);
}
</style>
