<template>
  <v-container class="fill-height" fluid>
    <v-row justify="center">
      <v-col cols="12" md="8">
        <material-card color="primary" title="Dados do Usuário" text="Olá :) ...Bem-vindo (a)" />
        <v-card>
          <v-row>
            <v-col cols="9" sm="7" style="margin-top: -3vh;">
              <v-col cols="9" sm="12">
                <v-text-field
                  v-model="usuario.email"
                  label="E-mail *"
                  prepend-icon="email"
                  :counter="50"
                  required
                />
              </v-col>
            </v-col>
          </v-row>
          <v-row>
            <v-col  cols="9" sm="7" style="margin-top: -3vh;" >
              <v-col cols="9" sm="12">
                <v-text-field
                  v-model="usuario.nome"
                  label="Nome *"
                  prepend-icon="face"
                  :counter="20"
                  required
                />
              </v-col>
            </v-col>
          </v-row>
          <v-row>
            <v-col  cols="9" sm="7" style="margin-top: -3vh;" >
              <v-col cols="9" sm="12">
                <v-text-field
                  v-model="usuario.sobrenome"
                  label="Sobrenome *"
                  prepend-icon="sentiment_satisfied_alt"
                  :counter="20"
                  required
                />
              </v-col>
            </v-col>
          </v-row>
          <v-row>
            <v-col  cols="9" sm="7" style="margin-top: -3vh;" >
              <v-col cols="9" sm="12">
                <v-text-field
                  v-model="usuario.senha"
                  label="Senha *"
                  prepend-icon="vpn_key"
                  :counter="20"
                  required
                />
              </v-col>
            </v-col>
          </v-row>
          <v-row>
            <v-col  cols="9" sm="7" style="margin-top: -3vh;" >
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
    carregarTela() {
      axios
        .get("/pesquisaUsuarioId/" + 2)
        .then(response => {
          this.usuario = response.data[0];

          console.log(this.usuario);
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