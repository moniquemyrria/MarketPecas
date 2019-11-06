<template>
  <div id="landing-page">
    <v-app id="inspire">
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
            <!-- <v-btn icon @click="snackbar = false">
          <v-icon>mdi-close-circle</v-icon>
            </v-btn>-->
          </v-snackbar>
        </div>
        <!-- MENSAGEM PERGUNTA TIPO PESSOA -->
        <v-dialog v-model="dialogTipoPessoa" max-width="500px">
          <v-card>
            <v-card-title>
              <span>Ola, Obrigada por acessar o Marketpeças</span>

              <div class="flex-grow-1" />
            </v-card-title>
            <v-card-text>
              <br />
              <span>
                <b>Deseja realizar o cadastro para ...</b>
              </span>
              <br />
            </v-card-text>
            <v-card-actions>
              <v-col cols="9" sm="12">
                <v-row class="d-flex justify-sm-center">
                  <v-btn color="error" @click="acessaModalEmpresa()">MINHA EMPRESA</v-btn>
                  <v-btn color="primary" @click="acessaModalCliente()">UM NOVO CLIENTE</v-btn>
                </v-row>
              </v-col>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <!-- CADASTRO USUARIO - EMPRESA -->
        <v-dialog v-model="dialogCadEmp" scrollable max-width="300vh" persistent>
          <v-card>
            <v-toolbar dark color="primary">
              <v-btn icon dark @click="closeDialogEmpresa">
                <v-icon>mdi-close</v-icon>
              </v-btn>
              <v-toolbar-title>
                <span class="headline">Informe seus dados para realizar o cadastro</span>
              </v-toolbar-title>
              <div class="flex-grow-1" />
              <v-toolbar-items>
                <div class="ma-3">
                  <v-btn large color="error" @click="closeDialogEmpresa">CANCELAR</v-btn>
                </div>
                <div class="ma-3">
                  <v-btn
                    style="margin-left: -10px;"
                    large
                    color="success"
                    @click="salvarEmpresa"
                  >SALVAR</v-btn>
                </div>
              </v-toolbar-items>
            </v-toolbar>

            <v-card-text>
              <v-container>
                <v-tabs background-color="white" color="primary" right>
                  <v-tab>DADOS GERAIS *</v-tab>
                  <v-tab>ENDEREÇO E CONTATO</v-tab>

                  <v-tab-item v-for="n in 2" :key="n">
                    <v-card style="height: 85vh;">
                      <v-card-text>
                        <v-container fluid>
                          <v-container v-if="n == 1">
                            <v-row>
                              <v-col cols="9" sm="6">
                                Dados de Acesso e Empresa
                                <v-row style="margin-top: -5vh;">
                                  <v-col
                                    cols="9"
                                    sm="11"
                                    class="d-flex justify-sm-end"
                                    style="margin-top: -3vh; margin-left: -12px;"
                                  >
                                    <v-checkbox
                                      v-model="empresa.checkboxOfertaPraca"
                                      :label="`Cobre Oferta da Praça? *`"
                                    ></v-checkbox>
                                  </v-col>
                                </v-row>
                                <v-row class="d-flex justify-sm-center">
                                  <v-col cols="9" sm="10" style="margin-top: -11vh;">
                                    <v-text-field
                                      v-model="empresa.email"
                                      style="margin-top: 50px; "
                                      prepend-icon="email"
                                      label="E-mail *"
                                      class="mx-4"
                                      placeholder="Informe o seu email para acesso"
                                      :counter="20"
                                      required
                                    />
                                  </v-col>
                                </v-row>
                                <v-row class="d-flex justify-sm-center" style="margin-top: -5vh;">
                                  <v-col cols="9" sm="10" style="margin-top: -3vh;">
                                    <v-text-field
                                      v-model="empresa.senha"
                                      style="margin-top: 50px; "
                                      prepend-icon="vpn_key"
                                      label="Senha"
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
                                <v-divider></v-divider>
                                <v-row class="d-flex justify-sm-center" style="margin-top: -5vh;">
                                  <v-col cols="9" sm="10" style="margin-top: -3vh;">
                                    <v-text-field
                                      v-model="empresa.cnpj"
                                      style="margin-top: 50px; "
                                      prepend-icon="emoji_transportation"
                                      label="C.N.PJ. *"
                                      class="mx-4"
                                      placeholder="Informe o CNPJ de sua empresa"
                                      :counter="18"
                                      required
                                    />
                                  </v-col>
                                </v-row>
                                <v-row class="d-flex justify-sm-center" style="margin-top: -5vh;">
                                  <v-col cols="9" sm="10" style="margin-top: -3vh;">
                                    <v-text-field
                                      v-model="empresa.razaoSocial"
                                      style="margin-top: 50px; "
                                      prepend-icon="emoji_transportation"
                                      label="Razão Social *"
                                      class="mx-4"
                                      placeholder="Informe a Razão Social"
                                      :counter="80"
                                      required
                                    />
                                  </v-col>
                                </v-row>
                                <v-row class="d-flex justify-sm-center" style="margin-top: -5vh;">
                                  <v-col cols="9" sm="10" style="margin-top: -3vh;">
                                    <v-text-field
                                      v-model="empresa.nomeFantasia"
                                      style="margin-top: 50px; "
                                      prepend-icon="emoji_transportation"
                                      label="Nome Fantasia *"
                                      class="mx-4"
                                      placeholder="Informe a Nome Fantasia"
                                      :counter="80"
                                      required
                                    />
                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="9" sm="6">
                                Dados de Recebimentos e Categoria da Loja
                                <v-row class="d-flex justify-sm-center" style="margin-top: 25px;">
                                  <v-col
                                    cols="9"
                                    sm="10"
                                    style="margin-left: -15vh; margin-top: -2vh"
                                  >
                                    <span>Escolha as forma de pagamentos aceitos pela sua Loja:</span>
                                  </v-col>
                                </v-row>
                                <v-row class="d-flex justify-sm-center">
                                  <v-col cols="9" sm="12" style="margin-top: -2vh;">
                                    <v-row style="margin-left: 20px;">
                                      <v-col cols="9" sm="3" style="margin-top: -4vh;">
                                        <v-checkbox
                                          v-model="empresa.checkboxDinheiro"
                                          :label="`Dinheiro`"
                                        ></v-checkbox>
                                      </v-col>
                                      <v-col cols="9" sm="5" style="margin-top: -4vh;">
                                        <v-checkbox
                                          v-model="empresa.checkboxCredito"
                                          :label="`Cartão de Crédito`"
                                        ></v-checkbox>
                                      </v-col>
                                      <v-col cols="9" sm="4" style="margin-top: -4vh;">
                                        <v-checkbox
                                          v-model="empresa.checkboxDebito"
                                          :label="`Cartão de Debito`"
                                        ></v-checkbox>
                                      </v-col>
                                    </v-row>
                                    <v-row style="margin-left: 20px; margin-top: 10px;">
                                      <v-col cols="9" sm="3" style="margin-top: -5vh;">
                                        <v-checkbox
                                          v-model="empresa.checkboxBoleto"
                                          :label="`Boleto`"
                                        ></v-checkbox>
                                      </v-col>
                                      <v-col cols="9" sm="5" style="margin-top: -5vh;">
                                        <v-checkbox
                                          v-model="empresa.checkboxProprio"
                                          :label="`Crediário Próprio`"
                                        ></v-checkbox>
                                      </v-col>
                                    </v-row>
                                    <v-divider></v-divider>
                                    <v-row
                                      class="d-flex justify-sm-center"
                                      style="margin-top: 25px;"
                                    >
                                      <v-col
                                        cols="9"
                                        sm="10"
                                        style="margin-left: -15vh; margin-top: -2vh"
                                      >
                                        <span>Escolha as Categorias de sua Loja:</span>
                                      </v-col>
                                    </v-row>
                                    <v-row style="margin-left: 20px;">
                                      <v-col cols="9" sm="3" style="margin-top: -4vh;">
                                        <v-checkbox
                                          v-model="empresa.checkboxLeve"
                                          :label="`Linha Leve`"
                                        ></v-checkbox>
                                      </v-col>
                                      <v-col cols="9" sm="5" style="margin-top: -4vh;">
                                        <v-checkbox
                                          v-model="empresa.checkboxPesada"
                                          :label="`Linha Pesada`"
                                        ></v-checkbox>
                                      </v-col>
                                    </v-row>
                                    <v-row>
                                      <v-col cols="9" sm="12" style="margin-top: -6vh">
                                        <v-col cols="9" sm="12">
                                          <v-textarea
                                            v-model="empresa.obs"
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
                                </v-row>
                              </v-col>
                            </v-row>
                          </v-container>
                          <v-container v-if="n == 2">
                            <v-row>
                              <v-col cols="9" sm="6">
                                Dados para Contatos
                                <v-row class="d-flex justify-sm-center">
                                  <v-col cols="9" sm="10" style="margin-top: -5vh;">
                                    <v-text-field
                                      v-model="empresa.telefone"
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
                                      v-model="empresa.wapp"
                                      style="margin-top: 50px; "
                                      prepend-icon="phone"
                                      label="What's App"
                                      class="mx-4"
                                      placeholder="Informe o What's App"
                                      :counter="14"
                                      required
                                      v-mask="maskTel"
                                    />
                                  </v-col>
                                </v-row>
                                <v-row class="d-flex justify-sm-center">
                                  <v-col cols="9" sm="10" style="margin-top: -5vh;">
                                    <v-text-field
                                      v-model="empresa.fb"
                                      style="margin-top: 50px; "
                                      prepend-icon="insert_emoticon"
                                      label="Endereço Facebook"
                                      class="mx-4"
                                      placeholder="Informe o endereço do Facebook"
                                      :counter="50"
                                      required
                                    />
                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="9" sm="6">
                                Dados do Endereço
                                <v-row class="d-flex justify-sm-left">
                                  <v-col
                                    cols="9"
                                    sm="5"
                                    style="margin-top: -5vh; margin-left: 45px;"
                                  >
                                    <v-text-field
                                      v-model="empresa.cep"
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
                                      v-model="empresa.num"
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
                                      v-model="empresa.logradouro"
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
                                      v-model="empresa.bairro"
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
                              </v-col>
                            </v-row>
                          </v-container>
                        </v-container>
                      </v-card-text>
                    </v-card>
                  </v-tab-item>
                </v-tabs>
              </v-container>
            </v-card-text>
          </v-card>
        </v-dialog>

        <!-- CADASTRO USUARIO - CLIENTE -->
        <v-dialog v-model="dialogCadCli" max-width="130vh" scrollable persistent>
          <v-card>
            <v-toolbar dark color="primary">
              <v-btn icon dark @click="closeDialogCliente">
                <v-icon>mdi-close</v-icon>
              </v-btn>
              <v-toolbar-title>
                <span class="headline">Informe seus dados para realizar o cadastro</span>
              </v-toolbar-title>
              <div class="flex-grow-1" />
              <v-toolbar-items>
                <div class="ma-3">
                  <v-btn large color="error" @click="closeDialogCliente">CANCELAR</v-btn>
                </div>
                <div class="ma-3">
                  <v-btn
                    style="margin-left: -10px;"
                    large
                    color="success"
                    @click="salvarCliente"
                  >SALVAR</v-btn>
                </div>
              </v-toolbar-items>
            </v-toolbar>

            <v-card-text style="margin-top: -1vh;">
              <v-container>
                <v-row class="d-flex justify-sm-center" style="margin-top: -3vh;">
                  <v-col cols="9" sm="10" style="margin-top: -3vh;">
                    <v-text-field
                      v-model="cliente.nome"
                      style="margin-top: 50px; "
                      prepend-icon="face"
                      label="Nome *"
                      class="mx-4"
                      placeholder="Informe o seu nome"
                      :counter="20"
                      required
                    />
                  </v-col>
                </v-row>

                <v-row class="d-flex justify-sm-center" style="margin-top: -3vh;">
                  <v-col cols="9" sm="10" style="margin-top: -3vh;">
                    <v-text-field
                      v-model="cliente.sobrenome"
                      style="margin-top: 50px; "
                      prepend-icon="sentiment_satisfied_alt"
                      label="Sobrenome *"
                      class="mx-4"
                      placeholder="Informe o seu Sobrenome"
                      :counter="20"
                      required
                    />
                  </v-col>
                </v-row>

                <v-row class="d-flex justify-sm-center" style="margin-top: -3vh;">
                  <v-col cols="9" sm="10" style="margin-top: -3vh;">
                    <v-text-field
                      v-model="cliente.email"
                      style="margin-top: 50px; "
                      prepend-icon="email"
                      label="E-mail *"
                      class="mx-4"
                      placeholder="seuemail@email.com"
                      :counter="50"
                      required
                    />
                  </v-col>
                </v-row>

                <v-row class="d-flex justify-sm-center" style="margin-top: -3vh;">
                  <v-col cols="9" sm="10" style="margin-top: -3vh;">
                    <v-text-field
                      v-model="cliente.emailConfirmacao"
                      style="margin-top: 50px; "
                      prepend-icon="email"
                      label="Confirmação de E-mail *"
                      class="mx-4"
                      placeholder="seuemail@email.com"
                      :counter="50"
                      required
                    />
                  </v-col>
                </v-row>

                <v-row class="d-flex justify-sm-center">
                  <v-col cols="9" sm="10" style="margin-top: -5vh;">
                    <v-text-field
                      v-model="cliente.telefone"
                      style="margin-top: 50px; "
                      prepend-icon="phone"
                      label="Telefone"
                      class="mx-4"
                      placeholder="Informe o nº de seu Celular"
                      :counter="14"
                      required
                      v-mask="maskTel"
                    />
                  </v-col>
                </v-row>

                <v-row class="d-flex justify-sm-center" style="margin-top: -3vh;">
                  <v-col cols="9" sm="10" style="margin-top: -3vh;">
                    <v-text-field
                      v-model="cliente.senha"
                      style="margin-top: 50px; "
                      prepend-icon="vpn_key"
                      label="Senha"
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

                <v-row class="d-flex justify-sm-center" style="margin-top: -3vh;">
                  <v-col cols="9" sm="10">
                    <v-col cols="9" sm="12">
                      <v-select
                        v-model="cliente.notificacao"
                        :items="itemsOferta"
                        label="Deseja receber Notificações de ofertas por e-mail e SMS? *"
                        menu-props="auto"
                        hide-details
                        prepend-icon="assignment_turned_in"
                      ></v-select>
                    </v-col>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
          </v-card>
        </v-dialog>

        <!-- LOGIN / NOVO USUARIO -->
        <v-row>
          <!-- LOGIN -->
          <v-col cols="12" md="7">
            <v-card style="height: 500px">
              <v-card-title style="background: #0277BD; height: 160px">
                <h4>
                  <span class="spanTitulo">JÁ SOU USUÁRIO DO MARKETPEÇAS</span>
                  <br />
                  <b class="bTitulo">Olá :) ... Seja bem-vindo(a) mais uma vez!</b>&nbsp;
                </h4>
              </v-card-title>
              <v-card-text>
                <v-form>
                  <v-container>
                    <v-row>
                      <v-col xl="12" sm="12">
                        <v-row class="d-flex justify-sm-center">
                          <v-col xl="9" sm="6">
                            <v-text-field v-model="usuario.email" label="E-mail de acesso" outlined></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row style="margin-top: -5vh;" class="d-flex justify-sm-center">
                          <v-col xl="9" sm="6">
                            <v-text-field
                              v-model="usuario.senha"
                              label="Senha de acesso"
                              outlined
                              :append-icon="show1 ? 'visibility' : 'visibility_off'"
                              :type="show1 ? 'text' : 'password'"
                              name="input-10-1"
                              @click:append="show1 = !show1"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                        <!-- <v-row style="margin-top: -6vh;">
                          <v-col xl="11" sm="12" class="d-flex justify-md-end">
                            <a style="margin-left: 1vh;" href>Esqueci minha senha</a>
                          </v-col>
                        </v-row>-->
                        <v-row style="margin-top: -5vh;" class="d-flex justify-sm-center">
                          <v-col xl="9" sm="6">
                            <v-btn
                              large
                              min-width="415px"
                              class="mt-12"
                              @click="acessar"
                              color="primary"
                            >Acessar</v-btn>
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
              </v-card-text>
            </v-card>
          </v-col>
          <!-- CAD USUARIOS -->
          <v-col cols="12" md="5">
            <v-card style="height: 500px">
              <v-card-title style="background: #0277BD;">
                <h4>
                  <span class="spanTitulo">QUERO ME</span>
                  <b class="bTitulo">CADASTRAR</b>&nbsp;
                </h4>
                <v-avatar slot="offset" class="mx-auto d-block elevation-6" size="130">
                  <img src="@/assets/USER.png" />
                </v-avatar>
              </v-card-title>
              <br />

              <v-card-text class="text-center">
                <h6 class="overline mb-3">Seja bem vindo (a) ao MarketPeças</h6>

                <h2 class="font-weight-light">
                  <b style="color: #1867C0">Ainda não sou um usuário MarketPeças</b>
                </h2>
                <br />
                <p
                  class="font-weight-light"
                >Para realizar as cotações de peças em nosso site é preciso realizar um cadastro. Através dele você ficará por dentro das novidades, ofertas e promoções.</p>

                <v-btn @click="dialogTipoPessoa = true" color="primary">QUERO UTILIZAR O MARKETPEÇAS</v-btn>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-app>
    <router-view />
    <va-footer />
  </div>
</template>

<script>
import axios from "../axios/client";
import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.css";
import VAFooter from "@/components/Footer";
import { mask } from "vue-the-mask";
Vue.component("reverse", {
  // ...
  //template: '<p v-html="reverseMessage(msgreverse)"></p>'  // DON'T DO THIS
  template: "<p>{{reverseMessageg(msgreverse)}}</p>"
});

export default {
  name: "teste",
  vuetify: new Vuetify(),
  vue: new Vue(),
  components: {
    "va-footer": VAFooter
  },
  directives: {
    mask
  },
  data() {
    return {
      maskTel: "(##)#####-####",
      maskCep: "#####-###",

      color: "#673AB7",
      show1: false,
      show2: true,
      show3: false,
      show4: false,
      password: "Password",

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
      dialogCadCli: false,
      dialogCadEmp: false,
      dialogTipoPessoa: false,
      e1: 0,
      itemsOferta: ["SIM", "NÃO"],

      cliente: {
        nome: "",
        sobrenome: "",
        email: "",
        emailConfirmacao: "",
        senha: "",
        notificacao: null,
        idUsuario: null,
        telefone: null,
        wapp: null,
        fb: null,
        idContato: null
      },

      empresa: {
        email: "",
        senha: "",
        cnpj: "",
        razaoSocial: "",
        nomeFantasia: "",
        obs: "",
        checkboxDinheiro: false,
        checkboxCredito: false,
        checkboxDebito: false,
        checkboxBoleto: false,
        checkboxProprio: false,
        checkboxLeve: false,
        checkboxPesada: false,
        checkboxOfertaPraca: false,
        telefone: "",
        wapp: "",
        fb: "",
        cep: "",
        num: "",
        logradouro: "",
        bairro: "",
        idUsuario: null,
        idEndereco: null,
        idContato: null
      },

      usuario: {
        id: null,
        email: null,
        senha: null
      }
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
    limpaCamposCliente() {
      this.cliente.nome = "";
      this.cliente.sobrenome = "";
      this.cliente.email = "";
      this.cliente.senha = "";
      this.cliente.notificacao = null;
      this.cliente.idUsuario = null;
    },

    limparCamposEmpresa() {
      this.empresa.email = "";
      this.empresa.senha = "";
      this.empresa.cnpj = "";
      this.empresa.razaoSocial = "";
      this.empresa.nomeFantasia = "";
      this.empresa.obs = "";
      this.empresa.checkboxDinheiro = false;
      this.empresa.checkboxCredito = false;
      this.empresa.checkboxDebito = false;
      this.empresa.checkboxBoleto = false;
      this.empresa.checkboxProprio = false;
      this.empresa.checkboxLeve = false;
      this.empresa.checkboxPesada = false;
      this.empresa.checkboxOfertaPraca = false;
      this.empresa.telefone = "";
      this.empresa.wapp = "";
      this.empresa.fb = "";
      this.empresa.cep = "";
      this.empresa.num = "";
      this.empresa.logradouro = "";
      this.empresa.bairro = "";
      this.empresa.idUsuario = null;
      this.empresa.idEndereco = null;
      this.empresa.idContato = null;
    },

    acessar() {
      if (!this.validacaoCamposPreenchidosUsuario()) {
        sessionStorage.clear();
        axios
          .post("/validaUsuario", this.usuario)
          .then(response => {
            if (response.data[0].usuario.length > 0) {
              this.text = response.data[0].mensagem;
              this.colors = "green";
              this.snack("top", "center");

              this.usuario.id = response.data[0].usuario[0].id;

              if (response.data[0].usuario[0].tipo_pessoa == "F") {
                this.acessaMenuCliente();
              } else {
                this.acessaMenuEmpresa();
              }
            } else {
              //sessionStorage.clear();
              this.text = response.data[0].mensagem;
              this.colors = "red";
              this.snack("bottom", "center");
            }
          })
          .catch(e => {
            console.log(e);
          });
      }
    },

    acessaMenuEmpresa() {
      axios
        .get("/validadadosempresa/" + this.usuario.id)
        .then(response => {
          if (response.data[0].empresa.length > 0) {
            sessionStorage.clear();
            sessionStorage.setItem(
              "usuario",
              JSON.stringify(response.data[0].empresa)
            );
            this.$router.push({ path: "/PerfilUsuarioEmpresa" });
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

    acessaMenuCliente() {
      axios
        .get("/validadadoscliente/" + this.usuario.id)
        .then(response => {
          if (response.data[0].cliente.length > 0) {
            sessionStorage.clear();
            sessionStorage.setItem(
              "usuario",
              JSON.stringify(response.data[0].cliente)
            );
            this.$router.push({ path: "/PerfilUsuarioCliente" });
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

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

    msgAlertCamposPreenchidosUsuario() {
      this.colors = "warning";
      this.timeout = 5000;
      this.snack("bottom", "center");
      this.text = "Ops! Informe seu e-email e senha para realizar o login.";
      this.error = true;
    },

    msgAlertCamposPreenchidos() {
      this.colors = "warning";
      this.timeout = 5000;
      this.snack("bottom", "center");
      this.text =
        "Ops! Há campos brigatórios não preenchidos, ou algum dado informado está maior que o permitido para o campo.";
      this.error = true;
    },

    validacaoCamposPreenchidosUsuario() {
      if (
        this.usuario.email == "" ||
        this.usuario.email == null ||
        this.usuario.email.length <= 0
      ) {
        this.msgAlertCamposPreenchidosUsuario();
        return true;
      }

      if (
        this.usuario.senha == "" ||
        this.usuario.senha == null ||
        this.usuario.senha.length <= 0
      ) {
        this.msgAlertCamposPreenchidosUsuario();
        return true;
      }
    },

    validacaoCamposPreenchidosCliente() {
      if (
        this.cliente.nome == "" ||
        (this.cliente.nome.length <= 0 || this.cliente.nome.length > 20)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.cliente.sobrenome == "" ||
        (this.cliente.sobrenome.length <= 0 ||
          this.cliente.sobrenome.length > 20)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.cliente.email == "" ||
        (this.cliente.email.length <= 0 || this.cliente.email.length > 50)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.cliente.senha == "" ||
        (this.cliente.senha.length <= 0 || this.cliente.senha.length > 20)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.cliente.notificacao == "" ||
        this.cliente.notificacao.length <= 0
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (this.cliente.email != this.cliente.emailConfirmacao) {
        this.colors = "warning";
        this.timeout = 5000;
        this.snack("bottom", "center");
        this.text =
          "Ops! O e-mail e e-mail de confirmação informados não são correspondentes.";
        this.error = true;
        return true;
      }
    },

    validacaoCamposPreenchidosEmpresa() {
      if (
        this.empresa.cnpj == "" ||
        (this.empresa.cnpj.length <= 0 || this.empresa.cnpj.length > 18)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.empresa.razaoSocial == "" ||
        (this.empresa.razaoSocial.length <= 0 ||
          this.empresa.razaoSocial.length > 80)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.empresa.nomeFantasia == "" ||
        (this.empresa.nomeFantasia.length <= 0 ||
          this.empresa.nomeFantasia.length > 80)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.empresa.obs == "" ||
        (this.empresa.obs.length <= 0 || this.empresa.obs.length > 300)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.empresa.email == "" ||
        (this.empresa.email.length <= 0 || this.empresa.email.length > 50)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }
      if (
        this.empresa.senha == "" ||
        (this.empresa.senha.length <= 0 || this.empresa.senha.length > 20)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.empresa.cep == "" ||
        (this.empresa.cep.length <= 0 || this.empresa.cep.length > 9)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.empresa.logradouro == "" ||
        (this.empresa.logradouro.length <= 0 ||
          this.empresa.logradouro.length > 50)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.empresa.num == "" ||
        (this.empresa.num.length <= 0 || this.empresa.num.length > 10)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.empresa.bairro == "" ||
        (this.empresa.bairro.length <= 0 || this.empresa.bairro.length > 30)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.empresa.cep == "" ||
        (this.empresa.cep.length <= 0 || this.empresa.cep.length > 9)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.empresa.checkboxLeve == false &&
        this.empresa.checkboxPesada == false
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }
    },

    cadastrarEmpresa() {
      //console.log(this.empresa)
      let usuario = [];

      usuario.push({
        email: this.empresa.email,
        senha: this.empresa.senha,
        tipoPessoa: "J"
      });

      axios
        .post("/consultaEmailDuplicado", { email: usuario[0].email })
        .then(response => {
          if (parseInt(response.data) == 0) {
            axios
              .post("/usuario", usuario)
              .then(response => {
                if (response.data[0].idUsuario.length > 0) {
                  this.empresa.idUsuario = response.data[0].idUsuario;
                  axios
                    .post("/endereco", this.empresa)
                    .then(response => {
                      if (response.data[0].idEndereco.length > 0) {
                        this.empresa.idEndereco = response.data[0].idEndereco;

                        axios
                          .post("/contato", this.empresa)
                          .then(response => {
                            if (response.data[0].idContato.length > 0) {
                              this.empresa.idContato =
                                response.data[0].idContato;

                              axios
                                .post("/empresa", this.empresa)
                                .then(response => {
                                  if (response.data.length > 0) {
                                    this.text = response.data[0].mensagem;
                                    this.colors = "green";
                                    this.snack("top", "center");
                                    this.closeDialogEmpresa();
                                    this.limparCamposEmpresa();
                                  }
                                })
                                .catch(e => {
                                  console.log(error);
                                });
                            }
                          })
                          .catch(e => {
                            console.log(error);
                          });
                      }
                    })
                    .catch(e => {
                      console.log(error);
                    });
                }
              })
              .catch(e => {
                console.log(error);
              });
          }

          if (parseInt(response.data[0].duplicidade) >= 1) {
            this.text = response.data[0].mensagem;
            this.colors = "red";
            this.snack("bottom", "center");
            verificador = 1;
          }
        })
        .catch(e => {
          console.log(error);
        });
    },

    cadastrarCliente() {
      let usuario = [];

      usuario.push({
        email: this.cliente.email,
        senha: this.cliente.senha,
        tipoPessoa: "F"
      });

      axios
        .post("/consultaEmailDuplicado", { email: usuario[0].email })
        .then(response => {
          if (parseInt(response.data) == 0) {
            axios
              .post("/usuario", usuario)
              .then(response => {
                if (response.data[0].idUsuario.length > 0) {
                  this.cliente.idUsuario = response.data[0].idUsuario;
                  axios
                    .post("/contato", this.cliente)
                    .then(response => {
                      if (response.data[0].idContato.length > 0) {
                        this.cliente.idContato = response.data[0].idContato;

                        axios
                          .post("/cliente", this.cliente)
                          .then(response => {
                            if (response.data.length > 0) {
                              this.text = response.data[0].mensagem;
                              this.colors = "green";
                              this.snack("top", "center");
                              this.closeDialogCliente();
                              this.limpaCamposCliente();
                            }
                          })
                          .catch(e => {
                            console.log(error);
                          });
                      }
                    })
                    .catch(e => {
                      console.log(error);
                    });
                }
              })
              .catch(e => {
                console.log(error);
              });
          }

          if (parseInt(response.data[0].duplicidade) >= 1) {
            this.text = response.data[0].mensagem;
            this.colors = "red";
            this.snack("bottom", "center");
            verificador = 1;
          }
        })
        .catch(e => {
          console.log(error);
        });
    },

    closeDialogCliente() {
      this.dialogCadCli = false;
      this.limpaCamposCliente();
    },

    closeDialogEmpresa() {
      this.dialogCadEmp = false;
      this.limparCamposEmpresa();
    },

    salvarCliente() {
      if (!this.validacaoCamposPreenchidosCliente()) {
        this.cadastrarCliente();
      }
    },

    salvarEmpresa() {
      if (!this.validacaoCamposPreenchidosEmpresa()) {
        this.cadastrarEmpresa();
      }
    },

    acessaModalEmpresa() {
      this.limparCamposEmpresa();
      this.dialogTipoPessoa = false;
      this.dialogCadEmp = true;
    },

    acessaModalCliente() {
      this.limpaCamposCliente();
      this.dialogTipoPessoa = false;
      this.dialogCadCli = true;
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

