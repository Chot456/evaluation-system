<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-toolbar color="main" dark>
      

          <v-toolbar-title>View Computations</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
        <v-container fluid>

          <v-row class="fill-height">
            <v-col>
              <transition name="fade">
     <v-data-table
    :headers="headers"
    :items="computationData"
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
             print() {
                window.print()
       },
    methods: {
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
          { text: 'Section', value: 'a5' },
          { text: 'Subject', value: 'a6' },
        ],
 
      }
    },
  }
</script>