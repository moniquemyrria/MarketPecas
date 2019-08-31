<template>
    <div>
        <div v-if="$route.params.id">
          <router-link to="/Listar">Voltar</router-link>
          <h3>Alterar produto - {{form.nome}}</h3>
        </div>
        <div v-else>
        </div>
        <b-form @reset="onReset">
            <b-form-group id="codigo"
                            label="Codigo:"
                            label-for="codigoInput"
                            description="Codigo do produto">
                <b-form-input id="codigoInput"
                            type="text"
                            v-model="form.codigo"
                            required
                            placeholder="Enter codigo">
                </b-form-input>
            </b-form-group>
            <b-form-group id="nome"
                            label="Name:"
                            label-for="nomeInput">
                <b-form-input id="nomeInput"
                            type="text"
                            v-model="form.nome"
                            required
                            placeholder="Enter name">
                </b-form-input>
            </b-form-group>
            <b-form-group id="quantidade"
                            label="Quantidade:"
                            label-for="quantidadeInput">
                <b-form-input id="quantidadeInput"
                            type="number"
                            v-model="form.quantidade"
                            required
                            placeholder="Enter quantidade">
                            </b-form-input>
            </b-form-group>
            <b-form-group id="valor"
                            label="Valor:"
                            label-for="valorInput">
                <b-form-input id="valorInput"
                            type="number" step="0.01"
                            v-model="form.valor"
                            required
                            placeholder="Enter value">
                            </b-form-input>
            </b-form-group>
            <div v-if="!$route.params.id">
              <b-button type="button"  @click.stop.prevent="cadastrar" variant="primary">Cadastro</b-button>
            </div>
            <div v-else>
              <b-button type="button" @click.stop.prevent="alterar" variant="primary">Alterar</b-button>
            </div>
            
              <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
    </div>
</template>

<script>
import axios  from "../axios/client";
export default {
  name: "Formulario",
  data() {
    return {
      form: {
        codigo: "",
        nome: "",
        valor: "",
        quantidade: ""
      }
    };
  },

  methods: {
    cadastrar: function() {
      event.preventDefault();
      console.log(JSON.stringify(this.form));
      axios
        .post(
          "/produtos",
          JSON.stringify(this.form)
        )
        .then(response => {
          this.$router.push("/Listar");
        })
        .catch(e => {
          console.log(e);
        });
    },
    alterar: function() {
      event.preventDefault();
      console.log(JSON.stringify(this.form));
      axios
        .put(
          "/produtos/" + this.$route.params.id,
          JSON.stringify(this.form)
        )
        .then(response => {
          this.$router.push("/Listar");
        })
        .catch(e => {
          console.log(e);
        });
    },
    onReset: function() {
      event.preventDefault();
      this.form.codigo = "";
      this.form.nome = "";
      this.form.quantidade = "";
      this.form.valor = "";
    }
  },

  created() {
    if (this.$route.params.id) {
      axios
        .get("/produtos/" + this.$route.params.id)
        .then(response => {
          this.form.id = response.data.id;
          this.form.codigo = response.data.codigo;
          this.form.nome = response.data.nome;
          this.form.quantidade = response.data.quantidade;
          this.form.valor = response.data.valor;
        })
        .catch(e => {
          console.log(e);
        });
    }
  }
};
</script>

<style scoped>
</style>
