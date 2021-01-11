<template>
  <v-app id="inspire">

  <AppBar/>
  <SideBar/>


		<router-view></router-view>



  </v-app>
</template>

<script>

import SideBar from "../Layouts/SideBar.vue";
import AppBar from "../Layouts/AppBar.vue";

export default {

  components: {
	SideBar,
	AppBar
  }

};
</script>
