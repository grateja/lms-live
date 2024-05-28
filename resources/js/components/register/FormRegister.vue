<template>
    <form method="post" @submit.prevent="submit">
        <v-card width="420px" class="mx-auto mt-4">
            <v-card-title>
                <span class="title">Register</span>
            </v-card-title>
            <v-card-text>

                <v-text-field class="my-3" v-model="formData.name" label="Owner name" variant="outlined" :error-messages="errors.get('name')" @keydown="clear('name')" />

                <v-text-field class="my-3" v-model="formData.email" label="Email" variant="outlined" :error-messages="errors.get('email')" @keydown="clear('email')" />

                <v-text-field class="my-3" v-model="formData.password" label="Password" variant="outlined"
                    :error-messages="errors.get('password')"
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="showPassword ? 'text' : 'password'"
                    @click:append="showPassword = !showPassword"
                    @keydown="clear('password')"  />

                <v-expand-transition>
                    <v-text-field class="my-3" v-if="!showPassword" v-model="formData.confirmPassword" label="Confirm Password" variant="outlined" />
                </v-expand-transition>

                <v-btn type="submit" color="primary" :loading="loading">Register</v-btn>
            </v-card-text>
        </v-card>
    </form>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                name: null,
                email: null,
                password: null
            },
            showPassword: false
        }
    },
    methods: {
        submit() {
            this.$store.dispatch('post', {
                tag: 'register',
                url: 'api/register',
                formData: this.formData
            })
        },
        clear(key) {
            this.$store.commit('clearErrors', key);
        },
    },
    computed: {
        errors () {
            return this.$store.getters.getErrors;
        },
        loading () {
            return this.$store.getters.loadingKeys.includes('register');
        }
    }
}
</script>
