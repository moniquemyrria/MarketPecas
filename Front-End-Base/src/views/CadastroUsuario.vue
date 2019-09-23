<template>
  <div id="app">
    <v-app id="inspire">
      <v-row justify="center">
        <v-container class="fill-height" fluid>
          
          <!-- MENSAGEM PERGUNTA TIPO PESSOA -->
          <v-dialog v-model="dialogTipoPessoa" max-width="500px">
            <v-card>
              <v-card-title>
                <span>Ola, Obrigada por acessar o Marketpeças</span>

                <div class="flex-grow-1" />
              </v-card-title>
              <v-card-text>
                <br>
                <span>
                  <b>Deseja realizar o cadastro para ...</b>
                </span>
                <br />
           
                
              </v-card-text>
              <v-card-actions>
                <v-col cols="9" sm="12">
                  <v-row class="d-flex justify-sm-center">
                    <v-btn color="error" @click="acessaModalEmpresa()">MINHA EMPRESA</v-btn>
                    <v-btn color="primary"  @click="acessaModalCliente()"> UM NOVO CLIENTE</v-btn>
                  </v-row>
                </v-col>
              </v-card-actions>
              
            </v-card>
          </v-dialog>

          <!-- CADASTRO USUARIO - EMPRESA -->
          <v-dialog v-model="dialogCadEmp" max-width="150vh" persistent>
            <v-card>
              <v-toolbar dark color="primary">
                <v-btn icon dark @click="dialogCadEmp= false">
                  <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>
                  <span class="headline">Informe seus dados para realizar o cadastro</span>
                </v-toolbar-title>
                <div class="flex-grow-1" />
                <v-toolbar-items>
                  <div class="ma-3">
                    <v-btn large color="error" @click="close">CANCELAR</v-btn>
                  </div>
                  <div class="ma-3">
                    <v-btn style="margin-left: -10px;" large color="success" @click="salvar">SALVAR</v-btn>
                  </div>
                </v-toolbar-items>
              </v-toolbar>
              <v-card-title />

              <v-stepper v-model="e1">
                <v-stepper-header>
                  <v-stepper-step :complete="e1 > 1" step="1">Dados para Acesso</v-stepper-step>

                  <v-divider></v-divider>

                  <v-stepper-step :complete="e1 > 2" step="2">Dados da Empresa</v-stepper-step>

                  <v-divider></v-divider>
                </v-stepper-header>

                <v-stepper-items>
                  <v-stepper-content step="1">
                    <v-row>
                      <v-col cols="9" sm="12" style>
                        <v-text-field
                          v-model="search"
                          style="margin-top: 50px; "
                          append-icon="search"
                          label="Nome Completo"
                          class="mx-4"
                        />
                      </v-col>
                    </v-row>
                    <v-btn color="primary" @click="e1 = 2">Continue</v-btn>

                    <v-btn text>Cancel</v-btn>
                  </v-stepper-content>

                  <v-stepper-content step="2">
                    <v-card class="mb-12" color="grey lighten-1" height="200px"></v-card>

                    <v-btn color="primary" @click="e1 = 3">Continue</v-btn>

                    <v-btn text>Cancel</v-btn>
                  </v-stepper-content>
                </v-stepper-items>
              </v-stepper>
            </v-card>
          </v-dialog>

          <!-- CADASTRO USUARIO - CLIENTE -->
          <v-dialog v-model="dialogCadCli" max-width="150vh" persistent>
            <v-card>
              <v-toolbar dark color="primary">
                <v-btn icon dark @click="dialogCadCli = false">
                  <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>
                  <span class="headline">Informe seus dados para realizar o cadastro</span>
                </v-toolbar-title>
                <div class="flex-grow-1" />
                <v-toolbar-items>
                  <div class="ma-3">
                    <v-btn large color="error" @click="close">CANCELAR</v-btn>
                  </div>
                  <div class="ma-3">
                    <v-btn style="margin-left: -10px;" large color="success" @click="salvar">SALVAR</v-btn>
                  </div>
                </v-toolbar-items>
              </v-toolbar>
              <v-card-title />

              <v-card-text style="margin-top: -5vh;">
                <v-container></v-container>
              </v-card-text>
            </v-card>
          </v-dialog>

          <!-- LOGIN / NOVO USUARIO -->
          <v-row justify="center">
            <v-col cols="12" md="8">
              <material-card
                color="primary"
                title="Ja sou Usuário do MarketPeças"
                text="Olá, seja bem vindo (a) mais uma vez."
              >
                <v-form>
                  <v-container class="py-0">
                    <v-row>
                      <v-col xl="9" sm="12">
                        <v-row class="d-flex justify-sm-center">
                          <v-col xl="9" sm="6">
                            <v-text-field label="E-mail de acesso" outlined></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row style="margin-top: -5vh;" class="d-flex justify-sm-center">
                          <v-col xl="9" sm="6">
                            <v-text-field label="Senha de acesso" outlined></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row style="margin-top: -7vh; " class="d-flex justify-md-end">
                          <v-col xl="9" sm="6">
                            <a style="margin-left: 7vh;" href>Esqueci minha senha</a>
                          </v-col>
                        </v-row>
                        <v-row style="margin-top: -5vh;">
                          <v-col xl="9" sm="12" class="d-flex justify-sm-center">
                            <v-btn large min-width="60vh" class="mt-12" color="primary">Acessar</v-btn>
                          </v-col>
                        </v-row>
                      </v-col>
                    </v-row>
                    <!-- <v-row>
                <v-col cols="12" class="text-right">
                  <v-btn color="primary">Acessar</v-btn>
                </v-col>
                    </v-row>-->
                  </v-container>
                </v-form>
              </material-card>
            </v-col>
            <v-col cols="12" md="4">
              <material-card class="v-card-profile">
                <v-avatar slot="offset" class="mx-auto d-block elevation-6" size="130">
                  <img src="@/assets/USER.png" />
                </v-avatar>

                <v-card-text class="text-center">
                  <h6 class="overline mb-3">Seja bem vindo (a) ao MarketPeças</h6>

                  <h2 class="font-weight-light">
                    <b style="color: #1867C0">Ainda não sou um usuário MarketPeças</b>
                  </h2>
                  <br />
                  <p
                    class="font-weight-light"
                  >Para realizar as cotações de peças em nosso site é preciso realizar um cadastro. Através dele você ficará por dentro das novidades, ofertas e promoções.</p>

                  <v-btn @click="dialogTipoPessoa = true" color="primary">QUERO ME CADASTRAR</v-btn>
                </v-card-text>
              </material-card>
            </v-col>
          </v-row>
        </v-container>
      </v-row>
    </v-app>
  </div>
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
      dialogCadCli: false,
      dialogCadEmp: false,
      dialogTipoPessoa: false,
      e1: 0
    };
  },


  // computed: {
  //   formTitle() {
  //     return this.produto.id == ""
  //       ? "Cadastro de Produtos"
  //       : "Editando um Item";
  //   }
  // },

  methods: {
    close() {
      this.dialog = false;
    },

    salvar() {},

    acessaModalEmpresa(){
      this.dialogTipoPessoa = false;
      this.dialogCadEmp = true;
    },

    acessaModalCliente(){
      this.dialogTipoPessoa = false;
      this.dialogCadCli = true;
    },
  }

  
};
</script>
