<template>
    <div>
        <b-nav>
            <b-nav-item><router-link to="/Cadastro">Cadastro</router-link></b-nav-item>
            <b-nav-item><router-link to="/Listar">Listar</router-link></b-nav-item>
        </b-nav>
        <router-view/>
        
    </div>
</template>

<script>
export default {
  name: "Menu"
};
</script>


<style scoped>
</style>
