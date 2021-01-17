<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1200">
        <v-container fluid>
          <v-row class="fill-height">
            <v-col>
              <div v-for="(evalinfo, i) in evaluteinfodata" >
              <div v-if="evalinfo.studId !== null">
              <div>Student Number: {{ evalinfo.studId }}</div>

              <div>
                Student Name:
                {{
                  evalinfo.firstName +
                  " " +
                  evalinfo.lastName
                }}
              </div> 
                  <div>
                Course/ Year :{{ evalinfo.courseDescription }} /
                {{ evalinfo.yearDescription }}
              </div>
              </div>
           
                 <div v-else> Professor Name: {{
                  evalinfo.firstname +
                  " " +
                  evalinfo.lastname
                }}
                 </div>
                                <div>
                Role: {{ evalinfo.roles }} 
              </div>
                   <div>
              </div>

                <!-- <div>
                Number of Instructor to evaluate:{{
                  profevaluatedata.data.length
                }}
              </div> -->

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
                   ID: {{ profdata.evalid }}
                </div>
                <div>
    
                  Subject Code: {{ profdata.subjCode }}
                </div>
                <div>
                  Role: {{ profdata.userTypeDescription }}
                </div>
                <div> Professor Name: {{ profdata.firstname }} {{ profdata.lastname }}</div>
              </v-col>
              <v-col>

                  <v-btn
                    class="float-right mt-7 m-10"
                    depressed
                    color="primary"
                     @click="route(profdata.evalid , profdata.subjCode, profdata.user_type_id, profdata.firstname + profdata.lastname, profdata.id , profdata.empid, profdata.evalid, profdata.userTypeDescription, userid )"
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
    route(name, subjCode , usertype, fullname,id, empid, evalid, userTypeDescription, userid ) {

      var uid = parseInt(userid);

      this.$router.push({
        name: "EvaluateProf",
        params: { id: name, subjCode: subjCode, usertype: usertype ,  fullname : fullname, eval :id, empid: empid, evalid: evalid, userTypeDescription : userTypeDescription, userid : uid},
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
          this.userid = this.sessiondata[0].user_id;
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
        

      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get(
          // "http://localhost:8080/evaluation-system/public/api/student/" +
          //   this.studId,
          "http://localhost:8080/evaluation-system/public/api/user/" + this.userid,
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
    
      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };

      axios
        .get(
          "http://localhost:8080/evaluation-system/public/api/getRecordsToEvaluate/" + this.userid , 
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
    userid: Number,
    usersessiondata: [],
  }),
};
</script>