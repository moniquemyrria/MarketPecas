<template>
  <div id="app">
    <va-appbar-menu-emp />
    <v-app>
      <v-container style="float: right; width: 165vh; margin-top: 10vh">
        <v-row justify="center">
          <v-col cols="12" md="12">
            <v-card>
              <v-card-title style="background: #0277BD;">
                <h4>
                  <span class="spanTitulo">DADOS DA SUA |</span>
                  <b class="bTitulo">EMPRESA</b>&nbsp;
                </h4>
              </v-card-title>
              <v-card-text>
                  teste
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-app>
  </div>
</template>

<script>
import axios from "../axios/client";
import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.css";
import VANaviBarMenuEmp from "@/components/MenuEmpresa";
import App from "../App.vue";
import { mask } from "vue-the-mask";

export default {
  name: "nome",
  vuetify: new Vuetify(),
  vue: new Vue(),
  data() {
    return {
        
    };
  },

  components: {
    "va-appbar-menu-emp": VANaviBarMenuEmp
  }
};
</script>

<style>
.spanTitulo{
  color: white; 
  font-family: 'Roboto-normal',sans-serif;
  font-size: 15px;
}

.bTitulo{
  color: white; 
  font-family: 'Roboto-bold', sans-serif;  
  font-weight:bold; font-size: 20px;

}
</style>