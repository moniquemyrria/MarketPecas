<template>
  <v-app>
    
      <core-drawer/>
    
  </v-app>
</template>

<script>
// Utilities


export default {
  

  components: {
    CoreDrawer: () => import("@/components/core/Drawer"),
    CoreFooter: () => import("@/components/core/Footer"),
    CoreAppBar: () => import("@/components/core/AppBar"),
    CoreView: () => import("@/components/core/View")
  },

  created() {
     
  },
  
};
</script>
