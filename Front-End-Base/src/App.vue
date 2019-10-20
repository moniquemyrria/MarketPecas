<template>
  <v-app>
    <core-app-bar />

    <!-- <core-drawer/> -->

    <core-view />

    <core-footer />
  </v-app>
</template>

<script>
export default {
  components: {
    CoreDrawerEmpresa: () => import("@/components/core/DrawerEmpresa"),
    CoreDrawer: () => import("@/components/core/Drawer"),
    CoreFooter: () => import("@/components/core/Footer"),
    CoreAppBar: () => import("@/components/core/AppBar"),
    CoreView: () => import("@/components/core/View")
  },

  data() {
    return {
      
    };
  },

  
};
</script>


