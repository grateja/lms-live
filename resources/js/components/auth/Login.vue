<template>
	<v-container>
        <form @submit.prevent="login">
            <v-card width="420px" class="card-rounded">
                <v-card-title>
                    <span class="title">Login</span>
                </v-card-title>
                <v-card-text>
                    <v-text-field type="email"  name="email" v-model="formData.email" variant="outlined" label="Email" :error-messages="errors.get('email')" class="ma-2" />
                    <v-text-field type="password"  name="password" v-model="formData.password" variant="outlined" label="Password" :error-messages="errors.get('password')" class="ma-2" />
                    <v-btn :loading="loadingKeys.includes('logging-in')" round type="submit" color="primary" class="ma-2">Log in</v-btn>
                </v-card-text>
            </v-card>
        </form>
	</v-container>
</template>

<script>
	export default {
		data() {
			return {
				formData: {
					email: null,
					password: null
				}
			}
		},
        methods: {
            login() {
                this.$store.dispatch('auth/login', this.formData)
                // this.$store.dispatch('post', {
                //     tag: 'login',
                //     url: 'auth/login',
                //     formData: this.formData,
                // }).then((res, rej) => {
                //     localStorage.setItem('sanctum_token', res.data.token.plainTextToken);
                //     localStorage.setItem('token_name', res.data.token.accessToken.name);
                //     // console.log("plain text token", res.data.token.plainTextToken);
                //     this.$router.push('/');
                // })
            },
            check() {
                axios.get('api/auth/logout')
            }
        },
        computed: {
            errors () {
                return this.$store.getters.getErrors;
            },
            loadingKeys () {
                return this.$store.getters.loadingKeys;
            }
        }
	}
</script>
