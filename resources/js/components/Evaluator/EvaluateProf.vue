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
              <div>
                Student Number: {{ this.studentdetaildata.data[0].studid }}
              </div>
              <div>
                Student Name: {{ this.studentdetaildata.data[0].firstname }}
                {{ this.studentdetaildata.data[0].lastname }}
              </div>

              <div>Instructor: Limotan</div>
              <div>Subject: {{ this.studentdetaildata.data[0].subjDesc }}</div>
            </v-col>
            <v-col> </v-col>
          </v-row>
          <v-divider></v-divider>
          <v-row class="fill-height">
            <v-col>
              <h4 class="font-weight-bold">Evaluation</h4>
              <div class="ml-5">
                <span class="text-decoration-underline">Instruction:</span>
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book. It has
                survived not only five centuries, but also the leap into
                electronic typesetting, remaining essentially unchanged. It was
                popularised in the 1960s with the release of Letraset sheets
                containing Lorem Ipsum passages, and more recently with desktop
                publishing software like Aldus PageMaker including versions of
                Lorem Ipsum.
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
                  
                  <v-btn text color="primary" @click="SubmitEval(textarea,  questiondata )"
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
      evaluatorid: "",
      employee_id: " ",
      remarks: " ",
      publish: " ",
      answers: " ",
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
      studentdetaildata: [],

    };
  },

  created() {
    this.getquestion();
    this.getevaluteprof();
  },

  methods: {

    
       SubmitEval(params,questiondata) {

debugger;

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
        method: "put",
        url: "http://localhost:8080/evaluation-system/public/api/evaluation/1",
        data: {
      evaluatorid: "",
      employee_id: " ",
      remarks: " ",
      publish: " ",
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
      a20: concat[19]



        },
      });

    },
    getquestion: function () {
      // var snum = JSON.stringify({ snum :  "PH20080105"});
      debugger;
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
      debugger;
      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get(
          "http://localhost:8080/evaluation-system/public/api/student/transaction/" + this.$route.params.id + "/" + this.$route.params.subjCode ,
          config
        )
        .then((data) => {
          console.log(data.data);
          this.studentdetaildata = data.data;
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },
  },
};
</script>
  