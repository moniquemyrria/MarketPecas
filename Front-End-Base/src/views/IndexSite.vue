
<template>
 
   
    <div id="indexsite">
    
      
      
      <v-container class="fill-height" fluid>
        <v-row justify="center">
          <v-col cols="12" md="8">
            <material-card color="primary" title="Tela Principal Site" text="Em desenvolvimento" />
          </v-col>
        </v-row>
      </v-container>
    </div>
 
</template>

<script>


export default {

   components: {
      CoreDrawer: () => import('@/components/core/Drawer'),
      CoreFooter: () => import('@/components/core/Footer'),
      CoreAppBar: () => import('@/components/core/AppBar'),
      CoreView: () => import('@/components/core/View'),
    },



};
</script>
