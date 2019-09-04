<template>
  <v-container fill-height fluid>
    <div class="text-center ma-2">
      <v-snackbar color="cyan darken-2" :right="x === 'right'" bottom v-model="snackbar">
        {{ text }}
        <v-btn color="White"  :multi-line="multiLine" bottom text @click="snackbar = false">Ok</v-btn>
      </v-snackbar>
    </div>

    <v-row justify="center">
      <v-col cols="12" md="12">
        <material-card color="primary" text="Produtos">
          <div>
            <v-data-table
              :headers="headers"
              :items="desserts"
               :search="search"
               :custom-filter="filterOnlyCapsText"
              sort-by="calories"
              class="elevation-1"
            >
              <template v-slot:top>
                 <v-text-field append-icon="search" v-model="search" label="Pesquisa de Produtos por: Codigo, Descrição, Categoria ou Marca" class="mx-4"></v-text-field>
                 
                <v-toolbar flat color="white">
                  <div class="flex-grow-1"></div>
                  <v-dialog
                    v-model="dialog"
                    fullscreen
                    hide-overlay
                    transition="dialog-bottom-transition"
                  >
                    <template v-slot:activator="{ on }">
                      <v-btn color="primary" dark class="mb-2" v-on="on">NOVO PRODUTO</v-btn>
                    </template>
                    <v-card>
                      <v-toolbar dark color="primary">
                        <v-btn icon dark @click="dialog = false">
                          <v-icon>mdi-close</v-icon>
                        </v-btn>
                        <v-toolbar-title>
                          <span class="headline">{{ formTitle }}</span>
                        </v-toolbar-title>
                        <div class="flex-grow-1"></div>
                        <v-toolbar-items>
                          <v-btn dark text @click="close">CANCELAR</v-btn>
                          <v-btn dark text @click="save">SALVAR</v-btn>
                        </v-toolbar-items>
                      </v-toolbar>
                      <v-card-title></v-card-title>

                      <v-card-text>
                        <v-container>
                          <v-tabs background-color="white" color="primary" right>
                            <v-tab>DADOS GERAIS</v-tab>
                            <v-tab>MEDIDAS</v-tab>

                            <v-tab-item v-for="n in 3" :key="n">
                              <br />
                              <v-card>
                                <v-card-text>
                                  <v-container fluid>
                                    <v-container v-if="n == 1" style>
                                      <v-layout row>
                                        <v-flex xs9 sm6 style>
                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm5>
                                                <v-text-field
                                                  v-model="editedItem.codigo"
                                                  label="Código ou Referência"
                                                  prepend-icon="crop_free"
                                                ></v-text-field>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>

                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm12>
                                                <v-text-field
                                                  v-model="editedItem.descricao"
                                                  label="Descrição detalhada"
                                                  prepend-icon="create"
                                                ></v-text-field>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>

                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm12>
                                                <v-textarea
                                                  v-model="editedItem.aplicacao"
                                                  name="input-7-1"
                                                  label="Descreva aqui a aplicação do produto"
                                                  hint
                                                  prepend-icon="notes"
                                                ></v-textarea>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>
                                        </v-flex>

                                        <v-flex xs9 sm5 style="margin-left: 10vh; ">
                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm12>
                                                <v-autocomplete
                                                  label="Selecione a Categoria do Item"
                                                  :items="components"
                                                  prepend-icon="assignment"
                                                ></v-autocomplete>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>

                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm12>
                                                <v-autocomplete
                                                  label="Selecione a Marca do Item"
                                                  :items="components"
                                                  prepend-icon="assignment_turned_in"
                                                ></v-autocomplete>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>

                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm8 style="float: right">
                                                <v-file-input
                                                  :rules="rules"
                                                  accept="image/png, image/jpeg, image/bmp"
                                                  placeholder="Selecione a Imagem do Produto"
                                                  prepend-icon="mdi-camera"
                                                ></v-file-input>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>

                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm6 style="float: right">
                                                <v-text-field
                                                  v-model="editedItem.uniMedida"
                                                  label="Unidade de Medida"
                                                  prepend-icon="scatter_plot"
                                                ></v-text-field>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>
                                          <br />
                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm5 style="float: right; ">
                                                <v-text-field
                                                  v-model="editedItem.preco"
                                                  label="Valor de Venda"
                                                  prefix="R$"
                                                  prepend-icon="monetization_on"
                                                ></v-text-field>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>
                                        </v-flex>
                                      </v-layout>

                                      <!-- <v-col v-for="i in 6" :key="i" cols="12" md="4">
                                    <v-img
                                      :src="`https://picsum.photos/500/300?image=${i * n * 5 + 10}`"
                                      :lazy-src="`https://picsum.photos/10/6?image=${i * n * 5 + 10}`"
                                      aspect-ratio="1"
                                    ></v-img>
                                      </v-col>-->
                                    </v-container>
                                    <v-container v-if="n == 2">
                                      <v-layout row>
                                        <v-flex xs9 sm6>
                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm12>
                                                <v-text-field
                                                  v-model="editedItem.altura"
                                                  label="Altura do Item"
                                                  prepend-icon="square_foot"
                                                ></v-text-field>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>
                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm12>
                                                <v-text-field
                                                  v-model="editedItem.largura"
                                                  label="Largura do Item"
                                                  prepend-icon="square_foot"
                                                ></v-text-field>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>
                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm12>
                                                <v-text-field
                                                  v-model="editedItem.comprimento"
                                                  label="Comprimento do Item"
                                                  prepend-icon="square_foot"
                                                ></v-text-field>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>
                                          <v-layout>
                                            <v-flex xs9 sm12>
                                              <v-flex xs9 sm12>
                                                <v-text-field
                                                  v-model="editedItem.peso"
                                                  label="Peso Bruto do Item"
                                                  prepend-icon="vertical_align_bottom"
                                                ></v-text-field>
                                              </v-flex>
                                            </v-flex>
                                          </v-layout>
                                        </v-flex>
                                        <v-flex xs9 sm6></v-flex>
                                      </v-layout>
                                    </v-container>
                                  </v-container>
                                </v-card-text>
                              </v-card>
                            </v-tab-item>
                          </v-tabs>

                          <!-- <v-row>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field 
                                v-model="editedItem.codigo" 
                                label="Código">
                              </v-text-field>
                          </v-col>-->
                          <!-- <v-col cols="12" sm="6" md="4">
                              <v-text-field v-model="editedItem.calories" label="Descrição"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field v-model="editedItem.fat" label="Categoria"></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                              <v-text-field v-model="editedItem.carbs" label="Marca"></v-text-field>
                          </v-col>-->
                          <!-- </v-row> -->
                        </v-container>
                      </v-card-text>

                      <!-- <v-card-actions>
                        <div class="flex-grow-1"></div>
                        <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                        <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                      </v-card-actions>-->
                    </v-card>
                  </v-dialog>
                </v-toolbar>
              </template>
              <template v-slot:item.action="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">edit</v-icon>
                <v-icon small @click="deleteItem(item)">delete</v-icon>
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
import Vue from "vue";
import Vuetify from "vuetify";

export default {
  vuetify: new Vuetify(),
  vue: new Vue(),
  data() {
    return {
      search: '',
      x: null,
      snackbar: false,
      text: 'Hello, I\'m a snackbar',
      dialog: false,
      headers: [
        { text: "Codigo", value: "codigo", sortable: true },
        { text: "Descrição", value: "descricao", sortable: true},
        { text: "Categoria", value: "categoria", sortable: true},
        { text: "Marca", value: "marca", sortable: true },
        { text: "Actions", value: "action", sortable: false }
      ],
      components: [
        "Moura",
        "Autocompletes",
        "Comboboxes",
        "Forms",
        "Inputs",
        "Overflow Buttons",
        "Selects",
        "Selection Controls",
        "Sliders",
        "Textareas",
        "Text Fields"
      ],
      desserts: [],
      editedIndex: -1,
      produto: {
        codigo: "",
        descricao: "",
        aplicacao: "",
        uniMedida: "",
        altura: "",
        largura: "",
        comprimento: "",
        peso: "",
        foto: "",
        preco: "",
        categoria: "",
        marca: ""
      },
      editedItem: {
        codigo: "",
        descricao: "",
        aplicacao: "",
        uniMedida: "",
        altura: "",
        largura: "",
        comprimento: "",
        peso: "",
        foto: "",
        preco: "",
        categoria: "",
        marca: "",

        name: "",
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      },
      defaultItem: {
        codigo: "",
        descricao: "",
        aplicacao: "",
        uniMedida: "",
        altura: "",
        largura: "",
        comprimento: "",
        peso: "",
        foto: "",
        preco: "",
        categoria: "",
        marca: "",

        name: "",
        calories: 0,
        fat: 0,
        carbs: 0,
        protein: 0
      }
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1
        ? "Cadastro de Produtos"
        : "Editando um Item";
    }
  },

  watch: {
    dialog(val) {
      val || this.close();
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.desserts = [
        {
          name: "123",
          calories: "Amortecedor do Palio",
          fat: "Amortecedor",
          carbs: "Teste",
          protein: "Moura",

          codigo: "123",
          descricao: "BATERIA DE CARRO",
          aplicacao: "UTILIZADA PARA LIGAR O CARRO",
          uniMedida: "UN",
          altura: "30cm",
          largura: "30cm",
          comprimento: "10cm",
          peso: "20KG",
          foto: "",
          preco: "104,80",
          categoria: "BATERIAS",
          marca: "MOURA"
        }
      ];
    },

    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      const index = this.desserts.indexOf(item);
      confirm("Deseja realmente deletar o produto selecionado?") &&
        this.desserts.splice(index, 1);
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
        this.snackbar = true;
        this.text = 'REGISTRO SALVO COM SUCESSO'
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    }
  }
};
</script>
