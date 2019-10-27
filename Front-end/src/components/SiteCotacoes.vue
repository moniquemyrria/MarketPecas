<template>
  <div id="app">

     <!-- CARREGANDO DADOS -->
        <v-dialog v-model="dialogCarregandoDados" width="320">
          <v-card color="primary" dark>
            <br />
            <v-card-text>
              {{ textCarregandoDados }}
              <v-progress-linear indeterminate color="white" class="mb-0"></v-progress-linear>
            </v-card-text>
          </v-card>
        </v-dialog>

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
            <v-list color="#ECEFF1">
              <v-list-item-group color="primary">
                <v-menu offset-x :close-on-content-click="false" transition="scale-transition">
                  <template v-slot:activator="{ on }">
                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>group_work</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title @click="todosProdutos" v-on="on">Todos os Produtos</v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                  </template>
                </v-menu>
                <v-menu offset-x :close-on-content-click="false" transition="scale-transition">
                  <template v-slot:activator="{ on }">
                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>notification_important</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title @click="produtosOferta" v-on="on">Produtos em Oferta</v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                  </template>
                </v-menu>
                <v-menu offset-x :close-on-content-click="false" transition="scale-transition">
                  <template v-slot:activator="{ on }">
                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>directions_car</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title v-on="on">Categorias</v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                  </template>
                  <v-list>
                    <v-list-item
                      v-for="item in categoria"
                      :key="item.id"
                      v-model="on"
                      @click="listarItemCategoria(item.descricao)"
                    >
                      <v-list-item-title>{{item.descricao}}</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>

                <v-menu offset-x :close-on-content-click="false" transition="scale-transition">
                  <template v-slot:activator="{ on }">
                    <v-list-item>
                      <v-list-item-icon>
                        <v-icon>emoji_objects</v-icon>
                      </v-list-item-icon>
                      <v-list-item-content>
                        <v-list-item-title v-on="on">Marcas</v-list-item-title>
                      </v-list-item-content>
                    </v-list-item>
                  </template>
                  <v-list>
                    <v-list-item
                      v-for="item in marca"
                      :key="item.id"
                      v-model="on"
                      @click="listarItemMarca(item.descricao)"
                    >
                      <v-list-item-title>{{item.descricao}}</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
                
              </v-list-item-group>
            </v-list>
          </v-card>
        </v-col>
        <v-col cols="12" sm="8">
          <v-row>
            <v-col v-for="item in produtosTodos" :key="item.id" cols="12" sm="3">
              <v-card class="mx-auto" min-width="220">
                <v-img class="white--text align-end" height="150px" :src="item.imagem"></v-img>
                <v-card-title>{{ item.descricao}}</v-card-title>

                <v-card-subtitle class="pb-0">{{'R$: ' + item.preco}}</v-card-subtitle>

                <v-card-text class="text--primary">
                  <div>{{'Cod: '+ item.codigo}}</div>

                  <div>{{ 'Loja: ' + item.empresa}}</div>
                </v-card-text>
                <v-divider class="mx-4"></v-divider>

                <v-card-text>
                  <div>{{ 'Categoria: ' + item.categoria}}</div>
                  <div>{{ 'Marca: ' + item.marca}}</div>
                </v-card-text>
                <v-card-actions>
                  <v-btn color="primary" text>ADCIONAR COTAÇÃO</v-btn>

                  <v-spacer></v-spacer>

                  <v-btn icon @click="show = !show">
                    <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                  </v-btn>
                </v-card-actions>

                <v-expand-transition>
                  <div v-show="show">
                    <v-divider></v-divider>

                    <v-card-text>
                      <div>
                        <b>Aplicação:</b>
                        {{item.aplicacao}}
                      </div>
                      <div>
                        <b>Altura:</b>
                        {{item.altura}}
                      </div>
                      <div>
                        <b>Largura:</b>
                        {{item.largura}}
                      </div>
                      <div>
                        <b>Comprimento:</b>
                        {{item.comprimento}}
                      </div>
                      <div>
                        <b>Peso:</b>
                        {{item.peso}}
                      </div>
                    </v-card-text>
                  </div>
                </v-expand-transition>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
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
      show: false,
      dialogSobreMkt: false,
      dialogTeamDev: false,
      dialogContato: false,
      dialogSubMenu: false,

      produtosTodos: [],
      categoria: [],
      marca: [],

      dialogCarregandoDados: false,
      textCarregandoDados: '',

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
    },

    todosProdutos() {
     
      axios
        .get("/produtotodos")
        .then(response => {
          if (response.data.length > 0) {
            this.produtosTodos = [];
            this.produtosTodos = response.data;
            
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

    produtosOferta(){
      axios
        .get("/produtooferta")
        .then(response => {
          if (response.data.length > 0) {
            this.produtosTodos = [];
            this.produtosTodos = response.data;
           
          }
        })
        .catch(e => {
          console.log(e);
        });

    },


    listarCategoria() {
      axios
        .get("/categoria")
        .then(response => {
          this.categoria = [];

          this.categoria = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    listarMarca() {
      axios
        .get("/marca")
        .then(response => {
          this.marca = [];

          this.marca = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    listarItemCategoria(categoria) {
      
      axios
        .post("/produtocategoria", { categoria: categoria })
        .then(response => {
          this.produtosTodos = [];
          this.produtosTodos = response.data;
           this.dialogCarregandoDados = false;
        })
        .catch(e => {
          console.log(e);
        });
    },

    listarItemMarca(marca) {
      
      axios
        .post("/produtomarca", { marca: marca })
        .then(response => {
          this.produtosTodos = [];
          this.produtosTodos = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    initialize() {
      this.todosProdutos();
      this.listarCategoria();
      this.listarMarca();
    }
  },
  created() {
    this.initialize();
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