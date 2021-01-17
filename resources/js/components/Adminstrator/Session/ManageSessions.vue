<template>
  <v-app>
    <v-content style="background-color: #eef1f6">
      <v-card class="mx-auto mt-10" max-width="1300">
        <v-toolbar color="main" dark>
      

          <v-toolbar-title>Activity Logs</v-toolbar-title>

          <v-spacer></v-spacer>
        </v-toolbar>
        <v-container fluid>

          <v-row class="fill-height">
            <v-col>
              <transition name="fade">
            <v-data-table
    :headers="headers"
    :items="ActivityLogsdate"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar
        flat
      >
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          <template v-slot:activator="{ on, attrs }">
        <!--    <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >
              New ActivityLogs
            </v-btn> -->
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>
           
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.actionsval"
                      label="Actions"
                    ></v-text-field>
                  </v-col>
                                            <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.ipaddval"
                      label="IP Address"
                    ></v-text-field>
                  </v-col>
             
                          <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.ActivityLogsname"
                      label="Commited by"
                    ></v-text-field>
                  </v-col>
        

     
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue darken-1"
                text
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="headline">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-spacer></v-spacer>
      
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
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
  export default {
    data: () => ({
      dialog: false,
      dialogDelete: false,
            //  { text: 'Actions', value: 'actions', sortable: false },
      headers: [
        {
          text: 'Actions',
          align: 'start',
          sortable: false,
          value: 'actionsval',
        },
          { text: 'IP address', value: 'ipaddval' },
           { text: 'Commited By', value: 'commitby' },
        { text: 'Date Added', value: 'dateadded' },

      ],
      ActivityLogsdate: [],
      editedIndex: -1,
      editedItem: {
        actionsval: '',
        ipaddval: '',
        commitby: '',
        dateadded:  Date().toLocaleString(),
      },
      defaultItem: {
        actionsval: '',
        ipaddval: '',
        commitby: '',
        dateadded: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        this.ActivityLogsdate = [
          {
            actionsval: 'CSC312',
            ActivityLogsname: 'Operation System',
            commitby: 'Admin',
            ipaddval: '192.123.123',
            dateadded: '09/09/20',
          },
                {
            actionsval: 'CSC313',
            ActivityLogsname: 'Methods of research in computing',
             commitby: 'Admin',
             ipaddval: '192.123.123',
            dateadded: '09/09/20',
          }
        ]
      },

      editItem (item) {
        this.editedIndex = this.ActivityLogsdate.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.ActivityLogsdate.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

      deleteItemConfirm () {
        this.ActivityLogsdate.splice(this.editedIndex, 1)
        this.closeDelete()
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
        if (this.editedIndex > -1) {
          Object.assign(this.ActivityLogsdate[this.editedIndex], this.editedItem)
        } else {
          this.ActivityLogsdate.push(this.editedItem)
        }
        this.close()
      },
    },
  }
</script>