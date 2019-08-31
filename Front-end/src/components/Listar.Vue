<template>
    <div>
    <h3>Lista de produtos</h3>
    <b-table striped hover :items="items" :fields="fields">
        <span slot="marcar" slot-scope="data" >     
            <input type="checkbox" v-model="selecionados" :value="data.item.id">
      </span>
        <span slot="alterar" slot-scope="data" >     
            <router-link :to="{path:'/Alterar/'+data.item.id}">Alterar</router-link>
      </span>
    </b-table>

        Produtos selecionados: {{selecionados}}<br>
        <button @click.stop.prevent="deletar" type="button" class="btn btn-danger">Deletar</button>
    </div>
</template>

<script>
import axios  from "../axios/client";
export default {
  data() {
    return {
      selecionados: [],
      fields: [
        { key: "marcar", label: "" },
        "codigo",
        "nome",
        "quantidade",
        "valor",
        { key: "alterar", label: "Ações" }
      ],
      items: []
    };
  },
  methods: {
    deletar: function() {
      if (this.selecionados.length) {
        for (let i = 0; i < this.selecionados.length; i++) {
          axios
            .delete(
              "/produtos/" + this.selecionados[i]
            )
            .then(response => {
              if (i == this.selecionados.length - 1) {
                this.selecionados = [];
                this.items = [];
                axios
                  .get("/produtos")
                  .then(response => {
                    for (let i = 0; i < response.data.length; i++) {
                      this.items.push({
                        id: response.data[i].id,
                        codigo: response.data[i].codigo,
                        nome: response.data[i].nome,
                        quantidade: response.data[i].quantidade,
                        valor: response.data[i].valor
                      });
                    }
                  })
                  .catch(e => {
                    console.log(e);
                  });
              }
            });
        }
      }
    }
  },
  created() {
    axios
      .get("/produtos")
      .then(response => {
        for (let i = 0; i < response.data.length; i++) {
          this.items.push({
            id: response.data[i].id,
            codigo: response.data[i].codigo,
            nome: response.data[i].nome,
            quantidade: response.data[i].quantidade,
            valor: response.data[i].valor
          });
        }
      })
      .catch(e => {
        console.log(e);
      });
  }
};
</script>

<style scoped>
</style>
