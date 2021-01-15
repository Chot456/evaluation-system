<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-container fluid>
          <v-row class="fill-height">
            <v-col>
              <div>Student Number: {{ this.questiondata[0].studid }}</div>
              <div>
                Student Name:
                {{
                  this.questiondata[0].firstname +
                  " " +
                  this.questiondata[0].lastname
                }}
              </div>
              <div>
                Number of Instructor to evaluate:{{
                  this.profevaluatedata.data.length
                }}
              </div>
              <div>
                Course/ Year {{ this.questiondata[0].coursedescription }} /
                {{ this.questiondata[0].yeardescription }}
              </div>
            </v-col>
            <v-col>
              <!-- <img  src="../../../../storage/app/public/img/sansebastiancollege.png"> -->
            </v-col>
          </v-row>
          <v-divider></v-divider>
          <v-card
            outlined
            color="transparent"
            v-for="(profdata, i) in profevaluatedata.data"
            :key="i"
          >
            <v-row>
              <v-col>
                <div>
                  {{ profdata.section_code }}
                </div>
                <div>
                  {{ profdata.userTypeDescription }}
                </div>
                <div>{{ profdata.firstname }} {{ profdata.lastname }}</div>
              </v-col>
              <v-col>
                <router-link :to="{ name: 'EvaluateProf' }">
                  <v-btn
                    class="float-right mt-7 m-10"
                    depressed
                    color="primary"
                  >
                    Evaluate
                  </v-btn>
                </router-link>

                <button
                  @click="route(profdata.studId , profdata.subjCode, profdata.user_type_id, profdata.firstname + profdata.lastname  )"
                >
                  aasdasasdasdadasdasda11111123asdasdasdasd asdasdasd
                </button>
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
import axios from "axios";

export default {
  name: "MainPortal",
  components: {},

  created() {
    this.getStudentSession();


      this.getstudrecordbyid();
      this.getprofevaluate();

  },

  methods: {  
    route(name, subjCode , usertype, fullname) {
      debugger;
      this.$router.push({
        name: "EvaluateProf",
        params: { id: name, subjCode: subjCode, usertype: usertype ,  fullname},
        props: true,
      });
    },

    getStudentSession: function () {
      // var snum = JSON.stringify({ snum :  "PH20080105"});

      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get(
          "http://localhost:8080/evaluation-system/public/getSession",
          config
        )
        .then((data) => {
          console.log(data.data);
          this.sessiondata = data.data;
          this.studId = this.sessiondata[0].studId
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },  

    getstudrecordbyid: function () {
      // var snum = JSON.stringify({ snum :  "PH20080105"});
      debugger;

      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get(
          "http://localhost:8080/evaluation-system/public/api/student/" +
            this.studId,
          config
        )
        .then((data) => {
          console.log(data.data);
          this.questiondata = data.data;
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },

    getprofevaluate: function () {
      // var snum = JSON.stringify({ snum :  "PH20080105"});

      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get(
          "http://localhost:8080/evaluation-system/public/api/getRecordsToEvaluate/S100",
          config
        )
        .then((data) => {
          console.log(data.data);
          this.profevaluatedata = data.data;
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },
  },

  data: () => ({
    dialog: false,
    questiondata: [],
    sessiondata: String,
    profevaluatedata: [],
    studId: "",
    usersessiondata: [],
  }),
};
</script>