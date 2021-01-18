<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-toolbar color="main" dark>
      

          <v-toolbar-title>View Computations</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
        <v-container fluid id="divPrint">

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
    :items="computationData"
    :items-per-page="5"
    class="elevation-1"
  >
                        <template v-slot:item.Average="{ item }">
        <div> {{ item.a1 + item.a2 + item.a3 + item.a4 / 4 }} </div>
    </template>
  </v-data-table>
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

        calcAverage: function (e) {
            //calculate the average of sub grades
            //change Grade avg to show this
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

    getEvaluation: function () {
      
      debugger;
      // var snum = JSON.stringify({ snum :  "PH20080105"});
      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get(
          "http://localhost:8080/evaluation-system/public/api/getEvaluationByEmployeeId/" + this.employid ,
          config
        )
        .then((data) => {
          console.log(data);
          this.computationData = data.data;
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },

    },
    data () {
      return {
        props: ["empid"],
        props: ["firstname"],
        props: ["lastname"],
        employid : "",
        computationData: [],
        headers: [
          {
            text: 'Commitment',
            align: 'start',
            sortable: false,
            value: 'a1',
          },
          { text: 'Knowledge', value: 'a2' },
          { text: 'Teaching for independent Learning', value: 'a3' },
          { text: 'Management learning', value: 'a4' },
          { text: 'Average', value: 'Average'}
        ],
 
      }
    },
  }
</script>