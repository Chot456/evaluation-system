<template>
  <v-app>
    <AppBar/>
    <!-- <SideBar/> -->
    <Content/>
  </v-app>
</template>


<script>

export default {
  name: "MainPortal",
    components: { 
         AppBar: () => import('./Layouts/AppBar'), 
          // SideBar: () => import('./Layouts/SideBar'), 
          Content: () => import('./Layouts/Content'), 
       },

};
</script>
