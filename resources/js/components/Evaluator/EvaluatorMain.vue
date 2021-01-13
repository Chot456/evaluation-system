<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-container fluid>
          <v-row class="fill-height">
            <v-col>
              <div>Student Number: {{ this.questiondata.data[0].studId}}</div>
              <div>Student Name:  {{ this.questiondata.data[0].firstName + this.questiondata.data[0].lastName }} </div>
              <div>Number of Instructor to evaluate: 5</div>
              <div>Course/ Year. Section:  {{ this.questiondata.data[0].courseDescription}} / 
              {{ this.questiondata.data[0].yearDescription}} {{ this.questiondata.data[0].section_code}}  </div>
            </v-col>
            <v-col>
               <img  src="../../../../storage/app/public/img/sansebastiancollege.png">
            </v-col>
          </v-row>
          <v-divider></v-divider>
          <v-card
            outlined
            color="transparent"
            v-for="(profdata, i) in profevaluatedata"
            :key="i"
          >
            <v-row>
              <v-col>
                <div>
                  {{ profdata.subjCode }}
                </div>
                <div>
                  {{ profdata.instructortype }}
                </div>
                <div>
                  {{ profdata.instrucname }}
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
        axios.get("http://localhost:8080/evaluation-system/public/api/student/S0001" , config).then(data => {
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
        axios.get("http://localhost:8080/evaluation-system/public/api/getRecordsToEvaluate/S0001" , config).then(data => {
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