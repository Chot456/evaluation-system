<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-toolbar color="main" dark>
          <v-toolbar-title>Faculty Evaluuation</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
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
           
                 <div v-else> Professor Name:     {{
                  evalinfo.firstname +
                  " " +
                  evalinfo.lastname
                }} </div>
                                <div>
                Course: {{ evalinfo.courseDescription }} 
              </div>
                   <div>
              </div>

                <!-- <div>
                Number of Instructor to evaluate:{{
                  profevaluatedata.data.length
                }}
              </div> -->

              </div>
              <!-- <div>
                Student Number: {{ studentdetaildata.data[0].studid }}
              </div>
              <div>
                Student Name: {{ studentdetaildata.data[0].firstname }}
                {{ studentdetaildata.data[0].lastname }}
              </div>

              <div>Instructor: {{ studentdetaildata.data[0].employeefirstname }} {{ studentdetaildata.data[0].employeelastname }}</div>
              <div>Subject: {{ studentdetaildata.data[0].subjDesc }}</div> -->
            </v-col>
            <v-col> </v-col>
          </v-row>       
          <v-divider></v-divider>
          <v-row class="fill-height">
            <v-col>
              <h4 class="font-weight-bold">Evaluation</h4>
              <div class="ml-5">
                <span class="text-decoration-underline">Instructions :</span>
             

In this inventory you are asked to assess your instructor's
sepcific classroom behavior. Your instructor has requested this 
information for purposes of instructional analysis and improvement.
Please try to be both objective and candid in your responses so
as to maximize the value of the feedback.

Your Judgement should reflect that type of teaching you think is best
for this particular course and your particular learning style. Try To assess
each behaviour independetly rather than letting your overall impression
of the instructor determine each individual rating.

Each section of the inventory begins with a definition of the category of
teaching to be assessed in that section. For each specific teaching
behaviour, please indicate the frequency with which he/she exhibits the
behaviour in question. Please use the following rating scale ina making
your judgement.

5 = almost always
4 = often
3 = sometimes
2 = rarely
1= almost never
              </div>
            </v-col>
          </v-row>
          <!--
            <v-row>
              <v-col cols="4" >
                <v-text-field
                 class="ma-0 pa-0"
                  v-model="fname"
                  label="Student ID"
                  required
                ></v-text-field>
              </v-col>
              <v-col  cols="4">
                <v-text-field
                  class="ma-0 pa-0"
                  v-model="fname"
                  label="Batch"
                  required
                ></v-text-field>
              </v-col>
               <v-col  cols="4">
                <v-text-field
                 class="ma-0 pa-0"
                  v-model="fname"
                  label="Branch"
                  required
                ></v-text-field>
              </v-col>
              <v-col  cols="4">
                <v-text-field
                 class="ma-0 pa-0"
                  v-model="fname"
                  label="Semester"
                  required
                ></v-text-field>
              </v-col>
               <v-col  cols="4">
                       <v-select
                 class="ma-0 pa-0"
                    :items="course"
                    v-model="yearLevel"
                    :model="course"
                    label="Faculty Name"
                  ></v-select>
              </v-col>
               <v-col  cols="4">
              <v-select
                 class="ma-0 pa-0"
                    :items="course"
                    v-model="yearLevel"
                    :model="course"
                    label="Subject Taught"
                  ></v-select>
                
              </v-col>
            </v-row>
            -->
          <v-data-table
            :headers="headers"
            :items="questiondata"
            class="elevation-1"
            item-key="name"
          >
            <template v-slot:item.Answer="{ item }">
              <v-text-field
                class="ma-0 pa-0"
                v-model="item.Answer"
                required
              ></v-text-field>
            </template>
            <template v-slot:body.append>
              <tr>
                <td></td>
                <td>
                  <v-textarea
                    name="input-7-1"
                    label="Remarks"
                    v-model="textarea"
                    value=""
                  ></v-textarea>
                  
                  <v-btn text color="primary" @click="SubmitEval(textarea,  questiondata, usertypedescr, employ, studid )"
                    >Submit</v-btn
                  >
                </td>
                <td colspan="4"></td>
              </tr>
            </template>
          </v-data-table>
        </v-container>
      </v-card>
    </v-content>
  </v-app>
</template>
<script>
import axios from "axios";
export default {
  name: " MainPortal",

  data() {
    return {
      props: ["studid"],
      props: ["fullname"],
      props: ["usertype"],
      props: ["empid"],
      props: ["userTypeDescription"],
      props: ["evalid"],
      props: ["userid"],
      userevalid: " ",
      evaluatorid: "",
      employee_id: " ",
      usertypedescr: " ",
      remarks: " ",
      publish: " ",
      answers: " ",
      employ: " ", 
      evid: " ",
      userTypeDescrption: " ",
      created_at: " ",
      headers: [
        {
          text: "ID",
          align: "start",
          sortable: false,
          value: "id",
        },
        { text: "Question", value: "questionDescription" },
        { text: "Answer", value: "Answer" },
      ],
      questiondata: [],
      evaluteinfodata: [],

    };
  },

 
  created() {
   this.employ = this.$route.params.empid;
    this.studid = this.$route.params.id; 
    this.evid  =   this.$route.params.evalid;
    this.usertypedescr  = this.$route.params.userTypeDescription;
    this.userevalid   =  this.$route.params.userid;
    this.getquestion();
    this.getevaluteprof();
  },

  methods: {

    
       SubmitEval(textarea,questiondata, usertypedescr, empid, studid) {

const concat =  {};
var key = 0;
var count = 0;
            for (var data in questiondata) {
                var value = questiondata[data];
                concat[key] = value.Answer ;
                key++;
		          count++;			
            }

if(count <= 19) {
	for (var i=0; i<= 19; i++) {
	concat[key] = ' ';	
            key++;
            count++;			
}
}

       
          
      axios({
        method: "post",
        url: "http://localhost:8080/evaluation-system/public/api/evaluation/" +
         this.evid,
        data: {
      evaluatorid: studid,
      employee_id: empid,
      remarks: textarea,
      publish: "yes",
      a1: concat[0] ,
      a2: concat[1],
      a3: concat[2],
      a4: concat[3],
      a5: concat[4],
      a6: concat[5],
      a7: concat[6],
      a8: concat[7],
      a9: concat[8],
      a10: concat[9],
      a11: concat[10],
      a12: concat[11],
      a13: concat[12],
      a14: concat[13],
      a15: concat[14],
      a16: concat[15],
      a17: concat[16],
      a18: concat[17],
      a19: concat[18],
      a20: concat[19],
      userTypeDescription: usertypedescr


        },
      });
        this.$router.push({name: "EvaluatorMain"});
         
    },
    getquestion: function () {
      // var snum = JSON.stringify({ snum :  "PH20080105"});
       
      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get(
          "http://localhost:8080/evaluation-system/public/api/questionaire/userType/" + this.$route.params.usertype,
          config
        )
        .then((data) => {
          console.log(data.data);
          this.questiondata = data.data
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },

    getevaluteprof: function () {
      // var snum = JSON.stringify({ snum :  "PH20080105"});
           // "http://localhost:8080/evaluation-system/public/api/student/transaction/" + this.$route.params.id + "/" + this.$route.params.subjCode ,
       
      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get(
          "http://localhost:8080/evaluation-system/public/api/user/" + this.userevalid,
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
  },
};
</script>
  