<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-container fluid>
          <v-row class="fill-height">
            <v-col>
              <div>Student Number:</div>
              <div>Student Name:</div>
              <div>Number of Instructor to evaluate:</div>
              <div>Course/ Year. Section:</div>
            </v-col>
            <v-col>
              <img
                src="../../../../public/images/sansebastioncollege.png"
                
                height="150"
                width="150"
              />
            </v-col>
          </v-row>
          <v-divider></v-divider>
          <v-card
            outlined
            color="transparent"
            v-for="(item, i) in items"
            :key="i"
          >
            <v-row>
              <v-col>
                <div>
                  {{ item.section }}
                </div>
                <div>
                  {{ item.instructortype }}
                </div>
                <div>
                  {{ item.instrucname }}
                </div>
              </v-col>
              <v-col>
  
                <router-link :to="{ name: 'EvaluateProf'}" tag="v-btn">
                  <v-btn  class="float-right mt-7 m-10" depressed color="primary">
                   Evaluate
                  </v-btn>
                </router-link>
              </v-col>
            </v-row>
            <v-divider></v-divider>
          </v-card>
        </v-container>
      </v-card>
    </v-content>
  </v-app>
</template>

<script>
export default {
  name: "MainPortal",
  components: {},

  data: () => ({  
    dialog: false,
    items: [
      {
        section: "#1F7087",
        instructortype: "semipremium.jpg",
        instrucname: "Semi Premium Room",
      },
      {
        section: "#1F7087",
        instructortype: "semipremium.asd",
        instrucname: "Semi Premium Room",
      },
      {
        section: "#1F7087",
        instructortype: "semipremiumasd",
        instrucname: "Semi Premium Room",
      },
    ],
  }),
};
</script>