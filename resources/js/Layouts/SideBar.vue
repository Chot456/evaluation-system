  <template>
  <v-navigation-drawer
    v-show="validateAdminUser()"
    v-model="drawer"
    :color="color"
    :expand-on-hover="expandOnHover"
    :mini-variant="miniVariant"
    :right="right"
    :permanent="permanent"
    absolute
    dark
    width="325"
  >
    <v-list dense nav class="py-0">
      <v-list-item two-line :class="miniVariant && 'px-0'">
        <v-list-item-content pt-5>
          <v-list-item-title>Student Name: John Doe</v-list-item-title>
          <v-list-item-subtitle>Year: 4th</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list-group
        v-for="item in items"
        :key="item.title"
        v-model="item.active"
        :prepend-icon="item.action"
        no-action
      >
        <template v-slot:activator>
          <v-list-item-content>
            <v-list-item-title v-text="item.title"></v-list-item-title>
          </v-list-item-content>
        </template>

        <v-list-item
          link
          v-for="child in item.items"
          :key="child.title"
          :to="child.link"
        >
          <v-list-item-content>
            <v-list-item-title v-text="child.title"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-group>
    </v-list>
  </v-navigation-drawer>
         <!-- {
          action: "mdi-account-circle",
          items: [{ title: "Site Setting", link: "SiteSetting" }],
          title: "Setting",
        },-->
</template>
  <script>
export default {
  data() {
    return {
      user_type_id: '',
      isVisible: false,
      drawer: true,
      items: [
        {
          action: "mdi-account-circle",
          items: [
            { title: "Subject", link: "Subject" },
            { title: "Course", link: "Course" },
          ],
          title: "Information Management",
        },
        {
          action: "mdi-account-circle",
          items: [
            { title: "Categories", link: "Categories" },
            { title: "Questions", link: "Questions" },
          ],
          title: "Question Management",
        },
        {
          action: "mdi-account-circle",
          items: [
            { title: "Department", link: "Department" },
            { title: "Students", link: "Students" },
            { title: "Faculties", link: "Faculties" },
            { title: "Maintenance", link: "Maintenance" },
          ],
          title: "Account Management",
        },

        {
          action: "mdi-account-circle",
          items: [{ title: "Manage Sessions", link: "ManageSessions" }],
          title: "Session",
        },
        {
          action: "mdi-account-circle",
          items: [
            { title: "Evaluation", link: "Evaluation" },
            { title: "Activity Logs", link: "ActivityLogs" },
          ],
          title: "Report",
        },
        {
          action: "mdi-account-circle",
          items: [{ title: "Manage Account", link: "ManageAccount" }],
          title: "Account",
        },
      ],
      color: "#343f4f",
      colors: ["primary", "blue", "success", "red", "teal"],
      right: false,
      permanent: true,
      miniVariant: true,
      expandOnHover: true,
      background: false,
    };
  },

  created() {
    this.getSessionData();
  },

  methods: {
    getSessionData: function () {
      debugger;
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
          this.user_type_id = data.data;
          // this.evaluationData = data.data;
        })
        .catch((err) => {
          alert("Error :" + err);
        });
    },

    validateAdminUser() {
        return this.user_type_id[0].roles === 'admin';
    }
  }
};
</script>