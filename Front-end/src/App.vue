<template>
  <div id="app">
    <router-view />
    <!-- <va-footer /> -->
  </div>
</template>

<script>
import Vue from 'vue'
import Vuetify from 'vuetify'
import VAFooter from "@/components/Footer";

export default {
  name: 'App',

  components: {
    "va-footer": VAFooter
  },
}
</script>

<style>
</style>
