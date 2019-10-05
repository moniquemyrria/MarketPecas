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
          type="Line"
        >
          <v-row>
            <v-col cols="12" sm="12">
              <material-card>
                <v-row>
                  <v-col cols="9" sm="3">
                    <h4 class="title font-weight-light">{{ usuario.razao_social }}</h4><b>{{ usuario.nome_fantasia}}</b>
                    <p class="category d-inline-flex font-weight-light">
                      <span class="grey--text">{{ usuario.email}}</span>
                      &nbsp;
                    </p>
                  </v-col>
                </v-row>

                <v-row>
                  <v-col cols="9" sm="6"></v-col>
                  <v-col cols="9" sm="5" style="margin-left: 10px;"></v-col>
                </v-row>

                <template v-slot:actions>
                  <span
                    class="caption grey--text font-weight-light"
                  >Obrigada por acessar o MarketPeças</span>
                </template>
              </material-card>
            </v-col>
          </v-row>
        </material-card>
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
        ativo: "",
        bairro: "",
        cep: "",
        cnpj: "",
        cobre_oferta_praca: "",
        email: "",
        facebook: "",
        forma_pgto_boleto: "",
        forma_pgto_cartao_credito: "",
        forma_pgto_cartao_debito: "",
        forma_pgto_crediario_proprio: "",
        forma_pgto_dinheiro: "",
        id_contato: "",
        id_endereco: "",
        id_usuario: "",
        logradouro: "",
        loja_linha_leve: "",
        loja_linha_pesada: "",
        nome_fantasia: "",
        numero: "",
        observacao: "",
        razao_social: "",
        senha: "",
        telefone: "",
        tipo_pessoa: "",
        whatsapp: ""
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
        .get("/pesquisaUsuarioEmpresaId/" + 1)
        .then(response => {
          this.usuario = response.data[0];
          console.log(this.usuario);

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