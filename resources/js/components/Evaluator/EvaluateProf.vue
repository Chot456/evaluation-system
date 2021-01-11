<template>
  <v-app>
      <v-content style="background-color: #eef1f6">
        <v-card class="mx-auto mt-10" max-width="1300">
          <v-toolbar color="main" dark>
            <v-toolbar-title>Faculty Evaluuation</v-toolbar-title>

            <v-spacer></v-spacer>
          </v-toolbar>
          <v-container fluid>
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
                <v-data-table
      :headers="headers"
      :items="questiondata"
      class="elevation-1"
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
          value=""
        ></v-textarea>
            <v-btn text color="primary" @click="menupay = false"
                            >Submit</v-btn
                          >
                              <v-btn text color="primary" @click="menupay = false"
                            >Reset</v-btn
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
import axios from 'axios';
export default {
  name: "MainPortal",


  data() {
    return {
      headers: [
        {
          text: "ID",
          align: "start",
          sortable: false,
          value: "id",
        },
        { text: "Question", value: "question" },
        { text: "Answer", value: "Answer" },
     
      ],
      questiondata:[],
      itemquestion: [
          {
           id: 1,
           question: "The instructor was well prepared for the class.",
           Answer: ' '
          },
                    {
           id: 2,
           question: " The instructor showed an interest in helping students learn.",
           Answer: ''
          },
                {
           id: 3,
           question: "I received useful feedback on my performance on tests, papers, etc.",
           Answer: ''
          },
                        {
           id: 4,
           question: "The instructional materials (i.e., books, readings, handouts, study guides, lab manuals, multimedia, software) increased my knowledge and skills in the subject matter.",
           Answer: ''
          },
 
 
        ],
    };
  },



          methods : {
      getquestion: function() {
        // var snum = JSON.stringify({ snum :  "PH20080105"});
        
        let config  = {
          headers : {"Content-Type" : "application/x-www-form-urlencoded"}
        }
        axios.get("http://localhost:8080/evaluation-system/public/api/questionaire" , config).then(data => {
          console.log(data.data);
          this.questiondata = data.data;
        }).catch(err => {
          alert("Error :" + err)
        });
      }
    },
};
</script>
  