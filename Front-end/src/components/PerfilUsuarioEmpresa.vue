<template>
  <div id="app">
    <va-appbar-menu-emp />
    <v-app>
      <v-container style="float: right; width: 165vh; margin-top: 10vh">
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
            <v-card>
              <v-card-title style="background: #0277BD;">
                <h4>
                  <span class="spanTitulo">DADOS DA SUA |</span>
                  <b class="bTitulo">EMPRESA</b>&nbsp;
                </h4>
              </v-card-title>
              <v-card-text>
                <v-row>
                  <v-col cols="9" sm="12">
                    <h4
                      class="title font-weight-light"
                    ><b>CNPJ: </b>{{usuario.cnpj}} 
                    |
                    <b>RAZÃO SOCIAL: </b>{{ usuario.razao_social }}
                    </h4>
                  </v-col>
                </v-row>
                <v-row style="margin-left: 0px;">
                  <b>{{ usuario.nome_fantasia}}</b>
                </v-row>
                <v-row style="margin-left: 0px;">
                  <p class="category d-inline-flex font-weight-light">
                    <span class="grey--text">{{ usuario.email}}</span>
                    &nbsp;
                  </p>
                </v-row>
                <v-row>
                  <v-divider></v-divider>
                </v-row>
                <v-row>
                  <v-col cols="9" sm="6" style>
                    <v-row class="d-flex justify-sm-right" style="margin-top: -5vh;">
                      <v-col cols="9" sm="10" style="margin-top: -3vh;">
                        <v-text-field
                          v-model="usuario.senha"
                          style="margin-top: 50px; "
                          prepend-icon="vpn_key"
                          label="Se desejar edite a sua Senha"
                          class="mx-4"
                          placeholder="Informe uma senha para acesso"
                          :counter="20"
                          required
                          :append-icon="show1 ? 'visibility' : 'visibility_off'"
                          :type="show1 ? 'text' : 'password'"
                          name="input-10-1"
                          hint="At least 8 characters"
                          @click:append="show1 = !show1"
                        />
                      </v-col>
                    </v-row>
                    <v-row class="d-flex justify-sm-right">
                      <v-col cols="9" sm="10" style="margin-top: -3vh; margin-left: 32px">
                        <v-checkbox
                          v-model="usuario.cobre_oferta_praca"
                          :label="`Cobre Oferta da Praça? *`"
                        ></v-checkbox>
                      </v-col>
                    </v-row>
                    <v-row class="d-flex justify-sm-center">
                      <v-col cols="9" sm="10" style="margin-left: -15vh; margin-top: 0vh">
                        <span>Categorias de sua Loja:</span>
                      </v-col>
                    </v-row>
                    <v-row style="margin-left: 20px;">
                      <v-col cols="9" sm="4" style="margin-top: -4vh;">
                        <v-checkbox v-model="usuario.loja_linha_leve" :label="`Linha Leve`"></v-checkbox>
                      </v-col>
                      <v-col cols="9" sm="5" style="margin-top: -4vh;">
                        <v-checkbox v-model="usuario.loja_linha_pesada" :label="`Linha Pesada`"></v-checkbox>
                      </v-col>
                    </v-row>
                    <v-row class="d-flex justify-sm-center" style="margin-top: 25px;">
                      <v-col cols="9" sm="10" style="margin-left: -15vh; margin-top: -2vh">
                        <span>Escolha as forma de pagamentos aceitos pela sua Loja:</span>
                      </v-col>
                    </v-row>
                    <v-row style="margin-left: 20px;">
                      <v-col cols="9" sm="3" style="margin-top: -4vh;">
                        <v-checkbox v-model="usuario.forma_pgto_dinheiro" :label="`Dinheiro`"></v-checkbox>
                      </v-col>
                    </v-row>
                    <v-row style="margin-left: 20px;">
                      <v-col cols="9" sm="3" style="margin-top: -4vh;">
                        <v-checkbox v-model="usuario.forma_pgto_boleto" :label="`Boleto`"></v-checkbox>
                      </v-col>
                    </v-row>
                    <v-row style="margin-left: 20px;">
                      <v-col cols="9" sm="5" style="margin-top: -4vh;">
                        <v-checkbox
                          v-model="usuario.forma_pgto_cartao_debito"
                          :label="`Cartão de Débito`"
                        ></v-checkbox>
                      </v-col>
                    </v-row>
                    <v-row style="margin-left: 20px;">
                      <v-col cols="9" sm="5" style="margin-top: -5vh;">
                        <v-checkbox
                          v-model="usuario.forma_pgto_cartao_credito"
                          :label="`Cartão de Crédito`"
                        ></v-checkbox>
                      </v-col>
                    </v-row>
                    <v-row style="margin-left: 20px;">
                      <v-col cols="9" sm="5" style="margin-top: -5vh;">
                        <v-checkbox
                          v-model="usuario.forma_pgto_crediario_proprio"
                          :label="`Crediário Próprio`"
                        ></v-checkbox>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="9" sm="12" style="margin-top: -2vh">
                        <v-col cols="9" sm="12">
                          <v-textarea
                            v-model="usuario.observacao"
                            name="input-7-1"
                            label="Observações de sua Loja"
                            hint
                            prepend-icon="notes"
                            :counter="300"
                            required
                            placeholder="Descreva aqui alguma observação da sua loja que vc gostaria de referenciar para que o cliente visualize na tela de Contação."
                          />
                        </v-col>
                      </v-col>
                    </v-row>
                  </v-col>
                  <v-divider vertical></v-divider>
                  <v-col cols="9" sm="6" style="margin-left: -3px">
                    Dados para Contatos
                    <v-row class="d-flex justify-sm-center">
                      <v-col cols="9" sm="10" style="margin-top: -5vh;">
                        <v-text-field
                          v-model="usuario.telefone"
                          style="margin-top: 50px; "
                          prepend-icon="phone"
                          label="Telefone"
                          class="mx-4"
                          placeholder="Informe o telefone"
                          :counter="14"
                          required
                          v-mask="maskTel"
                        />
                      </v-col>
                    </v-row>
                    <v-row class="d-flex justify-sm-center">
                      <v-col cols="9" sm="10" style="margin-top: -5vh;">
                        <v-text-field
                          v-model="usuario.whatsapp"
                          style="margin-top: 50px; "
                          prepend-icon="phone"
                          label="What's App"
                          class="mx-4"
                          placeholder="Informe o What's App"
                          :counter="14"
                          required
                          v-mask="maskCel"
                        />
                      </v-col>
                    </v-row>
                    <v-row class="d-flex justify-sm-center">
                      <v-col cols="9" sm="10" style="margin-top: -5vh;">
                        <v-text-field
                          v-model="usuario.facebook"
                          style="margin-top: 50px; "
                          prepend-icon="public"
                          label="Endereço Facebook"
                          class="mx-4"
                          placeholder="Informe o endereço do Facebook"
                          :counter="50"
                          required
                        />
                      </v-col>
                    </v-row>Dados do Endereço
                    <v-row class="d-flex justify-sm-left">
                      <v-col cols="9" sm="5" style="margin-top: -5vh; margin-left: 45px;">
                        <v-text-field
                          v-model="usuario.cep"
                          style="margin-top: 50px; "
                          prepend-icon="location_city"
                          label="CEP *"
                          class="mx-4"
                          placeholder="CEP da Rua"
                          :counter="9"
                          required
                        />
                      </v-col>
                      <v-col cols="9" sm="5" style="margin-top: -5vh;">
                        <v-text-field
                          v-model="usuario.numero"
                          style="margin-top: 50px; "
                          prepend-icon="location_city"
                          label="Número *"
                          class="mx-4"
                          placeholder="Informe o número"
                          :counter="10"
                          required
                        />
                      </v-col>
                    </v-row>
                    <v-row class="d-flex justify-sm-center">
                      <v-col cols="9" sm="10" style="margin-top: -5vh;">
                        <v-text-field
                          v-model="usuario.logradouro"
                          style="margin-top: 50px; "
                          prepend-icon="location_city"
                          label="Logradouro *"
                          class="mx-4"
                          placeholder="Informe o nome da Rua / Avenida"
                          :counter="50"
                          required
                        />
                      </v-col>
                    </v-row>
                    <v-row class="d-flex justify-sm-center">
                      <v-col cols="9" sm="10" style="margin-top: -5vh;">
                        <v-text-field
                          v-model="usuario.bairro"
                          style="margin-top: 50px; "
                          prepend-icon="location_city"
                          label="Bairro"
                          class="mx-4"
                          placeholder="Informe o Bairro *"
                          :counter="30"
                          required
                        />
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="9" sm="12" class="d-flex justify-sm-end">
                        <v-toolbar-items>
                          <div class="ma-3">
                            <v-btn
                              style="margin-left: -10px; margin-top: 50px;"
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

                <template v-slot:actions>
                  <span
                    class="caption grey--text font-weight-light"
                  >Obrigada por acessar o MarketPeças</span>
                </template>
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
import VANaviBarMenuEmp from "@/components/MenuEmpresa";
import VAFooter from "@/components/Footer";
import App from "../App.vue";
import { mask } from "vue-the-mask";

export default {
  name: "perfilUsuarioEmpresa",
  vuetify: new Vuetify(),
  vue: new Vue(),
  directives: {
    mask
  },
  data() {
    return {
      show1: false,
      password: "Password",
      maskTel: "(##)####-####",
      maskCel: "(##)#####-####",

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

      dadosUsuLogado: [],

      usuario: {
        ativo: "",
        bairro: "",
        cep: "",
        cnpj: "",
        cobre_oferta_praca: null,
        email: "",
        facebook: "",
        forma_pgto_boleto: null,
        forma_pgto_cartao_credito: null,
        forma_pgto_cartao_debito: null,
        forma_pgto_crediario_proprio: null,
        forma_pgto_dinheiro: null,
        id_contato: "",
        id_endereco: "",
        id_usuario: "",
        logradouro: "",
        loja_linha_leve: null,
        loja_linha_pesada: null,
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

  components: {
    "va-appbar-menu-emp": VANaviBarMenuEmp,
    "va-footer": VAFooter
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
        .put("/empresa", this.usuario)
        .then(response => {
          this.text = response.data[0].mensagem;
          this.colors = "blue";
          this.snack("top", "right");
        })
        .catch(e => {
          console.log(e);
        });
    },

    tratamentoCheckbox() {
      //oferta praça
      if (this.usuario.cobre_oferta_praca == "S") {
        this.usuario.cobre_oferta_praca = true;
      }
      if (this.usuario.cobre_oferta_praca == "N") {
        this.usuario.cobre_oferta_praca = false;
      }

      //categoria de loja
      if (this.usuario.loja_linha_leve == "S") {
        this.usuario.loja_linha_leve = true;
      }
      if (this.usuario.loja_linha_leve == "N") {
        this.usuario.loja_linha_leve = false;
      }
      if (this.usuario.loja_linha_pesada == "S") {
        this.usuario.loja_linha_pesada = true;
      }
      if (this.usuario.loja_linha_pesada == "N") {
        this.usuario.loja_linha_pesada = false;
      }

      //forma pagamento
      if (this.usuario.forma_pgto_dinheiro == "S") {
        this.usuario.forma_pgto_dinheiro = true;
      }
      if (this.usuario.forma_pgto_dinheiro == "N") {
        this.usuario.forma_pgto_dinheiro = false;
      }

      if (this.usuario.forma_pgto_cartao_credito == "S") {
        this.usuario.forma_pgto_cartao_credito = true;
      }
      if (this.usuario.forma_pgto_cartao_credito == "N") {
        this.usuario.forma_pgto_cartao_credito = false;
      }

      if (this.usuario.forma_pgto_cartao_debito == "S") {
        this.usuario.forma_pgto_cartao_debito = true;
      }
      if (this.usuario.forma_pgto_cartao_debito == "N") {
        this.usuario.forma_pgto_cartao_debito = false;
      }

      if (this.usuario.forma_pgto_crediario_proprio == "S") {
        this.usuario.forma_pgto_crediario_proprio = true;
      }
      if (this.usuario.forma_pgto_crediario_proprio == "N") {
        this.usuario.forma_pgto_crediario_proprio = false;
      }

      if (this.usuario.forma_pgto_boleto == "S") {
        this.usuario.forma_pgto_boleto = true;
      }
      if (this.usuario.forma_pgto_boleto == "N") {
        this.usuario.forma_pgto_boleto = false;
      }
    },

    carregarTela() {
      this.dadosUsuLogado = JSON.parse(sessionStorage.getItem('usuario'));
        console.log(this.dadosUsuLogado)
      axios
        .get("/pesquisaUsuarioEmpresaId/" + this.dadosUsuLogado[0].idUsuario)
        .then(response => {
          this.usuario = response.data[0];
          console.log(this.usuario);

          this.tratamentoCheckbox();
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