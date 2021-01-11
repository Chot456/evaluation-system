<template>
  <v-app>
    <AppBar/>
    <slot/>
    <SideBar/> 
  </v-app>
</template>


<script>
import AppBar from '../Layouts/AppBar.vue';
import SideBar from '../Layouts/SideBar.vue';
export default {
  name: "MainPortal",
    components: { 
         AppBar,
         SideBar
       },

};
</script>
