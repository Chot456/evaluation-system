<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-toolbar color="main" dark>
          <v-toolbar-title>Evaluation Reports</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
        <v-container fluid>
          <v-row class="fill-height">
            <v-col>
              <transition name="fade">
                <v-data-table
                  :headers="headers"
                  :items="desserts"
                  item-key="name"
                  class="elevation-1 pa-6"
                >
                  <template v-slot:top>
                    <!-- v-container, v-col and v-row are just for decoration purposes. -->
                    <v-container fluid>
                      <v-row>
                        <v-col cols="4">
                          <v-row>
                            <!-- Filter for calories -->
                            <v-select
                              :items="schoolyearList"
                              v-model="schoolyearFilterValue"
                              label="School Year"
                            ></v-select>
                          </v-row>
                        </v-col>

                        <v-col cols="4">
                          <v-row>
                            <!-- Filter for calories -->
                            <v-select
                              :items="semesterList"
                              v-model="semesterFilterValue"
                              label="Semester"
                            ></v-select>
                          </v-row>
                        </v-col>

                        <v-col cols="4">
                          <v-row>
                            <!-- Filter for dessert name-->
                            <v-text-field
                              v-model="instructorFilterValue"
                              type="text"
                              label="Instructor"
                            ></v-text-field>
                          </v-row>
                        </v-col>
                      </v-row>
                    </v-container>
                  </template>
                   <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="$router.push({ name: 'ViewComputations' })"
      >
        mdi-calculator
      </v-icon>
      <v-icon
        small
         @click="$router.push({ name: 'ViewComments' })"
      >
        mdi-comment-account-outline
      </v-icon>
            <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-newspaper-variant-outline
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
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
// Table info.
import tableData from "./sampleDataTable.json";
export default {
  data() {
    return {
      // We need some values for our select.
      schoolyearList: [
        { text: "All", value: null },
        { text: "2021", value: 2021 },
        { text: "2020", value: 2020 },
      ],

      semesterList: [
        { text: "All", value: null },
        { text: "1st", value: "1st" },
        { text: "summer", value: "summer" },
      ],

      // Filter models.
      instructorFilterValue: "",
      schoolyearFilterValue: null,
      semesterFilterValue: null,
      // Table data.
      desserts: tableData.data,
    };
  },
  computed: {
    headers() {
      return [
        {
          text: "Instructor ID",
          align: "left",
          sortable: false,
          value: "instrucid",
          filter: this.nameFilter,
        },
        {
          text: "Instructor",
          value: "instrucname",
          
        },
        { text: "School Year", value: "schoolyear" ,filter: this.schoolyearFilter},
        { text: "Semester", value: "semester"  ,filter: this.semesterFilter},
        { text: "Publish", value: "publish" },
        { text: "Report", value: "report" },
         { text: 'Actions', value: 'actions', sortable: false },
      ];
    },
  },
  methods: {
    /**
     * Filter for dessert names column.
     * @param value Value to be tested.
     * @returns {boolean}
     */


    nameFilter(value) {
      // If this filter has no value we just skip the entire filter.
      if (!this.instructorFilterValue) {
        return true;
      }
      // Check if the current loop value (The dessert name)
      // partially contains the searched word.
      return value
        .toLowerCase()
        .includes(this.instructorFilterValue.toLowerCase());
    },
    /**
     * Filter for calories column.
     * @param value Value to be tested.
     * @returns {boolean}
     */
    schoolyearFilter(value) {
      // If this filter has no value we just skip the entire filter.
      if (!this.schoolyearFilterValue) {
        return true;
      }
      // Check if the current loop value (The calories value)
      // equals to the selected value at the <v-select>.
      return value === this.schoolyearFilterValue;
    },

    semesterFilter(value){
          if (!this.semesterFilterValue) {
        return true;
      }
      // Check if the current loop value (The calories value)
      // equals to the selected value at the <v-select>.
      return value === this.semesterFilterValue;

    }
  },
};
</script> 