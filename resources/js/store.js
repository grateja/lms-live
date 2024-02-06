import { createStore } from 'vuex'
import Mapper from './helper/Mapper.js';

const store = createStore({
    state () {
        return {
            errorKeys: Mapper,
            loadingKeys: []
        }
    },
    mutations: {
        setLoading(state, name) {
            if(!state.loadingKeys.includes(name)) {
                state.loadingKeys.push(name)
            }
        },
        clearLoading(state, name) {
            state.loadingKeys = state.loadingKeys.filter (i => i != name)
        },
        setErrors(state, errors) {
            state.errorKeys.errors = errors;
        },
        clearErrors(state, key) {
            state.errorKeys.clear(key);
        }
    },
    actions: {
        post(context, data) {
            context.commit('clearErrors');
            context.commit('setLoading', data.name)
            return axios.post(data.url, data.formData).then((res, rej) => {
                return res;
            }).catch(err => {
                context.commit('setErrors', err.response.data.errors);
                return Promise.reject(err);
            }).finally(() => {
                context.commit('clearLoading', data.name)
            });
        }
    },
    getters: {
        getErrors(state) {
            return state.errorKeys;
        },
        loadingKeys(state) {
            return state.loadingKeys;
        }
    }
})

export default store
