<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-toolbar color="main" dark>
      

          <v-toolbar-title>View Comments</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
        <v-container fluid>

          <v-row class="fill-height">
            <v-col>
              <transition name="fade">
     <v-data-table
    :headers="headers"
    :items="desserts"
    :items-per-page="5"
    class="elevation-1"
  ></v-data-table>
              </transition>
            </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-content>
  </v-app>
</template>
<script>
  export default {
    data () {
      return {
        headers: [
          {
            text: 'No.',
            align: 'start',
            sortable: false,
            value: 'name',
          },
          { text: 'Comments / Suggestion', value: 'calories' },
          { text: 'Subject', value: 'fat' },
   
        ],
        desserts: [
          {
            name: 1,
            calories: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s',
            fat: "SSC1",
            carbs: 2,
            protein: 4.,
            iron: 1,
          },
          {
            name: 2,
            calories: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s',
             fat: "SSC1",
          },
          {
            name: 4,
            calories: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s',
             fat: "SSC1",
           
          },
          {
            name: 5,
           calories: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s',
             fat: "SSC1",
          },
          {
            name: 6,
            calories: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s',
            fat: "SSC1",
            carbs: 49,
            protein: 3.9,
            iron: '16%',
          },
        ],
      }
    },
  }
</script>