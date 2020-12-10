<template>
    <v-app>
        <v-row
            align="center"
            justify="space-around"
        >
            <v-btn
                tile
                color="success"
                >
                <v-icon left>
                    mdi-pencil
                </v-icon>
            Edit
            </v-btn>
        </v-row>
    </v-app>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
