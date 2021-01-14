<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-container fluid>
          <v-row class="fill-height">
            <v-col>
              <div>Student Number: {{ this.questiondata.data[0].studid }}</div>
              <div>Student Name:  {{ this.questiondata.data[0].firstname + " " + this.questiondata.data[0].lastname }} </div>
              <div>Number of Instructor to evaluate:{{ this.profevaluatedata.data.length}} </div>
              <div>Course/ Year {{ this.questiondata.data[0].coursedescription}} / 
              {{ this.questiondata.data[0].yeardescription}}  </div>
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
                <div>
                  {{ profdata.firstname }}      {{ profdata.lastname }}
                </div>
              </v-col>
              <v-col>
  
                <router-link :to="{ name: 'EvaluateProf'   }" >
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
import axios from 'axios';

export default {
  name: "MainPortal",
  components: {},



    created(){
      this.getstudrecordbyid();
      this.getprofevaluate();
    },

           methods : {
      getstudrecordbyid: function() {
        // var snum = JSON.stringify({ snum :  "PH20080105"});
    
        let config  = {
          headers : {"Content-Type" : "application/x-www-form-urlencoded"}
        }
        axios.get("http://localhost:8080/evaluation-system/public/api/student/S100" , config).then(data => {
          console.log(data.data);
          this.questiondata = data.data;
        }).catch(err => {
          alert("Error :" + err)
        });
      },

            getprofevaluate: function() {
        // var snum = JSON.stringify({ snum :  "PH20080105"});

        let config  = {
          headers : {"Content-Type" : "application/x-www-form-urlencoded"}
        }
        axios.get("http://localhost:8080/evaluation-system/public/api/getRecordsToEvaluate/S100" , config).then(data => {
          console.log(data.data);
          this.profevaluatedata = data.data;
        }).catch(err => {
          alert("Error :" + err)
        });
      },
      
    },

  data: () => ({  
    dialog: false,
    questiondata: [],
    
    profevaluatedata: [],
    items: [
      {
        section: "REL301",
        instructortype: "Instructor",
        instrucname: "Limotan, Belan",
      },
      {
        section: "SSC101",
        instructortype: "Instructor",
        instrucname: "Cruz,",
      }
    ],
  }),
};
</script>