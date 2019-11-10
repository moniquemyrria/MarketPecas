<template>
  <div>
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
            <br />
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
      <v-footer app color="grey lighten-2" padless>
        <v-row justify="center" no-gutters>
          <!-- <v-btn v-for="link in links" :key="link" color="#6D6D6D" text class="my-1">{{ link }}</v-btn> -->
          <v-btn @click="marketPecas" color="#6D6D6D" text class="my-1">MARKETPEÇAS</v-btn>
          <v-btn @click="sobreMktpecas" color="#6D6D6D" text class="my-1">SOBRE MARKETPEÇAS</v-btn>
          <v-btn @click="teamDev" color="#6D6D6D" text class="my-1">TEAM DEV</v-btn>
          <v-btn @click="contato" color="#6D6D6D" text class="my-1">SOCIAL</v-btn>
          <v-col class="grey lighten-1 py-1 text-center" style="color: #6D6D6D" cols="12">
            © Todos os Direitos Reservados |
            <strong>MarketPeças</strong>
          </v-col>
        </v-row>
      </v-footer>
    </v-app>
  </div>
</template>

<script>
import axios from "../axios/client";
import Vue from "vue";
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.css";

export default {
  name: "va-footer",
  vuetify: new Vuetify(),
  vue: new Vue(),
  data() {
    return {
      links: [
        "Site MarcketPeças",
        "Sobre o MarketPeças",
        "Team Dev",
        "Facebook",
        "Contato"
      ],

      dialogSobreMkt: false,
      dialogTeamDev: false,
      dialogContato: false
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

    marketPecas() {
      this.$router.push({ path: "/" });
    }
  }
};
</script>


<style scoped>
.something {
  color: var(--v-primary-base);
  background-color: var(--v-accent-lighten2);
}
</style>
