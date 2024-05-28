import axios from "axios";

export default {
    namespaced: true,
    actions: {
        login(context, data) {
            context.commit('setLoading', 'logging-in', {root: true});
            context.commit('clearErrors', null, {root: true});
            axios.post('/api/auth/login', data).then((res, rej) => {
                localStorage.setItem('sanctumToken', res.data.token.plainTextToken);
                localStorage.setItem('tokenName', res.data.token.accessToken.name);
                return res;
            }).catch(err => {
                context.commit('setErrors', err.response.data.errors, {root: true});
                return Promise.reject(err);
            }).finally(() => {
                context.commit('clearLoading', 'logging-in', {root: true});
            });
        },
        logout(context, data) {
            context.commit('setLoading', 'logging-out', {root: true});
            context.commit('clearErrors', null, {root: true});
            axios.post('/api/auth/logout', {
                tokenName: localStorage.tokenName,
                token: localStorage.sanctumToken
            }).then((res, rej) => {
                localStorage.removeItem('sanctumToken')
                localStorage.removeItem('tokenName')
                return res;
            }).catch(err => {
                context.commit('setErrors', err.response.data.errors, {root: true});
                return Promise.reject(err);
            }).finally(() => {
                context.commit('clearLoading', 'logging-out', {root: true});
            });
        }
    }
}
