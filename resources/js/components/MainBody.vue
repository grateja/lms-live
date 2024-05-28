<template>
	<div>Initial commit
        <pre>{{currentUser}}</pre>
        <v-btn @click="logout">logout</v-btn>
    </div>
</template>
<script>
	export default {
        methods: {
            logout() {
                this.$store.dispatch('auth/logout')
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.getCurrentUser;
            }
        }
	}
</script>
