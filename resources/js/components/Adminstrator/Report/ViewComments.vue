<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-toolbar color="main" dark id="divPrint">
      

          <v-toolbar-title>View Comments</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
        <v-container fluid>

          <v-row class="fill-height">
               
            <v-col>
                            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
              @click="print"
            >
              Print
            </v-btn>
              Instructor Name:    {{this.$route.params.firstname   }} 
          {{this.$route.params.lastname}}
              <transition name="fade">
     <v-data-table
    :headers="headers"
    :items="commentsData"
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
import axios from "axios";
  export default {

        created(){
       this.employid = this.$route.params.empid;
     this.getEvaluation();
    },
    methods: {
    getEvaluation: function () {
      
      // var snum = JSON.stringify({ snum :  "PH20080105"});
      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get(
          "http://localhost:8080/evaluation-system/public/api/getEvaluationByEmployeeId/"+ this.employid ,
          config
        )
        .then((data) => {
          console.log(data);
          this.commentsData = data.data;
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },
    },


             print() {
                        const modal = document.getElementById("divPrint")
  const cloned = modal.cloneNode(true)
  let section = document.getElementById("print")

  if (!section) {
     section  = document.createElement("div")
     section.id = "print"
     document.body.appendChild(section)
  }

  section.innerHTML = "";
  section.appendChild(cloned);
  window.print();
       },

    data () {
      return {
        props: ["empid"],
        props: ["firstname"],
        props: ["lastname"],
        employid : "",
        commentsData: [],
        headers: [
          {
            text: 'No.',
            align: 'start',
            sortable: false,
            value: 'id',
          },
          { text: 'Comments / Suggestion', value: 'remarks' },
         
   
        ],
    
      }
    },
  }
</script>
