<template>
  <v-container class="fill-height" fluid>
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

    <v-row justify="center">
      <v-col cols="12" md="12">
        <material-card color="primary" text="Produtos">
          <div>
            <v-data-table
              :headers="headers"
              :items="tableProduto"
              :search="search"
              sort-by="calories"
              class="elevation-1"
            >
              <template v-slot:top>
                <br />
                <v-toolbar style="height: 100px;" flat color="white">
                  <v-col cols="9" sm="8">
                    <v-toolbar-title>
                      <v-text-field
                        v-model="search"
                        style="margin-top: 50px; "
                        append-icon="search"
                        label="Pesquisa de Produtos por: Codigo, Descrição, Categoria ou Marca"
                        class="mx-4"
                      />
                    </v-toolbar-title>
                  </v-col>

                  <div class="flex-grow-1" />
                  <v-dialog v-model="dialog" fullscreen hide-overlay >
                    <template v-slot:activator="{ on }">
                      <v-btn
                        style="margin-top: 35px"
                        color="primary"
                        dark
                        large
                        class="mb-2"
                        v-on="on"
                      >NOVO PRODUTO</v-btn>
                    </template>
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
                          <v-tabs background-color="white" color="primary" right>
                            <v-tab>DADOS GERAIS *</v-tab>
                            <v-tab>MEDIDAS</v-tab>

                            <v-tab-item v-for="n in 2" :key="n">
                             
                              <v-card>
                                <v-card-text>
                                  <v-container fluid>
                                    <v-container v-if="n == 1" style>
                                      <v-row>
                                        <v-col cols="9" sm="6" style>
                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="5">
                                                <v-text-field
                                                  v-model="produto.codigo"
                                                  label="Código ou Referência *"
                                                  prepend-icon="crop_free"
                                                  :counter="20"
                                                  required
                                                />
                                              </v-col>
                                            </v-col>
                                          </v-row>

                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="12">
                                                <v-text-field
                                                  v-model="produto.descricao"
                                                  label="Descrição detalhada *"
                                                  prepend-icon="create"
                                                  :counter="100"
                                                  required
                                                />
                                              </v-col>
                                            </v-col>
                                          </v-row>

                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="12">
                                                <v-textarea
                                                  v-model="produto.aplicacao"
                                                  name="input-7-1"
                                                  label="Descreva aqui a aplicação do produto *"
                                                  hint
                                                  prepend-icon="notes"
                                                  :counter="300"
                                                  required
                                                />
                                              </v-col>
                                            </v-col>
                                          </v-row>
                                        </v-col>

                                        <v-col cols="9" sm="5" style="margin-left: 10vh; ">
                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="12">
                                                <v-select
                                                  v-model="produto.categoria"
                                                  :items="categoriaListagem"
                                                  label="Selecione a Categoria do Item *"
                                                  menu-props="auto"
                                                  hide-details
                                                  prepend-icon="map"
                                                  single-line
                                                ></v-select>
                                                <!-- <v-autocomplete
                                                  v-model="produto.categoria"
                                                  :search-input.sync="pesquisaCategoria"
                                                  label="Selecione a Categoria do Item *"
                                                  :items="itemsCategoria"
                                                  hide-no-data
                                                  hide-details
                                                  prepend-icon="assignment_turned_in"
                                                  :counter="100"
                                                  required
                                                  placeholder="Digite o nome da categoria para a pesquisa."
                                                  item-text="produto.categoria"
                                                  item-value="produto.categoria"
                                                />-->
                                              </v-col>
                                            </v-col>
                                          </v-row>

                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="12">
                                                <v-select
                                                  v-model="produto.marca"
                                                  :items="marcaListagem"
                                                  label="Selecione a Marca do Item *"
                                                  menu-props="auto"
                                                  hide-details
                                                  prepend-icon="map"
                                                  single-line
                                                ></v-select>
                                                <!-- <v-autocomplete
                                                  v-model="produto.marca"
                                                  :search-input.sync="pesquisaMarca"
                                                  label="Selecione a Marca do Item *"
                                                  :items="itemsMarca"
                                                  hide-no-data
                                                  hide-details
                                                  prepend-icon="assignment_turned_in"
                                                  :counter="100"
                                                  required
                                                  placeholder="Digite o nome da marca para a pesquisa."
                                                />-->
                                              </v-col>
                                            </v-col>
                                          </v-row>

                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="12" style="float: right">
                                                <!-- <input 
                                                  type="file" 
                                                  ref="files" 
                                                  @change="gerarArquivoBase64($event)"
                                                  accept="image/png, image/jpeg, image/bmp"  
                                                  placeholder="Selecione a Imagem do Produto"
                                                >-->
                                                <v-file-input
                                                  @change="gerarArquivoBase64($event)"
                                                  accept="image/png, image/jpeg, image/bmp"
                                                  placeholder="Selecione a Imagem do Produto"
                                                  prepend-icon="mdi-camera"
                                                  show-size
                                                  hide-details
                                                  ref="img"
                                                />
                                              </v-col>
                                            </v-col>
                                          </v-row>

                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="6" style="float: right">
                                                <v-text-field
                                                  v-model="produto.uniMedida"
                                                  label="Unidade de Medida *"
                                                  prepend-icon="scatter_plot"
                                                  :counter="4"
                                                  required
                                                />
                                              </v-col>
                                            </v-col>
                                          </v-row>
                                         
                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="6" style="float: right; ">
                                                <v-text-field
                                                  v-model="produto.preco"
                                                  label="Valor de Venda *"
                                                  v-mask="mask"
                                                  prefix="R$"
                                                  prepend-icon="monetization_on"
                                                />
                                              </v-col>
                                            </v-col>
                                          </v-row>
                                        </v-col>
                                      </v-row>

                                      <!-- <v-col v-for="i in 6" :key="i" cols="12" md="4">
                                    <v-img
                                      :src="`https://picsum.photos/500/300?image=${i * n * 5 + 10}`"
                                      :lazy-src="`https://picsum.photos/10/6?image=${i * n * 5 + 10}`"
                                      aspect-ratio="1"
                                    ></v-img>
                                      </v-col>-->
                                    </v-container>
                                    <v-container v-if="n == 2">
                                      <v-row>
                                        <v-col cols="9" sm="6">
                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="12">
                                                <v-text-field
                                                  v-model="produto.altura"
                                                  label="Altura do Item"
                                                  prepend-icon="square_foot"
                                                />
                                              </v-col>
                                            </v-col>
                                          </v-row>
                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="12">
                                                <v-text-field
                                                  v-model="produto.largura"
                                                  label="Largura do Item"
                                                  prepend-icon="square_foot"
                                                />
                                              </v-col>
                                            </v-col>
                                          </v-row>
                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="12">
                                                <v-text-field
                                                  v-model="produto.comprimento"
                                                  label="Comprimento do Item"
                                                  prepend-icon="square_foot"
                                                />
                                              </v-col>
                                            </v-col>
                                          </v-row>
                                          <v-row>
                                            <v-col cols="9" sm="12">
                                              <v-col cols="9" sm="12">
                                                <v-text-field
                                                  v-model="produto.peso"
                                                  label="Peso Bruto do Item"
                                                  prepend-icon="vertical_align_bottom"
                                                />
                                              </v-col>
                                            </v-col>
                                          </v-row>
                                        </v-col>
                                        <v-col cols="9" sm="6" />
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
                </v-toolbar>
              </template>
              <template v-slot:item.action="{ item }">
                <v-btn fab x-small outlined dark color="warning">
                  <v-icon @click="editar(item)">edit</v-icon>
                </v-btn>

                <v-btn style="margin-left: 10px;" fab x-small outlined dark color="error">
                  <v-icon @click="deletarItem(item)">delete</v-icon>
                </v-btn>

                <!-- <v-icon small @click="deleteItem(item)">delete</v-icon> -->
              </template>
              <template v-slot:no-data>
                <v-btn color="primary" @click="initialize">Reset</v-btn>
              </template>
            </v-data-table>
          </div>
        </material-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
var fileUpload;
var file;
import axios from "../axios/cliente";
import Vue from "vue";
import Vuetify from "vuetify";
import App from "../App.vue";
import { mask } from "vue-the-mask";

export default {
  vuetify: new Vuetify(),
  directives: {
    mask
  },
  vue: new Vue(),

  data() {
    return {
      mask: "####.##",
      error: false,
      file: "",
      model: "tab-1",
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
      headers: [
        { text: "Codigo", value: "codigo", sortable: true },
        { text: "Descrição", value: "descricao", sortable: true },
        { text: "Categoria", value: "categoria", sortable: true },
        { text: "Marca", value: "marca", sortable: true },
        { text: "Ação", value: "action", sortable: false }
      ],

      marcaListagem: [],
      pesquisaMarca: null,
      itemsMarca: [],

      categoriaListagem: [],
      pesquisaCategoria: null,
      itemsCategoria: [],

      tableProduto: [],
      editedIndex: -1,
      produto: {
        id: "",
        codigo: "",
        descricao: "",
        aplicacao: "",
        uniMedida: "",
        altura: "",
        largura: "",
        comprimento: "",
        peso: "",
        imagem: "",
        imagemNome: "",
        imagemTipo: "",
        preco: "",
        categoria: "",
        marca: "",
        dataCadastro: new Date()
      },

      files: [],
      nomeArquivo: "",
      tipoArquivo: "",
      foto: '',
    };
  },

  computed: {
    formTitle() {
      return this.produto.id == ""
        ? "Cadastro de Produtos"
        : "Editando um Item";
    },

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
    }
  },

  created() {
    this.initialize();
  },

  methods: {
   
    gerarArquivoBase64(event) {
      if (event != null) {
        //this.produto.imagem = event.target.files[0];
        fileUpload = event; //event.target.files[0];
        this.nomeArquivo = event.name;
        this.tipoArquivo = event.type;
        this.getBase64();
      }
    },
    getBase64: function() {
      var reader = new FileReader();
      reader.readAsDataURL(fileUpload);
      reader.onload = function() {
        file = reader.result;

        //console.log(this.file);
        //return file;
      };
      reader.onerror = function(error) {
        console.log("Error: ", error);
        console.log("Erro ao importar arquivo!");
        //this.dialogAviso = true;
        return;
      };
    },

    msgAlertCamposPreenchidos() {
      this.colors = "warning";
      this.timeout = 5000;
      this.snack("bottom", "center");
      this.text = "Ops! Há campos brigatórios não preenchidos.";
      this.error = true;
    },

    validacaoCamposPreenchidos() {
      if (
        this.produto.codigo == "" ||
        (this.produto.codigo.length <= 0 && this.produto.codigo.length > 20)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.produto.descricao == "" ||
        (this.produto.descricao.length <= 0 ||
          this.produto.descricao.length > 100)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.produto.aplicacao == "" ||
        (this.produto.aplicacao.length <= 0 &&
          this.produto.aplicacao.length > 300)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (this.produto.categoria == "" || this.produto.categoria.length <= 0) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (this.produto.marca == "" || this.produto.marca.length <= 0) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (
        this.produto.uniMedida == "" ||
        (this.produto.uniMedida.length <= 0 &&
          this.produto.uniMedida.length > 4)
      ) {
        this.msgAlertCamposPreenchidos();
        return true;
      }

      if (this.produto.preco == "" || this.produto.preco.length <= 0) {
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

    initialize() {
      this.marcas();
      this.categoria();
      this.produtos();
    },

    queryMarcas(v) {
      this.itemsMarca = this.marcaListagem.filter(e => {
        return (e || "").toLowerCase().indexOf((v || "").toLowerCase()) > -1;
      });
    },

    queryCategorias(v) {
      this.itemsCategoria = this.categoriaListagem.filter(e => {
        return (e || "").toLowerCase().indexOf((v || "").toLowerCase()) > -1;
      });
    },

    marcas() {
      axios
        .get("/marca")
        .then(response => {
          for (let i = 0; i < response.data.length; i++) {
            this.marcaListagem.push(response.data[i].descricao);
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

    categoria() {
      axios
        .get("/categoria")
        .then(response => {
          for (let i = 0; i < response.data.length; i++) {
            this.categoriaListagem.push(response.data[i].descricao);
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

    produtos() {
      axios
        .get("/produto")
        .then(response => {
          this.tableProduto = response.data;
        })
        .catch(e => {
          console.log(e);
        });
    },

    editar(item) {
      axios
        .get("/produtopesquisaid/" + item.id)
        .then(response => {
          if (response.data.length > 0) {
            this.produto = response.data[0];
            this.produto.preco = parseFloat(response.data[0].preco);
            // let image = new Image();
            // image.src = response.data[0].imagem;
            // this.foto = response.data[0].imagem;;
            // this.dataUrl();

            //document.body.appendChild(image);
            this.dialog = true;
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

    deletarItem(item) {
      this.produto.id = item.id;
      this.dialogExcluir = true;
    },

    cancelarDeletarItem() {
      this.produto.id = '';
      this.dialogExcluir = false;
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.produto = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    salvar() {
      if (!this.validacaoCamposPreenchidos()) {
        if (this.produto.id == "") {
          this.produto.imagem = file;
          this.produto.imagemNome = this.nomeArquivo;
          this.produto.imagemTipo = this.tipoArquivo;
          console.log(this.produto);
          this.cadastrar();
        } else {
          this.alterar();
        }
      }
    },

    cadastrar() {
      this.produto.dataCadastro = new Date();
      axios
        .post("/produto", this.produto)
        .then(response => {
          if (response.data[0].produto.length > 0) {
            this.text = response.data[0].mensagem;
            this.colors = "blue";
            this.snack("top", "right");
          }
          this.close();
          this.initialize();
          this.id = "";
        })
        .catch(e => {
          console.log(e);
        });

    },

    alterar() {
      this.produto.dataCadastro = new Date();
      axios
        .put("/produto", this.produto)
        .then(response => {
          if (response.data[0].produto.length > 0) {
            this.text = response.data[0].mensagem;
            this.colors = "blue";
            this.snack("top", "right");
          }
          this.close();
          this.initialize();
          this.id = "";
        })
        .catch(e => {
          console.log(e);
        });
    },

    excluir(){
      axios
        .delete("/produto/" + this.produto.id)
        .then(response => {
          if (response.data[0].produto.length > 0) {
            this.text = response.data[0].mensagem;
            this.colors = "blue";
            this.snack("top", "right");
          }
          this.close();
          this.initialize();
          this.id = "";
          this.dialogExcluir = false;
        })
        .catch(e => {
          console.log(e);
        });
    },
  }
};
</script>
