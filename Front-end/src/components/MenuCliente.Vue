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
            <v-btn text @click="menuDadosCliente">MEUS DADOS</v-btn>
            <v-btn text @click="menuPerCotacoes">MINHAS COTAÇÕES</v-btn>
            
          </v-col>

          <v-col cols="12" sm="1" style="margin-top: 25px;">
            <v-btn @click="login" text icon color="#0277BD">
              <v-icon>people</v-icon>
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
  name: "va-appbar-menu-cli",
  vuetify: new Vuetify(),
  vue: new Vue(),
  data() {
    return {
      
    };
  },

  methods: {
    menuDadosCliente() {
      this.$router.push({ path: "/PerfilUsuarioCliente" });
    },

    menuPerCotacoes() {
      //this.$router.push({ path: "/PerfilUsuarioEmpresa" });
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
