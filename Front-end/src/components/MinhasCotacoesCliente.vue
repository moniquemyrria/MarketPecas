<template>
  <div id="app">
    <!-- VISUALIZA IMPRESSÃO -->
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
      <template v-slot:activator="{ on }">
        <v-btn color="purple" dark v-on="on">Open Dialog</v-btn>
      </template>
      <v-card>
        <v-toolbar dark color="grey">
          <v-toolbar-title>MarketPeças - Suas cotações online</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-row style="margin-top: 7px;">
              <v-btn icon dark @click="sairImpressao">
                <v-icon>mdi-clipboard-arrow-left</v-icon>
              </v-btn>
              <v-btn icon dark @click="imprimir">
                <v-icon>mdi-printer</v-icon>
              </v-btn>
            </v-row>
          </v-toolbar-items>
        </v-toolbar>
        <v-list three-line subheader>
          <v-subheader>Lista de Empresas e Produtos da Cotação</v-subheader>
          <v-list-item v-for="(cotacao, index) in cotacaoDados" :key="index">
            <v-list-item-content>
              <v-list-item-title>
                <b>{{'Loja ' + cotacao.nomeFantasia}}</b>
              </v-list-item-title>

              <v-list-item-subtitle>
                <v-row>
                  <v-col cols="6" sm="4">
                    <b>DESCRIÇÃO DO PRODUTO</b>
                  </v-col>
                  <v-col cols="6" sm="4">
                    <b>QUANTIDADE</b>
                  </v-col>
                  <v-col cols="6" sm="4">
                    <b>VALOR (R$)</b>
                  </v-col>
                </v-row>
              </v-list-item-subtitle>
              <v-list-item-subtitle v-for="(cotacaoItem, index2) in cotacao.itens" :key="index2">
                <v-row>
                  <v-col cols="6" sm="4">{{ cotacaoItem.descricao }}</v-col>
                  <v-col cols="6" sm="4">{{ cotacaoItem.quantidade }}</v-col>
                  <v-col
                    cols="6"
                    sm="4"
                  >{{ cotacaoItem.valorProduto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }) }}</v-col>
                </v-row>
              </v-list-item-subtitle>
              <v-list-item-subtitle>
                <v-row>
                  <v-col cols="6" sm="12">
                    <b>{{'VALOR TOTAL (R$): ' + cotacao.valorCotacao}}</b>
                  </v-col>
                </v-row>
              </v-list-item-subtitle>

              <v-divider></v-divider>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-card>
    </v-dialog>

    <va-appbar-menu-cli />
    <v-app>
      <v-container style="float: right; width: 165vh; margin-top: 10vh">
        <v-row justify="center">
          <v-col cols="12" md="12">
            <v-card>
              <v-card-title style="background: #0277BD;">
                <h4>
                  <span class="spanTitulo">MINHAS |</span>
                  <b class="bTitulo">COTAÇÕES</b>&nbsp;
                </h4>
              </v-card-title>
              <v-card-text>
                <v-data-table
                  :headers="headers"
                  :items="cotacoes"
                  class="elevation-1"
                  hide-default-footer
                  :page.sync="page"
                  :items-per-page="itemsPerPage"
                  @page-count="pageCount = $event"
                  color:black
                >
                  <template v-slot:item.action="{ item }">
                    <v-btn fab x-small outlined dark color="purple">
                      <v-icon @click="print(item.id)">assignment</v-icon>
                    </v-btn>
                  </template>
                </v-data-table>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-app>
    <va-footer />
  </div>
</template>

<script>
import axios from "../axios/client";
import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.css";
import VANaviBarMenuCli from "@/components/MenuCliente";
import VAFooter from "@/components/Footer";
import App from "../App.vue";
import { mask } from "vue-the-mask";

export default {
  name: "nome",
  vuetify: new Vuetify(),
  vue: new Vue(),
  data() {
    return {
      dialog: false,
      itemsPerPage: 5,
      page: 1,
      pageCount: 0,
      cotacoes: [],
      cotacaoDados: [],
      usuario: {
        id: null,
        email: null,
        senha: null,
        idCliente: null,
        nome: null,
        sobrenome: null
      },
      headers: [
        { text: "Id", value: "id", sortable: true },
        { text: "Dados da Cotação", value: "dadosCotacao", sortable: true },
        { text: "Data Cotação", value: "data", sortable: true },
        { text: "Ação", value: "action", sortable: false }
      ]
    };
  },

  components: {
    "va-appbar-menu-cli": VANaviBarMenuCli,
    "va-footer": VAFooter
  },

  methods: {
    sairImpressao() {
      this.dialog = false;
    },
    imprimir() {
      window.print();
      this.dialog = false;
      this.cotacaoDados = [];
    },
    print(id) {
      axios
        .get("/imprimircotacao/" + id)
        .then(response => {
          this.cotacaoDados = response.data;
          console.log(this.cotacoesImpresao);
        })
        .catch(e => {
          console.log(e);
        });
      this.dialog = true;
    },
    carregaCotacoesCliente() {
      this.usuario = JSON.parse(sessionStorage.getItem("usuario"));
      console.log(this.usuario);
      axios
        .get("/listagemCotacaocliente/" + this.usuario[0].idCliente)
        .then(response => {
          //if (response.data > 0) {
          this.cotacoes = response.data;
          //}
        })
        .catch(e => {
          console.log(e);
        });
    }
  },

  created() {
    this.carregaCotacoesCliente();
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