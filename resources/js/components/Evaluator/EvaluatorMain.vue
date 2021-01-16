<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-container fluid>
          <v-row class="fill-height">
            <v-col>
              <div>
              <div>Student Number: {{ evaluteinfodata.data[0].studid }}</div>

              <div>
                Student Name:
                {{
                  evaluteinfodata.data[0].firstname +
                  " " +
                  evaluteinfodata.data[0].lastname
                }}
              </div> 
              <div>
                Number of Instructor to evaluate:{{
                  profevaluatedata.data.length
                }}
              </div>
               <div>
                Course/ Year :{{ evaluteinfodata.data[0].coursedescription }} /
                {{ evaluteinfodata.data[0].yeardescription }}
              </div>
              <div>
                 Professor Name: 
              </div>
                <!-- <template  v-for="(studentinfo, i) in evaluteinfodata.data">
              <div>Student Number: {{ studentinfo.studid }}</div>
              <div>
                Student Name:
                {{
                  studentinfo.firstname +
                  " " +
                  studentinfo.lastname
                }}
              </div> 
              <div>
                Number of Instructor to evaluate:{{
                  profevaluatedata.data.length
                }}
              </div>
               <div>
                Course/ Year {{ studentinfo.coursedescription }} /
                {{ studentinfo.yeardescription }}
              </div>
              </template> -->
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
            v-if="profdata"
            :key="i"
          >
            <v-row>
              <v-col>
                <div>
                  {{ profdata.subjCode }}
                </div>
                <div>
                  {{ profdata.userTypeDescription }}
                </div>
                <div>{{ profdata.firstname }} {{ profdata.lastname }}</div>
              </v-col>
              <v-col>

                  <v-btn
                    class="float-right mt-7 m-10"
                    depressed
                    color="primary"
                     @click="route(profdata.studId , profdata.subjCode, profdata.user_type_id, profdata.firstname + profdata.lastname, profdata.id , profdata.empid, profdata.evalid, profdata.userTypeDescription )"
                  >
                    Evaluate
                  </v-btn>


              </v-col>
            </v-row>
            <v-divider></v-divider>
          </v-card>
          <v-card  v-else>
            No professor to evaluate
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

  },


  methods: {  
    route(name, subjCode , usertype, fullname,id, empid, evalid, userTypeDescription) {
      debugger;
      this.$router.push({
        name: "EvaluateProf",
        params: { id: name, subjCode: subjCode, usertype: usertype ,  fullname : fullname, eval :id, empid: empid, evalid: evalid, userTypeDescription : userTypeDescription},
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
          this.studId = this.sessiondata[0].studId;

                  this.$nextTick(()=> {
             this.getstudrecordbyid();
         this.getprofevaluate();
         });
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
          this.evaluteinfodata = data.data;

          
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },

    getprofevaluate: function () {
      // var snum = JSON.stringify({ snum :  "PH20080105"});
  debugger;
      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };

      axios
        .get(
          "http://localhost:8080/evaluation-system/public/api/getRecordsToEvaluate/" + this.studId , 
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
    evaluteinfodata: [],
    sessiondata: String,
    profevaluatedata: [],
    studId: "",
    usersessiondata: [],
  }),
};
</script>