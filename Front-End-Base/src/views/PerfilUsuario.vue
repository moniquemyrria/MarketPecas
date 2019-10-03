<template>
  <v-container class="fill-height" fluid>
    <!-- MENSAGENS -->
    <div class="text-center ma-2">
      <v-snackbar
        v-model="snackbar"
        :bottom="bottom"
        :color="color"
        :left="left"
        :right="right"
        :top="top"
        :timeout="timeout"
        dark
      >
        <v-icon color="white" class="mr-3">mdi-bell-plus</v-icon>
        <div>
          <b>{{ text }}</b>
        </div>
        
      </v-snackbar>
    </div>
    <v-row justify="center">
      <v-col cols="12" md="12">
        <material-card
          color="primary"
          title="Meus Dados"
          text="Olá :) ...Seja Bem-vindo (a) ao MarketPeças"
        />

        <v-card>
          <v-row>
            <v-col cols="9" sm="6">
              <v-col cols="12" sm="12">
                <material-card color="info" type="Line" icon="mdi-store" title="Dados Pessois">
                  <h4 class="title font-weight-light">{{ usuario.nome + ' ' + usuario.sobrenome}}</h4>

                  <p class="category d-inline-flex font-weight-light">
                    <v-icon color="grey" small>mdi-email</v-icon>
                    <span class="grey--text">{{ ' ' + usuario.email}}</span>
                    &nbsp;
                  </p>

                  <template v-slot:actions>
                    <span
                      class="caption grey--text font-weight-light"
                    >Obrigada por acessar o MarketPeças</span>
                  </template>
                </material-card>
              </v-col>
            </v-col>
            <v-col cols="9" sm="5" style="margin-left: 10px;">
              Dados para Edição
              <v-row>
                <v-col cols="9" sm="12" style="margin-top: 0vh;">
                  <v-col cols="9" sm="12">
                    <v-text-field
                      v-model="usuario.senha"
                      style="margin-top: 50px; "
                      prepend-icon="vpn_key"
                      label="Senha"
                      placeholder="Informe uma senha para acesso"
                      :counter="20"
                      required
                      :append-icon="show1 ? 'visibility' : 'visibility_off'"
                      :type="show1 ? 'text' : 'password'"
                      name="input-10-1"
                      hint="Até 20 caracteres"
                      @click:append="show1 = !show1"
                    />
                  </v-col>
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="9" sm="12" style="margin-top: -6vh;">
                  <v-col cols="9" sm="12">
                    <v-select
                      v-model="usuario.oferta_app"
                      :items="itemsOferta"
                      label="Deseja receber Notificações de ofertas no aplicativo? *"
                      menu-props="auto"
                      hide-details
                      prepend-icon="assignment_turned_in"
                      required
                    ></v-select>
                  </v-col>
                </v-col>
              </v-row>
              <v-row>
                <v-col cols="9" sm="12" class="d-flex justify-sm-end">
                  <v-toolbar-items>
                    <div class="ma-3">
                      <v-btn
                        style="margin-left: -10px;"
                        large
                        color="success"
                        @click="salvar"
                      >SALVAR ALTERAÇÕES</v-btn>
                    </div>
                  </v-toolbar-items>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from "../axios/cliente";
import Vue from "vue";
import Vuetify from "vuetify";
import App from "../App.vue";
import { mask } from "vue-the-mask";
export default {
  vuetify: new Vuetify(),
  vue: new Vue(),
  data() {
    return {
      show1: false,

      timeout: 9000,
      color: null,
      colors: ["purple", "info", "success", "warning", "error"],
      top: true,
      bottom: false,
      left: false,
      right: false,
      snackbar: false,
      text: "",
      search: "",
      x: null,

      password: "Password",
      itemsOferta: ["SIM", "NÃO"],

      usuario: {
        idUsuario: null,
        idCliente: null,
        email: null,
        senha: null,
        tipo_pessoa: null,
        ativo: null,
        oferta_app: null,
        nome: null,
        sobrenome: null
      }
    };
  },

  methods: {
    snack(...args) {
      this.top = false;
      this.bottom = false;
      this.left = false;
      this.right = false;

      for (const loc of args) {
        this[loc] = true;
      }

      this.color = this.colors;

      this.snackbar = true;
    },
    salvar() {
      axios
        .put("/usuario", this.usuario)
        .then(response => {
          this.text = response.data[0].mensagem;
          this.colors = "blue";
          this.snack("top", "right");
        })
        .catch(e => {
          console.log(e);
        });
    },
    carregarTela() {
      axios
        .get("/pesquisaUsuarioId/" + 12)
        .then(response => {
          this.usuario = response.data[0];

          if (response.data[0].oferta_app == "S") {
            this.usuario.oferta_app = "SIM";
          }
          if (response.data[0].oferta_app == "N") {
            this.usuario.oferta_app = "NÃO";
          }
        })
        .catch(e => {
          console.log(e);
        });
    }
  },

  created: function() {
    this.carregarTela();
  }
};
</script>