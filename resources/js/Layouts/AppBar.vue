<template lang="">
    <div>
        <v-card
    color="grey lighten-4"
    flat
    tile
  >
    <v-toolbar dense>

      <div class="mx-7" />
      <v-toolbar-title >ABC School</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>


        <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn @click="logout()"
           class="ml-2"
          dark
          v-bind="attrs"
          v-on="on"
        >
          <v-icon>mdi-account</v-icon>
        </v-btn>
      </template>
      <v-list>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
          :to="item.link"
        >
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
    </v-toolbar>
  </v-card>
  <div>

  </div>
    </div>
    
</template>
<script>
export default {
  data: () => ({
    items: [{ title: "Logout", link: "/logout" }],
  }),

  methods: {
    async logout() {
     await axios
        .get("/logout")
        .then((response) => {
          this.$router.push("/userLogin");
        })
        .catch((error) => {
          location.reload();
        });
    },
  },
};
</script>