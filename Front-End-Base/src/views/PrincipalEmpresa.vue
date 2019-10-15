<template>
  <v-app>
    
      <core-drawerEmpresa/>
    
  </v-app>
</template>

<script>
// Utilities


export default {
  

  components: {
    CoreDrawerEmpresa: () => import("@/components/core/DrawerEmpresa"),
    CoreDrawer: () => import("@/components/core/Drawer"),
    CoreFooter: () => import("@/components/core/Footer"),
    CoreAppBar: () => import("@/components/core/AppBar"),
    CoreView: () => import("@/components/core/View")
  },

  created() {
     
  },
  
};
</script>
