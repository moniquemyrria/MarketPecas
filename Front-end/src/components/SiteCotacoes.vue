<template>
  <div id="app">
    <!-- SOBRE O MARKETPEÇAS -->
    <v-dialog v-model="dialogSobreMkt" max-width="500px">
      <v-card class="mx-auto">
        <v-img
          class="white--text align-end"
          height="200px"
          :src="require('@/assets/VENDA-DE-PEAS.jpg')"
        >
          <v-card-title>SOBRE O MARKETPEÇAS</v-card-title>
        </v-img>

        <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

        <v-card-text class="text--primary">
          <div>Whitehaven Beach</div>

          <div>Whitsunday Island, Whitsunday Islands</div>
        </v-card-text>

        <v-card-actions>
          <v-col cols="9" sm="12">
            <v-row style="float: right; ">
              <v-btn color="primary" text @click="dialogSobreMkt = false">VOLTAR</v-btn>
            </v-row>
          </v-col>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- TEAM DEV -->
    <v-dialog v-model="dialogTeamDev" max-width="500px">
      <v-card class="mx-auto">
        <v-img class="white--text align-end" height="200px" :src="require('@/assets/TEAMDEV.jpg')">
          <v-card-title>DESENVOLVEDORAS</v-card-title>
        </v-img>

        <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

        <v-card-text class="text--primary">
          <div>Whitehaven Beach</div>

          <div>Whitsunday Island, Whitsunday Islands</div>
        </v-card-text>

        <v-card-actions>
          <v-col cols="9" sm="12">
            <v-row style="float: right; ">
              <v-btn color="primary" text @click="dialogTeamDev = false">VOLTAR</v-btn>
            </v-row>
          </v-col>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- CONTATO-->
    <v-dialog v-model="dialogContato" max-width="500px">
      <v-card class="mx-auto">
        <v-img class="white--text align-end" height="200px" :src="require('@/assets/CONTATO.jpg')">
          <v-card-title>CONTATOS</v-card-title>
        </v-img>

        <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

        <v-card-text class="text--primary">
          <div>Whitehaven Beach</div>

          <div>Whitsunday Island, Whitsunday Islands</div>
        </v-card-text>

        <v-card-actions>
          <v-col cols="9" sm="12">
            <v-row style="float: right; ">
              <v-btn color="primary" text @click="dialogContato = false">VOLTAR</v-btn>
            </v-row>
          </v-col>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-app>
      <v-app-bar app flat color="#F5F5F5" height="100">
        <v-container mx-auto py-0>
          <v-layout>
            <v-col cols="12" sm="1">
              <v-img
                :src="require('@/assets/logo.png')"
                class="mr-5"
                contain
                height="160"
                width="160"
                max-width="160"
              />
            </v-col>
            <v-col cols="12" sm="8" style="margin-top: 55px; margin-left: 140px;">
              <v-btn @click="sobreMktpecas" color="#6D6D6D" text class="my-1">SOBRE MARKETPEÇAS</v-btn>
              <v-btn @click="teamDev" color="#6D6D6D" text class="my-1">TEAM DEV</v-btn>
              <v-btn @click="contato" color="#6D6D6D" text class="my-1">CONTATO</v-btn>
            </v-col>
            <v-col cols="12" sm="6" style="margin-top: 60px;">
              <v-btn @click="login" text>Entre ou Cadastre-se</v-btn>
            </v-col>
          </v-layout>
        </v-container>
      </v-app-bar>
      <br />

      <v-carousel cycle height="450" hide-delimiter-background :show-arrows="false">
        <v-carousel-item
          v-for="(item,i) in items"
          :key="i"
          :src="item.src"
          reverse-transition="fade-transition"
          transition="fade-transition"
        ></v-carousel-item>
      </v-carousel>
      <v-row color="primary">
        <v-col class="primary lighten-1 py-1 text-end" cols="4" style="height: 65px;">
          <v-col cols="12" style="margin-top: 5px; margin-left: 31px;">
            <span style="color: white;">Busca de produtos por:</span>
          </v-col>
        </v-col>
        <v-col class="primary lighten-1 py-1" cols="8" style="height: 65px;">
          <v-col cols="8" style="margin-top: -7px">
            <v-text-field
              label="Código, descrição, marca ou categoria"
              append-icon="search"
              text
              solo
              flat
            ></v-text-field>
          </v-col>
        </v-col>
      </v-row>
      <v-row style="margin-top: -10px">
        <v-col cols="12" sm="3">
          <v-card flat class="mx-auto" max-width="500">
            <v-list>
              <v-list-item-group color="primary">
                <v-menu offset-x :close-on-content-click="false" transition="scale-transition">
                  <template v-slot:activator="{ on }">
                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>done</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title v-on="on">Teste</v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                  </template>
                  <v-list>
                    <v-list-item v-model="on" @click>
                      <v-list-item-title></v-list-item-title>
                    </v-list-item>
                    <v-list-item>
                      <v-list-item-title>Teste Submenu 2</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>

                <v-list-item>
                  <v-list-item-icon>
                    <v-icon>done</v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title>Teste 2</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>

                <!-- <v-list-item v-for="(item, i) in itemsMenu" :key="i">
                  <v-list-item-icon>
                    <v-icon v-text="item.icon"></v-icon>
                  </v-list-item-icon>
                  <v-list-item-content>
                    <v-list-item-title v-text="item.text"></v-list-item-title>
                  </v-list-item-content>
                </v-list-item>-->
              </v-list-item-group>
            </v-list>
          </v-card>
        </v-col>
        <v-col cols="12" sm="4"></v-col>
        <v-col cols="12" sm="4"></v-col>
      </v-row>
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
  name: "site-cotacoes",
  vuetify: new Vuetify(),
  vue: new Vue(),
  data() {
    return {
      dialogSobreMkt: false,
      dialogTeamDev: false,
      dialogContato: false,
      dialogSubMenu: false,
      itemsMenu: [
        {
          icon: "mdi-inbox",
          text: "Inbox"
        },
        {
          icon: "mdi-star",
          text: "Star"
        },
        {
          icon: "mdi-send",
          text: "Send"
        },
        {
          icon: "mdi-email-open",
          text: "Drafts"
        }
      ],
      model: 1,
      items: [
        {
          src: require("@/assets/SLD1.jpg")
        },
        {
          src: require("@/assets/SLD2.jpg")
        },
        {
          src: require("@/assets/SLD3.jpg")
        }
      ]
    };
  },

  methods: {
    sobreMktpecas() {
      this.dialogSobreMkt = true;
    },

    teamDev() {
      this.dialogTeamDev = true;
    },

    contato() {
      this.dialogContato = true;
    },

    login() {
      this.$router.push({ path: "/LoginCadastroUsuario" });
    }
  }
};
</script>

<style>
.spanTitulo {
  color: white;
  font-family: "Roboto-normal", sans-serif;
  font-size: 15px;
}

.bTitulo {
  color: white;
  font-family: "Roboto-bold", sans-serif;
  font-weight: bold;
  font-size: 20px;
}
</style>