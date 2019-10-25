<template>
  <div id="app">
    <va-appbar-menu-emp />
    <v-app>
      <v-container style="float: right; width: 165vh; margin-top: 10vh">
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

        <!-- MENSAGEM PERGUNTA EXCLUIR PRODUTO -->
        <v-dialog v-model="dialogExcluir" max-width="500px">
          <v-card>
            <v-card-title>
              <span>Excluír Produto</span>

              <div class="flex-grow-1" />
            </v-card-title>
            <v-card-text>
              <span>
                <b>Deseja relamente excluír o produto?</b>
              </span>
              <br />
              <br />
              <i>
                <label
                  style="font-size: 12px;"
                >*Os produtos excluídos não serão mais listados no MarketPeças</label>
              </i>
            </v-card-text>
            <v-card-actions>
              <v-col cols="9" sm="12">
                <v-row style="float: right; ">
                  <v-btn color="error" text @click="cancelarDeletarItem()">NÃO</v-btn>
                  <v-btn color="primary" text @click="excluir()">SIM</v-btn>
                </v-row>
              </v-col>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <!-- MENSAGEM PERGUNTA NOVO PREÇO PRODUTO -->
        <v-dialog v-model="dialogNovoPrecoProduto" max-width="500px">
          <v-card>
            <v-card-title>
              <span>Preço do Produto para a Oferta</span>

              <div class="flex-grow-1" />
            </v-card-title>
            <v-card-text>
              <br />
              <span>
                <b>Informe o novo preço do produto para inserir a oferta</b>
              </span>

              <v-row>
                <v-col cols="9" sm="12">
                  <v-col cols="9" sm="6" style="float: right; ">
                    <v-text-field
                      v-model="valorProdoferta"
                      label="Valor Produto *"
                      v-mask="mask"
                      prefix="R$"
                      prepend-icon="monetization_on"
                    />
                  </v-col>
                </v-col>
              </v-row>
            </v-card-text>
            <v-card-actions>
              <v-col cols="9" sm="12">
                <v-row style="float: right; ">
                  <v-btn color="error" text @click="cancelarProdutoOferta">CANCELAR</v-btn>
                  <v-btn color="primary" text @click="addProdutoOferta">ADCIONAR</v-btn>
                </v-row>
              </v-col>
            </v-card-actions>
          </v-card>
        </v-dialog>

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

        <!-- CRUD OFERTA PRODUTO -->
        <v-row justify="center">
          <v-col cols="12" md="12">
            <v-card>
              <v-card-title style="background: #0277BD;">
                <h4>
                  <span class="spanTitulo">PRODUTO |</span>
                  <b class="bTitulo">OFERTAS</b>&nbsp;
                </h4>
              </v-card-title>
              <!-- LISTAGEM DE OFERTA DE PRODUTOS -->

              <v-data-table
                :headers="headers"
                :items="tableOfertaProduto"
                :search="search"
                sort-by="calories"
                class="elevation-1"
                hide-default-footer
                :page.sync="page"
                :items-per-page="itemsPerPage"
                @page-count="pageCount = $event"
                color:black
              >
                <!-- PESQUISA DE OFERTAS -->
                <template v-slot:top>
                  <br />
                  <v-toolbar style="height: 100px;" flat>
                    <v-col cols="9" sm="12">
                      <v-row style>
                        <v-col cols="9" sm="10" style>
                          <v-toolbar-title>
                            <v-text-field
                              v-model="search"
                              style="margin-top: 50px; "
                              append-icon="search"
                              label="Pesquisa de Ofertas por: Nome"
                              class="mx-4"
                            />
                          </v-toolbar-title>
                        </v-col>
                        <v-col cols="9" sm="2" style>
                          <v-btn
                            style="margin-top: 35px"
                            color="primary"
                            dark
                            large
                            class="mb-2"
                            @click="novoProduto"
                          >NOVA OFERTA</v-btn>
                        </v-col>
                      </v-row>
                    </v-col>

                    <div class="flex-grow-1" />

                    <!-- ADD OFERTA -->
                    <v-dialog v-model="dialog" fullscreen hide-overlay>
                      <v-card>
                        <v-toolbar dark color="primary">
                          <v-btn icon dark @click="dialog = false">
                            <v-icon>mdi-close</v-icon>
                          </v-btn>
                          <v-toolbar-title>
                            <span class="headline">{{ formTitle }}</span>
                          </v-toolbar-title>
                          <div class="flex-grow-1" />
                          <v-toolbar-items>
                            <div class="ma-3">
                              <v-btn large color="error" @click="close">CANCELAR</v-btn>
                            </div>
                            <div class="ma-3">
                              <v-btn
                                style="margin-left: -10px;"
                                large
                                color="success"
                                @click="salvar"
                              >SALVAR</v-btn>
                            </div>
                          </v-toolbar-items>
                        </v-toolbar>
                        <v-card-title />

                        <v-card-text style="margin-top: -5vh;">
                          <v-container>
                            <v-row class="d-flex justify-sm-center" style="margin-top: 20px">
                              <v-col xl="12" sm="12">
                                <v-autocomplete
                                  v-model="itemSelecionado"
                                  label="Pesquisa de Produtos por: Descrição"
                                  append-icon="search"
                                  outlined
                                  :items="tableProduto"
                                  item-value="value"
                                  item-text="text"
                                ></v-autocomplete>
                              </v-col>
                            </v-row>

                            <v-row>
                              <v-col xl="12" sm="12" class="d-flex justify-sm-end">
                                <v-btn
                                  style="margin-top: -45px"
                                  color="primary"
                                  dark
                                  large
                                  class="mb-2"
                                  @click="modalAddPerco"
                                >ADCIONAR PRODUTO</v-btn>
                              </v-col>
                            </v-row>

                            <!-- CARD TABLE ITSN OFERTA -->
                            <v-card>
                              <v-row>
                                <v-col xl="12" sm="12" class="d-flex justify-sm-start">
                                  <v-col cols="9" sm="6">
                                    <v-text-field
                                      v-model="ofertaProduto.nome"
                                      label="Nome da Oferta *"
                                      prepend-icon="crop_free"
                                      :counter="20"
                                      required
                                    />
                                  </v-col>
                                </v-col>
                              </v-row>
                              <v-row>
                                <v-col xl="12" sm="12">
                                  <v-col xl="12" sm="12">
                                    <b>
                                      <label style="color: #B7B7B7">Produtos Selecionados da Oferta</label>
                                    </b>
                                  </v-col>
                                </v-col>
                              </v-row>
                              <v-row style="margin-top: -45px;">
                                <v-col xl="12" sm="12">
                                  <v-col xl="12" sm="12">
                                    <!-- TABELA ITENS DA OFERTA -->
                                    <v-data-table
                                      :headers="headersItens"
                                      :items="tableItens"
                                      class="elevation-1"
                                      hide-default-footer
                                      @page-count="pageCount = $event"
                                      color:black
                                    >
                                      <!-- <template v-slot:item.action="{ item }">
                                        <v-btn
                                          style="margin-left: 10px;"
                                          fab
                                          x-small
                                          outlined
                                          dark
                                          color="error"
                                        >
                                          <v-icon @click="removerItem(item)">delete</v-icon>
                                        </v-btn>
                                      </template>-->
                                    </v-data-table>
                                  </v-col>
                                </v-col>
                              </v-row>
                            </v-card>
                          </v-container>
                        </v-card-text>
                      </v-card>
                    </v-dialog>
                  </v-toolbar>
                </template>
                <template v-slot:item.action="{ item }">
                  <v-btn fab x-small outlined dark color="warning">
                    <v-icon @click="editar(item)">edit</v-icon>
                  </v-btn>

                  <v-btn style="margin-left: 10px;" fab x-small outlined dark color="error">
                    <v-icon @click="deletarItem(item)">delete</v-icon>
                  </v-btn>
                </template>
              </v-data-table>
              <br />

              <v-pagination
                v-model="page"
                :length="pageCount"
                prev-icon="mdi-menu-left"
                next-icon="mdi-menu-right"
              ></v-pagination>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-app>
  </div>
</template>

<script>
var fileUpload;
var file;
import axios from "../axios/client";
import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.css";
import VANaviBarMenuEmp from "@/components/MenuEmpresa";
import App from "../App.vue";
import { mask } from "vue-the-mask";

export default {
  name: "cadastroProduto",
  vuetify: new Vuetify(),
  directives: {
    mask
  },
  vue: new Vue(),
  data() {
    return {
      valorProdoferta: null,
      mask: "####.##",
      page: 1,
      pageCount: 0,
      itemsPerPage: 5,
      error: false,
      file: "",
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
      dialog: false,
      dialogExcluir: false,
      dialogCarregandoDados: false,
      dialogNovoPrecoProduto: false,
      textCarregandoDados: "",
      headers: [
        { text: "Codigo", value: "id", sortable: true },
        { text: "Nome da Oferta", value: "nome", sortable: true },
        { text: "Ação", value: "action", sortable: false }
      ],
      headersItens: [
        // { text: "Id", value: "id", sortable: false, visibility: 'hidden' },
        { text: "Codigo", value: "codigo", sortable: false },
        { text: "Produto", value: "descricao", sortable: false },
        { text: "Marca", value: "marca", sortable: false },
        { text: "Categoria", value: "categoria", sortable: false },
        { text: "Preço Oferta", value: "preco", sortable: false }
        // { text: "Ação", value: "action", sortable: false }
      ],
      tableItens: [],

      tableOfertaProduto: [],
      editedIndex: -1,
      itemSelecionado: [],
      ofertaProduto: {
        id: null,
        idEmpresa: null,
        nome: "",
        itensOferta: null
      },

      dadosUsuLogado: [],
      tableProduto: []
    };
  },

  components: {
    "va-appbar-menu-emp": VANaviBarMenuEmp
  },

  computed: {
    formTitle() {
      return this.ofertaProduto.id == ""
        ? "Cadastro de Ofertas"
        : "Editando uma Oferta";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    },

    pesquisaMarca(val) {
      val && val !== this.produto.marca && this.queryMarcas(val);
    },

    pesquisaCategoria(val) {
      val && val !== this.produto.marca && this.queryCategorias(val);
    },

    date(val) {
      this.dateFormatted = this.formatDate(this.date);
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    cancelarProdutoOferta() {
      this.dialogNovoPrecoProduto = false;
    },

    modalAddPerco() {
      if (this.itemSelecionado == "" || this.itemSelecionado == null) {
        this.colors = "warning";
        this.timeout = 5000;
        this.snack("bottom", "center");
        this.text = "Ops! É selecionar um produto no campo de Pesquisa.";
        this.error = true;
        return;
      }

      this.valorProdoferta = null;
      this.dialogNovoPrecoProduto = true;
    },

    addProdutoOferta() {
      if (
        this.valorProdoferta == "" ||
        this.valorProdoferta == null ||
        parseFloat(this.valorProdoferta) <= 0
      ) {
        this.colors = "warning";
        this.timeout = 5000;
        this.snack("bottom", "center");
        this.text =
          "Ops! É necessário informar o valor do produto para a oferta.";
        this.error = true;
        return;
      }

      axios
        .get("/produtopesquisaid/" + this.itemSelecionado)
        .then(response => {
          if (response.data.length > 0) {
            console.log(response.data);

            response.data[0].preco = this.valorProdoferta;
            this.tableItens.push(response.data[0]);
            this.dialogNovoPrecoProduto = false;
            this.itemSelecionado = "";
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

    novoProduto() {
      this.initialize();
      this.dialog = true;
    },

    msgAlertCamposPreenchidos() {
      this.colors = "warning";
      this.timeout = 5000;
      this.snack("bottom", "center");
      this.text =
        "Ops! Há campos brigatórios não preenchidos, ou algum dado informado está maior que o permitido para o campo.";
      this.error = true;
    },

    validacaoCamposPreenchidos() {
      if (
        this.ofertaProduto.nome == "" ||
        (this.ofertaProduto.nome.length <= 0 ||
          this.ofertaProduto.nome.length > 20)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }
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

    limparCampos() {
      this.tableItens = [];
      this.itemSelecionado = [];
      this.ofertaProduto.id = "";
      this.ofertaProduto.nome = "";
      this.ofertaProduto.itensOferta = null;
    },

    initialize() {
      this.limparCampos();
      this.dadosUsuLogado = JSON.parse(sessionStorage.getItem("usuario"));
      this.ofertaProduto.idEmpresa = this.dadosUsuLogado[0].idEmpresa;

      this.carregaOfertasProdutos();

      this.produtos();
    },

    carregaOfertasProdutos() {
      axios
        .get("/oferta/" + this.ofertaProduto.idEmpresa)
        .then(response => {
          this.tableOfertaProduto = [];
          this.tableOfertaProduto= response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    produtos() {
      axios
        .get("/produto/" + this.ofertaProduto.idEmpresa)
        .then(response => {
          this.tableProduto = [];
          //this.tableProduto = response.data;
          for (let i = 0; i < response.data.length; i++) {
            this.tableProduto.push({
              value: response.data[i].id,
              text: response.data[i].descricao
            });
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

    produtosId() {
      axios
        .get("/produtopesquisaid/" + this.ofertaProduto.idEmpresa)
        .then(response => {
          this.tableProduto = [];
          //this.tableProduto = response.data;
          for (let i = 0; i < response.data.length; i++) {
            this.tableProduto.push({
              value: response.data[i].id,
              text: response.data[i].descricao
            });
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

    editar(item) {
      this.dialogCarregandoDados = true;
      this.textCarregandoDados = "Aguarde ...Carregando dados do Produto.";
      // axios
      //   .get("/produtopesquisaid/" + item.id)
      //   .then(response => {
      //     if (response.data.length > 0) {
      //       this.produto = response.data[0];
      //       this.produto.preco = parseFloat(response.data[0].preco);
      //       (this.dateFormatted = this.formatDate(response.data[0].validade)),
      //         console.log(this.produto);
      //       // let image = new Image();
      //       // image.src = response.data[0].imagem;
      //       // this.foto = response.data[0].imagem;;
      //       // this.dataUrl();

      //       //document.body.appendChild(image);
      //       this.dialog = true;
      //       this.dialogCarregandoDados = false;
      //     }
      //   })
      //   .catch(e => {
      //     console.log(e);
      //   });
    },

    deletarItem(item) {
      this.ofertaProduto.id = item.id;
      this.dialogExcluir = true;
    },

    cancelarDeletarItem() {
      this.produto.id = "";
      this.dialogExcluir = false;
    },

    close() {
      this.dialog = false;
      this.initialize();
    },

    salvar() {
      if (!this.validacaoCamposPreenchidos()) {
        if (this.ofertaProduto.id == "") {
          this.cadastrar();
        } else {
          this.alterar();
        }
        
      }
    },

    cadastrar() {
      this.ofertaProduto.itensOferta = this.tableItens;

      axios
        .post("/oferta", this.ofertaProduto)
        .then(response => {
          this.text = response.data[0].mensagem;
          this.colors = "blue";
          this.snack("top", "right");
          this.dialog = false;

          this.close();
          this.initialize();
        })
        .catch(e => {
          console.log(e);
        });
    },

    alterar() {
      // axios
      //   .put("/produto", this.produto)
      //   .then(response => {
      //     //if (response.data[0].produto.length > 0) {
      //     this.text = response.data[0].mensagem;
      //     this.colors = "blue";
      //     this.snack("top", "right");
      //     //}
      //     this.close();
      //     this.initialize();
      //     this.id = "";
      //   })
      //   .catch(e => {
      //     console.log(e);
      //   });
    },

    excluir() {
      // axios
      //   .delete("/produto/" + this.produto.id)
      //   .then(response => {
      //     if (response.data[0].produto.length > 0) {
      //       this.text = response.data[0].mensagem;
      //       this.colors = "blue";
      //       this.snack("top", "right");
      //     }
      //     this.close();
      //     this.initialize();
      //     this.id = "";
      //     this.dialogExcluir = false;
      //   })
      //   .catch(e => {
      //     console.log(e);
      //   });
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