<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
    >
		<v-list>
			<router-link :to="{ name: 'dashboard' }">
				<v-list-item link>
				<v-list-item-action>
					<v-icon>mdi-home</v-icon>
				</v-list-item-action>
				<v-list-item-content>
					<v-list-item-title>Dashboard</v-list-item-title>
				</v-list-item-content>
			</v-list-item>
			</router-link>

			<router-link :to="{ name: 'contact' }">
				<v-list-item link>
					<v-list-item-action>
						<v-icon>mdi-check</v-icon>
					</v-list-item-action>
					<v-list-item-content>
						<v-list-item-title>Contact</v-list-item-title>
					</v-list-item-content>
				</v-list-item>
			</router-link>
			
			<v-list-item link @click="logout">
				<v-list-item-action>
					<v-icon>mdi-power</v-icon>
				</v-list-item-action>
				<v-list-item-content>
					<v-list-item-title>Log out</v-list-item-title>
				</v-list-item-content>
			</v-list-item>
		</v-list>
    </v-navigation-drawer>

    <v-app-bar app
		color="indigo"
		dark
	>
      <v-app-bar-nav-icon @click="drawer = !drawer"> </v-app-bar-nav-icon>

      <v-toolbar-title>Application</v-toolbar-title>
    </v-app-bar>

    <v-main>
		<v-content>
			<v-container
				class="fill-height"
				fluid
			>
				<router-view></router-view>
			</v-container>
		</v-content>
      <!--  -->
    </v-main>
  </v-app>
</template>

<script>
  export default {
	data: () => ({ drawer: null }),
	methods: {
		logout() {
			axios.post('/logout')
			.then( response => {
				window.location.href = "login"
			})
		}
	}
  }
</script>