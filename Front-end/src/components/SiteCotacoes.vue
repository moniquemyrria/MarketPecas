<template>
  <div id="app">
    <!-- MENSAGEM PERGUNTA EXCLUIR PRODUTO -->
    <v-dialog v-model="dialogExcluir" max-width="500px">
      <v-card>
        <v-card-title>
          <span>Cancelar Cotação</span>

          <div class="flex-grow-1" />
        </v-card-title>
        <v-card-text>
          <span>
            <b>Deseja realmente cancelar a Cotação?</b>
          </span>
          <br />
        </v-card-text>
        <v-card-actions>
          <v-col cols="9" sm="12">
            <v-row style="float: right; ">
              <v-btn color="error" text @click="dialogExcluir = false">NÃO</v-btn>
              <v-btn color="primary" text @click="cancelarCotacao">SIM</v-btn>
            </v-row>
          </v-col>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- MENSAGEM PERGUNTA VERIFICA USUARIO LOGADO -->
    <v-dialog v-model="dialogSemUsuario" max-width="500px">
      <v-card>
        <v-card-title>
          <span>É PRECISO REALIZAR LOGIN</span>

          <div class="flex-grow-1" />
        </v-card-title>
        <v-card-text>
          <span>
            <b>Ops! Para salvar a cotação é necessário estar logado. Deseja realizar o Login no MarketPeças?</b>
          </span>
          <br />
        </v-card-text>
        <v-card-actions>
          <v-col cols="9" sm="12">
            <v-row style="float: right; ">
              <v-btn color="error" text @click="dialogSemUsuario = false">NÃO</v-btn>
              <v-btn color="primary" text @click="modalLogin">SIM</v-btn>
            </v-row>
          </v-col>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- LOGIN CLIENTE -->
    <v-dialog v-model="dialogLogin" max-width="500px">
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

                  <v-row style="margin-top: -5vh;" class="d-flex justify-sm-center">
                    <v-col xl="9" sm="6">
                      <v-btn
                        large
                        min-width="310px"
                        class="mt-12"
                        @click="acessar"
                        color="primary"
                      >Acessar</v-btn>
                    </v-col>
                  </v-row>
                </v-col>
              </v-row>
            </v-container>
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>

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

    <!-- MODAL COTAÇÕES -->
    <v-dialog
      v-model="dialogoCotacoes"
      scrollable
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
      style="color: #FAFAFA"
    >
      <v-card color="#FAFAFA">
        <v-toolbar flat style="height: -25px" dark color="primary">
          <v-img
            :src="require('@/assets/LOGO_2.png')"
            class="mr-5"
            contain
            height="50"
            width="50"
            max-width="50"
          />

          <v-toolbar-title>
            <span class="headline">
              <b>MarketPeças</b> | Suas cotações online
            </span>
          </v-toolbar-title>
          <div class="flex-grow-1" />
          <v-toolbar-items style="margin-top: -10px;">
            <div class="ma-3">
              <v-btn icon dark @click="dialogoCotacoes = false">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </div>
          </v-toolbar-items>
        </v-toolbar>

        <v-card-text style="height: 100vh;">
          <v-row>
            <v-col cols="12" sm="6">
              <v-card :elevation="0" class="mx-auto" color="#FAFAFA">
                <div class="overline mb-2">
                  <b>MEUS PRODUTOS SELECIONADOS</b>
                </div>

                <!-- PRODUTOS SELECIONADOS -->
                <v-row>
                  <v-col v-for="item in produtosCotacao" :key="item.id" cols="12" sm="12">
                    <v-card class="mx-auto" outlined style="height: 160px">
                      <v-list-item three-line>
                        <v-list-item-content>
                          <v-col cols="10" sm="8">
                            <div class="overline mb-4">
                              <b>Codigo:</b>
                              {{item.codigo}}
                            </div>
                            <v-list-item-title class="headline mb-1">{{item.descricao}}</v-list-item-title>
                            <v-list-item-subtitle>
                              <input
                                disabled
                                v-model="item.aplicacao"
                                style="width: 300px;"
                                type="text"
                                maxlength="100"
                              />
                            </v-list-item-subtitle>
                          </v-col>

                          <v-col cols="10" sm="4" style="margin-left: -55px">
                            <div style="margin-top: 10px; margin-left: 35px" class="overline mb-4">
                              <b>Quantidade</b>
                            </div>

                            <v-text-field
                              v-model="item.quantidade"
                              type="number"
                              append-outer-icon="add"
                              @click:append-outer="increment(item)"
                              prepend-icon="remove"
                              @click:prepend="decrement(item)"
                            ></v-text-field>

                            <v-list-item-subtitle></v-list-item-subtitle>
                          </v-col>
                        </v-list-item-content>

                        <v-list-item-avatar
                          sclass="profile"
                          color="grey"
                          size="80"
                          style="border: 2px groove; margin-top: 30px"
                        >
                          <v-img class="white--text align-end" :src="item.imagem"></v-img>
                        </v-list-item-avatar>
                      </v-list-item>

                      <v-card-actions>
                        <v-col cols="9" sm="12">
                          <v-row style="float: right; margin-top: -55px">
                            <v-btn @click="removerItemCotacao(item)" color="red" text>Remover</v-btn>
                          </v-row>
                        </v-col>
                      </v-card-actions>
                    </v-card>
                  </v-col>
                </v-row>
              </v-card>
            </v-col>
            <v-col cols="12" sm="6">
              <v-card :elevation="0" class="mx-auto" color="#FAFAFA">
                <div class="overline mb-4">
                  <b>COTAÇÕES DE PRODUTOS ORDENADOS PELO MENOR VALOR TOTAL</b>
                </div>

                <v-row>
                  <v-col cols="12" sm="12">
                    <v-btn
                      style="margin-left: 245px;"
                      large
                      color="error"
                      @click="dialogExcluir = true"
                    >CANCELAR COTAÇÃO</v-btn>
                    <v-btn
                      style="float: right;"
                      large
                      color="primary"
                      @click="salvarCotacao"
                    >SALVAR COTAÇÃO</v-btn>
                  </v-col>
                </v-row>

                <!-- v-for="(produtos, index) in produtosCommitTabela" :key="index" -->
                <v-card
                  v-for="(cotacao, index) in cotacaoDados"
                  :key="index"
                  :elevation="0"
                  class="mx-auto"
                  color="#FAFAFA"
                >
                  <v-card-text style="margin-left: -20px">
                    <v-card class="mx-auto" min-width="630">
                      <v-card-title>
                        <v-row>
                          <v-col cols="12" sm="10">{{'Loja ' + cotacao.nomeFant}}</v-col>
                          <v-col v-if="cotacao.cobreOferta == 'S'" cols="11" sm="2">
                            <v-row>
                              <v-icon color="yellow darken-2">mdi-star-outline</v-icon>
                              <div small class="grey--text align-end">
                                <b style="font-size: 12px;">Cobre Oferta</b>
                              </div>
                            </v-row>
                          </v-col>
                        </v-row>
                      </v-card-title>

                      <v-card-text>
                        <div v-if="cotacao.whatsapp != ''" class="grey--text align-end">
                          <v-icon color="green">mdi-whatsapp</v-icon>
                          <b>{{ cotacao.whatsapp}}</b>
                        </div>
                        <div v-if="cotacao.facebook != ''" class="grey--text align-end">
                          <v-icon color="primary">mdi-facebook</v-icon>
                          <b>{{ cotacao.facebook}}</b>
                        </div>

                        <div class="grey--text align-end">
                          <v-icon color="purple darken-2">mdi-domain</v-icon>
                          <b>Endereço:</b>
                          {{ ' ' + cotacao.logradouro + ' • Nº: ' + cotacao.numero + ' • Bairro: ' + cotacao.bairro }}
                        </div>

                        <div>
                          <v-icon color="blue-grey darken-2">mdi-credit-card</v-icon>
                          <b>{{'Formas de Pagamentos: ' }}</b>
                        </div>
                        <div v-if="cotacao.fpDinheiro == 'S'">A Vista</div>
                        <div v-if="cotacao.fpCredito == 'S'">Cartões de Créditos</div>
                        <div v-if="cotacao.fpDebito == 'S'">Cartões de Débito</div>
                        <div v-if="cotacao.fpBoleto == 'S'">Boletos</div>
                        <div v-if="cotacao.fpCrediario == 'S'">Crediário Próprio</div>
                      </v-card-text>

                      <v-divider class="mx-4"></v-divider>

                      <v-card-title>Peças Selecionadas</v-card-title>

                      <v-card-text>
                        <v-row>
                          <v-col cols="6" sm="3">
                            <b style="font-size: 12px;">DESCRIÇÃO</b>
                          </v-col>
                          <v-col cols="6" sm="2">
                            <b style="font-size: 12px;">MARCA</b>
                          </v-col>
                          <v-col cols="6" sm="2">
                            <b style="font-size: 12px;">QTDE</b>
                          </v-col>
                          <v-col cols="6" sm="1"></v-col>
                          <v-col cols="6" sm="2">
                            <b style="font-size: 12px;">PREÇO (R$)</b>
                          </v-col>
                          <v-col cols="6" sm="2">
                            <b style="font-size: 12px;">TOTAL (R$)</b>
                          </v-col>
                        </v-row>
                        <v-row
                          v-for="(cotacaoItem, index2) in cotacao.produtosCotacao"
                          :key="index2"
                        >
                          <v-col cols="6" sm="3">{{cotacaoItem.descProduto}}</v-col>
                          <v-col cols="6" sm="2">{{cotacaoItem.marca}}</v-col>
                          <v-col cols="6" sm="2" class="--text align-end">
                            {{cotacaoItem.quantidade}}
                          </v-col>
                          <v-col  cols="6" sm="1" class="--text align-end">
                            <v-icon v-if="cotacaoItem.produtoEmOferta == 'S'" color="green darken-2">mdi-star-outline</v-icon>
                          </v-col>
                          <v-col
                            cols="6"
                            sm="2"
                          >{{cotacaoItem.valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}}</v-col>
                          <v-col
                            cols="6"
                            sm="2"
                          >{{cotacaoItem.totalProduto.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}}</v-col>
                        </v-row>
                        <br />
                        <v-row>
                          <v-col cols="6" sm="4"></v-col>
                          <v-col cols="6" sm="2"></v-col>
                          
                          <v-col cols="6" sm="3">
                            <b style="float: right; font-size: 14px; color: #1976D2">VALOR TOTAL (R$):</b>
                          </v-col>
                          <v-col cols="6" sm="3" style="font-size: 12px;">
                            <b style="float: right; color: #1976D2;font-size: 14px;">{{cotacao.totalProdutosCotacao.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}}</b>
                          </v-col>
                        </v-row>
                      </v-card-text>
                    </v-card>
                  </v-card-text>
                </v-card>
              </v-card>
            </v-col>
          </v-row>
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

        <v-card-subtitle class="pb-0">SUAS COTAÇÕES ONLINE</v-card-subtitle>
        <br />
        <v-card-text class="text--primary">
          <div class="text-center">
            O MarketPeças é um site desenvolvido, idealizado, e projetado por duas desenvolvedoras,
            em novembro de 2019 por Gabrielle Maciel e Monique Rocha, com o intuito de proprocionar
            agilidade e facilidade aos clientes que compram peças automotivas, visando assim a praticidade e comodidade
            na cotação de peças em apenas alguns cliques.
          </div>
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

        <v-card-subtitle class="pb-0"></v-card-subtitle>

        <v-card-text class="text--primary">
          <div>
            <b>Developer and CEO</b>
          </div>
          <div>Gabrielle Maciel (e-mail: gabriellemacieel@gmail.com)</div>
        </v-card-text>
        <v-card-text class="text--primary">
          <div>
            <b>Developer and PO</b>
          </div>
          <div>Monique Rocha (e-mail: moniquermyrria@gmail.com)</div>
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
          <v-card-title>REDES SOCIAIS</v-card-title>
        </v-img>

        <v-card-subtitle class="pb-0">Acesse nossas Redes Sociais para Informações</v-card-subtitle>

        <v-card-text class="text--primary">
          
          <div class="text-center">
            <br>
            <v-btn color="primary" icon dark>
              <v-icon>mdi-facebook</v-icon>
            </v-btn>
             <v-btn color="purple" icon dark>
              <v-icon>mdi-instagram</v-icon>
            </v-btn>

            <v-btn color="cyan" icon dark>
              <v-icon>mdi-twitter</v-icon>
            </v-btn>

            <v-btn color="green" icon dark>
              <v-icon>mdi-whatsapp</v-icon>
            </v-btn>

            <v-btn color="red" icon dark>
              <v-icon>mdi-gmail</v-icon>
            </v-btn>
          </div>

          
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
          <v-icon color="white" class="mr-3">shopping_basket</v-icon>
          <div>
            <b>{{ text }}</b>
          </div>
        </v-snackbar>
      </div>

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
              <v-btn @click="contato" color="#6D6D6D" text class="my-1">SOCIAL</v-btn>
            </v-col>
            <v-col cols="12" sm="1" style="margin-top: 50px; margin-left: -75px">
              <v-tooltip bottom>
                <template v-slot:activator="{ on }">
                  <v-btn v-on="on" class="mx-1" fab dark @click="cotacoes" color="#0277BD">
                    <v-badge color="black" right>
                      <template v-slot:badge>
                        <span>{{produtosCotacao.length}}</span>
                      </template>
                      <v-icon>shopping_basket</v-icon>
                    </v-badge>
                  </v-btn>
                </template>
                <span>Realizar Cotação</span>
              </v-tooltip>
            </v-col>

            <v-col cols="12" sm="6" style="margin-top: 60px; ">
              <!-- BOTAO CLIENTE LOGADO -->
              <div v-if="flagverificaUsu == 1">
                <v-menu open-on-hover top offset-y>
                  <template v-slot:activator="{ on }">
                    <v-btn @click="login" v-on="on" text>{{ mensagemBotaoAcesso}}</v-btn>
                    <!-- <v-btn color="primary" dark v-on="on">Dropdown</v-btn> -->
                  </template>

                  <v-list>
                    <v-list-item
                      v-for="item in itemsMenuAcesso"
                      :key="item.id"
                      v-model="on"
                      @click="opcaoMenuAcesso(item.opcao)"
                    >
                      <v-list-item-title>{{item.opcao}}</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
              </div>
              <!-- BOTAO EMPRESA LOGADA OU NENHUM -->
              <div v-if="flagverificaUsu == 2 || flagverificaUsu == null">
                <v-btn @click="loginSemUsuLogado" text>{{ mensagemBotaoAcesso}}</v-btn>
              </div>
            </v-col>
          </v-layout>
        </v-container>
      </v-app-bar>
      <br />

      <v-carousel cycle interval="8000" height="350" hide-delimiter-background :show-arrows="false">
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
              v-model="busca"
              @input="listarItemBusca"
              label="Código, descrição, aplicação, marca ou categoria"
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
                        <v-icon>notifications</v-icon>
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

                <v-card-subtitle class="error--text pb-0">
                  <b>{{'R$: ' + item.preco}}</b>
                </v-card-subtitle>

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
                  <v-btn @click="addProdutoCotacao(item)" color="primary" text>ADICIONAR COTAÇÃO</v-btn>

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
      flagverificaUsu: null,
      cotacaoDados: [],
      mensagemBotaoAcesso: "ENTRE OU CADASTRE-SE",
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

      show: false,
      show1: false,
      dialogSobreMkt: false,
      dialogTeamDev: false,
      dialogContato: false,
      dialogSubMenu: false,
      dialogoCotacoes: false,
      dialogExcluir: false,
      dialogSemUsuario: false,
      dialogLogin: false,

      produtosTodos: [],
      categoria: [],
      marca: [],
      produtosCotacao: [],

      dialogCarregandoDados: false,
      textCarregandoDados: "",

      busca: "",

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
          src: require("@/assets/SLD1.jpg"),
          text: "TESTE"
        },
        {
          src: require("@/assets/SLD2.jpg"),
          text: "TESTE"
        },
        {
          src: require("@/assets/SLD3.jpg"),
          text: "TESTE"
        }
      ],

      itemsMenuAcesso: [],

      dadosUsuLogado: [],
      usuario: {
        id: null,
        email: null,
        senha: null,
        idCliente: null,
        nome: null,
        sobrenome: null
      }
    };
  },

  methods: {
    on() {},

    opcaoMenuAcesso(opcao) {
      if (opcao == "MINHA CONTA") {
        this.login();
      }

      if (opcao == "SAIR") {
        sessionStorage.clear();
        this.colors = "blue";
        this.timeout = 5000;
        this.snack("center", "center");
        this.text =
          "Obrigado por utilizar o MarketPeças. Volte sempre que precisar.";
        this.error = true;
        this.mensagemBotaoAcesso = "ENTRE OU CADASTRE-SE";
        this.flagverificaUsu = null;
        this.initialize();
      }
    },

    msgAlertCamposPreenchidos() {
      this.colors = "warning";
      this.timeout = 5000;
      this.snack("bottom", "center");
      this.text =
        "Ops! Há campos brigatórios não preenchidos, ou algum dado informado está maior que o permitido para o campo.";
      this.error = true;
    },

    msgAlertCamposPreenchidosUsuario() {
      this.colors = "warning";
      this.timeout = 5000;
      this.snack("bottom", "center");
      this.text = "Ops! Informe seu e-email e senha para realizar o login.";
      this.error = true;
    },

    validacaoCamposPreenchidosUsuario() {
      if (
        this.usuario.email == "" ||
        this.usuario.email == null ||
        (this.usuario.email.length <= 0 || this.usuario.email.length > 100)
      ) {
        this.msgAlertCamposPreenchidosUsuario();
        return true;
      }

      if (
        this.usuario.senha == "" ||
        this.usuario.senha == null ||
        (this.usuario.senha.length <= 0 || this.usuario.senha.length > 100)
      ) {
        this.msgAlertCamposPreenchidosUsuario();
        return true;
      }
    },

    modalLogin() {
      this.dialogLogin = true;
    },

    acessar: function() {
      if (!this.validacaoCamposPreenchidosUsuario()) {
        sessionStorage.clear();
        axios
          .post("/validaUsuario", this.usuario)
          .then(response => {
            if (response.data[0].usuario.length > 0) {
              if (response.data[0].usuario[0].tipo_pessoa == "F") {
                this.text = response.data[0].mensagem;
                this.colors = "green";
                this.snack("top", "center");
                sessionStorage.clear();
                sessionStorage.setItem(
                  "usuario",
                  JSON.stringify(response.data[0].usuario)
                );
                this.usuario.id = response.data[0].usuario[0].id;
                this.carregarDadosCliente();
                this.flagverificaUsu = 1;
                this.listarOpcoesMenuAceso();
                this.dialogLogin = false;
                this.dialogSemUsuario = false;
              } else {
                this.colors = "error";
                this.timeout = 2000;
                this.snack("bottom", "center");
                this.text =
                  "Usuário informado invalido ou não é um cliente cadastrado.";
                this.error = true;
                sessionStorage.clear();
                return;
              }
            } else {
              sessionStorage.clear();
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
    verificaQuantidadeProdutos: function() {
      for (let i = 0; i < this.produtosCotacao.length; i++) {
        //cotacao
        for (let j = 0; j < this.cotacaoDados.length; j++) {
          //produtos cotacao
          for (
            let k = 0;
            k < this.cotacaoDados[j].produtosCotacao.length;
            k++
          ) {
            if (
              this.produtosCotacao[i].descricao ==
              this.cotacaoDados[j].produtosCotacao[k].descProduto
            ) {
              this.cotacaoDados[j].produtosCotacao[
                k
              ].quantidade = this.produtosCotacao[i].quantidade;
            }
          }
        }
      }
    },
    somaTotalCotacaoProduto() {
      for (let j = 0; j < this.cotacaoDados.length; j++) {
        //produtos cotacao
        for (let k = 0; k < this.cotacaoDados[j].produtosCotacao.length; k++) {
          this.cotacaoDados[j].produtosCotacao[k].totalProduto =
            parseFloat(this.cotacaoDados[j].produtosCotacao[k].quantidade) *
            parseFloat(this.cotacaoDados[j].produtosCotacao[k].valor);

          this.cotacaoDados[j].totalProdutosCotacao =
            parseFloat(this.cotacaoDados[j].totalProdutosCotacao) +
            parseFloat(this.cotacaoDados[j].produtosCotacao[k].totalProduto);
        }
      }
    },

    ordenarCotacaoMenorValor() {
      this.cotacaoDados.sort(function(a, b) {
        if (a.totalProdutosCotacao > b.totalProdutosCotacao) {
          return 1;
        }
        if (a.totalProdutosCotacao < b.totalProdutosCotacao) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
    },
    gerarCotacao() {
      if (this.produtosCotacao.length > 0) {
        this.dialogCarregandoDados = true;
        this.textCarregandoDados = "Gerando cotação dos Produtos selecionados.";

        let cotacao = "";
        let produtosCot = [];

        for (let i = 0; i < this.produtosCotacao.length; i++) {
          if (i < this.produtosCotacao.length - 1) {
            cotacao = cotacao.concat(
              "'" + this.produtosCotacao[i].descricao + "',"
            );
          } else {
            cotacao = cotacao.concat(
              "'" + this.produtosCotacao[i].descricao + "'"
            );
          }
        }

        produtosCot.push({
          descricao: cotacao
        });

        axios
          .post("/cotacao", produtosCot)
          .then(response => {
            this.cotacaoDados = [];
            this.cotacaoDados = response.data;
            this.dialogCarregandoDados = false;

            this.verificaQuantidadeProdutos();
            this.somaTotalCotacaoProduto();
            this.ordenarCotacaoMenorValor();
          })
          .catch(e => {
            console.log(e);
          });
      }
    },

    salvarCotacao() {
      this.dadosUsuLogado = JSON.parse(sessionStorage.getItem("usuario"));
      if (this.dadosUsuLogado == null) {
        this.dialogSemUsuario = true;
      } else {
        this.dadosUsuLogado = JSON.parse(sessionStorage.getItem("usuario"));
        this.usuario.id = this.dadosUsuLogado[0].idUsuario;

        axios
          .get("/pesquisaUsuarioClienteId/" + this.dadosUsuLogado[0].idUsuario)
          .then(response => {
            this.usuario.email = this.dadosUsuLogado[0].email;
            this.usuario.idCliente = response.data[0].idCliente;
            this.usuario.nome = response.data[0].nome;
            this.usuario.senha = null;
            this.usuario.sobrenome = response.data[0].sobrenome;
            axios
              .post("/cotacaoregistrar", {
                cliente: this.usuario,
                cotacao: this.cotacaoDados
              })
              .then(response => {
                this.dialogoCotacoes = false;
                this.dialogExcluir = false;
                this.cotacaoDados = [];
                this.produtosCotacao = [];

                this.colors = "green";
                this.timeout = 2000;
                this.snack("bottom", "center");
                this.text = "Cotação Salva com sucesso.";
                this.error = true;
                // if (response.data[0].produto.length > 0) {
                //   this.text = response.data[0].mensagem;
                //   this.colors = "blue";
                //   this.snack("top", "right");
                // }
              })
              .catch(e => {
                console.log(e);
              });
          })
          .catch(e => {
            console.log(e);
          });
      }
    },
    cancelarCotacao() {

      for (let i = 0; i < this.produtosCotacao.length; i++) {
        this.produtosCotacao[i].quantidade = 0;
      }
      this.produtosCotacao = [];
      this.cotacaoDados = [];
      this.colors = "info";
      this.timeout = 2000;
      this.snack("bottom", "center");
      this.text = "Todos os produtos foram excluídos da Cotação.";
      this.error = true;
      this.dialogoCotacoes = false;
      this.dialogExcluir = false;

    },

    increment(item) {
      for (let i = 0; i < this.produtosCotacao.length; i++) {
        if (parseInt(item.id) == parseInt(this.produtosCotacao[i].id)) {
          this.produtosCotacao[i].quantidade =
            parseInt(this.produtosCotacao[i].quantidade, 10) + 1;
            this.gerarCotacao();
        }
      }
    },
    decrement(item) {
      for (let i = 0; i < this.produtosCotacao.length; i++) {
        if (parseInt(item.id) == parseInt(this.produtosCotacao[i].id)) {
          this.produtosCotacao[i].quantidade =
            parseInt(this.produtosCotacao[i].quantidade, 10) - 1;

            if (parseInt(this.produtosCotacao[i].quantidade) <= 0){
              this.colors = "error";
                this.timeout = 2000;
                this.snack("bottom", "center");
                this.text = "Ops! Quantidade inválida. Não é permitido quantidade inferior a 1.";
                this.error = true;
                this.produtosCotacao[i].quantidade = 1;
                return;
               
            }
            else{
              this.gerarCotacao();
              
            }
           
        }
      }
    },

    cotacoes() {
      if (this.produtosCotacao.length == 0) {
        this.colors = "warning";
        this.timeout = 2000;
        this.snack("bottom", "center");
        this.text = "Ops. Ainda Não há produtos inseridos a cotação.";
        this.error = true;
      } else {
        this.dialogoCotacoes = true;
        this.gerarCotacao();
      }
    },

    verificaProdutosInseridosCotacao(item) {
      for (let i = 0; i < this.produtosCotacao.length; i++) {
        if (parseInt(item.id) == parseInt(this.produtosCotacao[i].id)) {
          return true;
        }
      }
    },

    removerItemCotacao(item) {
      for (let i = 0; i < this.produtosCotacao.length; i++) {
        if (this.produtosCotacao[i].id === item.id) {
          this.produtosCotacao.splice(i, 1);
        }
      }

      this.colors = "info";
      this.timeout = 2000;
      this.snack("bottom", "center");
      this.text = "Produto excluído da cotação.";
      this.error = true;

      this.gerarCotacao();
      this.somaTotalCotacaoProduto();

      if (this.produtosCotacao.length == 0) {
        this.dialogoCotacoes = false;
      }
     
    },

    addProdutoCotacao(item) {
      if (this.verificaProdutosInseridosCotacao(item) == true) {
        for (let i = 0; i < this.produtosCotacao.length; i++) {
          if (parseInt(item.id) == parseInt(this.produtosCotacao[i].id)) {
            this.produtosCotacao[i].quantidade =
              parseInt(this.produtosCotacao[i].quantidade) + 1;
          }
        }
      } else {
        item.quantidade = parseInt(item.quantidade) + 1;
        this.produtosCotacao.push(item);
      }

      if (this.produtosCotacao.length == 0) {
        item.quantidade = parseInt(item.quantidade) + 1;
        this.produtosCotacao.push(item);
      }

      this.colors = "info";
      this.timeout = 2000;
      this.snack("bottom", "center");
      this.text = "Produto adicionado com sucesso a cotação.";
      this.error = true;
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
    sobreMktpecas() {
      this.dialogSobreMkt = true;
    },

    teamDev() {
      this.dialogTeamDev = true;
    },

    contato() {
      this.dialogContato = true;
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

    login() {
      if (this.usuario.idCliente != null) {
        this.acessaMenuCliente();
      } else {
        sessionStorage.clear();
        this.$router.push({ path: "/LoginCadastroUsuario" });
      }
    },

    loginSemUsuLogado() {
      sessionStorage.clear();
      this.$router.push({ path: "/LoginCadastroUsuario" });
    },

    todosProdutos() {
      this.dialogCarregandoDados = true;
      this.textCarregandoDados = 'Carregando os produtos...'
      
      axios
        .get("/produtotodos")
        .then(response => {
          if (response.data.length > 0) {
            this.produtosTodos = [];
            this.produtosTodos = response.data;
             this.dialogCarregandoDados = false;
          }
        })
        .catch(e => {
          console.log(e);
        });
    },

    carregarDadosCliente() {
      axios
        .get("/pesquisaUsuarioClienteId/" + this.usuario.id)
        .then(response => {
          this.usuario.idCliente = response.data[0].idCliente;
          this.usuario.nome = response.data[0].nome;
          this.usuario.senha = null;
          this.usuario.sobrenome = response.data[0].sobrenome;

          this.mensagemBotaoAcesso =
            "OLÁ " + this.usuario.nome + " BEM-VINDO(A)";
          this.flagverificaUsu = 1;
        })
        .catch(e => {
          console.log(e);
        });
    },

    produtosOferta() {
      this.dialogCarregandoDados = true;
      this.textCarregandoDados = 'Carregando produtos em oferta...'
      axios
        .get("/produtooferta")
        .then(response => {
          if (response.data.length > 0) {
            this.produtosTodos = [];
            this.produtosTodos = response.data;
            this.dialogCarregandoDados = false;
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

    listarOpcoesMenuAceso() {
      this.itemsMenuAcesso = [];

      this.itemsMenuAcesso.push(
        { id: 1, opcao: "MINHA CONTA" },
        {
          id: 2,
          opcao: "SAIR"
        }
      );
    },

    listarItemCategoria(categoria) {
      this.dialogCarregandoDados = true;
      this.textCarregandoDados = 'Carregando os produtos da categoria ...' + categoria 
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

    listarItemBusca() {
      axios
        .post("/buscarproduto", { busca: this.busca })
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
      this.dialogCarregandoDados = true;
      this.textCarregandoDados = 'Carregando os produtos da marca... ' + marca
      axios
        .post("/produtomarca", { marca: marca })
        .then(response => {
          this.produtosTodos = [];
          this.produtosTodos = response.data;
          this.dialogCarregandoDados = false;
        })
        .catch(e => {
          console.log(e);
        });
    },

    initialize() {
      if (JSON.parse(sessionStorage.getItem("usuario") == null)) {
        sessionStorage.clear();
        console.log("nao ha usuario logado");
      } else if (JSON.parse(sessionStorage.getItem("usuario") != null)) {
        console.log("usuario logado");
        let verUsuLogado = [];
        verUsuLogado = JSON.parse(sessionStorage.getItem("usuario"));

        if (verUsuLogado[0].idCliente != undefined) {
          if (verUsuLogado[0].idCliente != "") {
            this.flagverificaUsu = 1;
            console.log("é um cliente");
            this.usuario.id = verUsuLogado[0].idUsuario;
            this.carregarDadosCliente();
            this.listarOpcoesMenuAceso();
          }
        }

        if (verUsuLogado[0].idEmpresa != undefined) {
          if (verUsuLogado[0].idEmpresa != "") {
            this.flagverificaUsu = 2;
            console.log("é uma empresa");
            //this.listarOpcoesMenuAceso = [];
            sessionStorage.clear();
          }
        }
      }

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