<template>
  <div>
    <v-app>
      <v-footer app color="grey lighten-2" padless>
        
        <v-row justify="center" no-gutters>
          <v-btn v-for="link in links" :key="link" color="#6D6D6D" text class="my-1">{{ link }}</v-btn>
          <v-col class="grey lighten-1 py-1 text-center" style="color: #6D6D6D" cols="12">
            {{ new Date().getFullYear() }} |
            <strong>MarketPeças</strong>
          </v-col>
        </v-row>
      </v-footer>
    </v-app>
  </div>
</template>

<script>
import axios from "../axios/client";
import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.css";

export default {
  name: "va-footer",
  vuetify: new Vuetify(),
  vue: new Vue(),
  data() {
    return {
      links: [
        "Site MarcketPeças",
        "Sobre o MarketPeças",
        "Desenvolvedoras",
        "Facebook",
        "Contato"
      ]
    };
  }
};
</script>


<style scoped>
.something {
  color: var(--v-primary-base);
  background-color: var(--v-accent-lighten2);
}
</style>
