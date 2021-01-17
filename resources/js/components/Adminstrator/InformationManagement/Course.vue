<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-toolbar color="main" dark>
          <v-toolbar-title>Course</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
        <v-container fluid>
          <v-row class="fill-height">
            <v-col>
              <transition name="fade">
                <v-data-table
                  :headers="headers"
                  :items="coursedata"
                  sort-by="calories"
                  class="elevation-1"
                >
                  <template v-slot:top>
                    <v-toolbar flat>
                      <v-dialog v-model="dialog" max-width="500px">
                        <template v-slot:activator="{ on, attrs }">
                          <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                          >
                            New Course
                          </v-btn>
                        </template>
                        <v-card>
                          <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                          </v-card-title>

                          <v-card-text>
                            <v-container>
                              <v-row>
                                <v-col cols="12" sm="6" md="4">
                                  <v-text-field
                                    v-model="editedItem.courseAcronym"
                                    label="Course Code"
                                  ></v-text-field>
                                </v-col>
                                <v-col cols="12" sm="6" md="4">
                                  <v-text-field
                                    v-model="editedItem.courseDescription"
                                    label="Course Name"
                                  ></v-text-field>
                                </v-col>
                              </v-row>
                            </v-container>
                          </v-card-text>

                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">
                              Cancel
                            </v-btn>
                            <v-btn color="blue darken-1" text @click="save">
                              Save
                            </v-btn>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
                      <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                          <v-card-title class="headline"
                            >Are you sure you want to delete this
                            item?</v-card-title
                          >
                          <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                              color="blue darken-1"
                              text
                              @click="closeDelete"
                              >Cancel</v-btn
                            >
                            <v-btn
                              color="blue darken-1"
                              text
                              @click="deleteItemConfirm"
                              >OK</v-btn
                            >
                            <v-spacer></v-spacer>
                          </v-card-actions>
                        </v-card>
                      </v-dialog>
                      <v-spacer></v-spacer>
                    </v-toolbar>
                  </template>
                  <template v-slot:item.actions="{ item }">
                    <v-icon small class="mr-2" @click="editItem(item)">
                      mdi-pencil
                    </v-icon>
                    <v-icon small @click="deleteItem(item)">
                      mdi-delete
                    </v-icon>
                  </template>
                  <template v-slot:no-data>
                    <v-btn color="primary" @click="initialize"> Reset </v-btn>
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
  data: () => ({
    dialog: false,
    dialogDelete: false,
    headers: [
      {
        text: "Course Code",
        align: "start",
        sortable: false,
        value: "courseAcronym",
      },
      { text: "Course Name", value: "courseDescription" },
      { text: "Date Added", value: "created_at" },
      { text: "Actions", value: "actions", sortable: false },
    ],
    coursedata: [],
    editedIndex: -1,
    editedItem: {
      courseAcronym: "",
      courseDescription: "",
    created_at: Date.now(),
    },
    defaultItem: {
      courseAcronym: "",
      courseDescription: "",
        created_at: Date.now(),
    },
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.getcourse();
  },

  methods: {
    getcourse: function () {
      // var snum = JSON.stringify({ snum :  "PH20080105"});
      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get(
          "http://localhost:8080/evaluation-system/public/api/course",
          config
        )
        .then((data) => {
          console.log(data.data);
          this.coursedata = data.data;
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },

    addcourse(params) {
      console.log(params);

      axios({
        method: "post",
        url: "http://localhost:8080/evaluation-system/public/api/course",
        data: {
          courseAcronym: params.courseAcronym,
          courseDescription: params.courseDescription 
        },
      });
    },

    editItem(item) {
      this.editedIndex = this.coursedata.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },

    deleteItem(item) {
      this.editedIndex = this.coursedata.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.coursedata.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.coursedata[this.editedIndex], this.editedItem);
      } else {
        this.coursedata.push(this.editedItem);
        this.addcourse(this.editedItem);
      }
      this.close();
    },

    getCourse: function () {
      // var snum = JSON.stringify({ snum :  "PH20080105"});
      debugger;
      let config = {
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
      };
      axios
        .get("http://localhost/evaluation-system/public/api/course", config)

        .then((data) => {
          console.log(data.data);
          this.coursedata = data.data;
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },
  },
};
</script>