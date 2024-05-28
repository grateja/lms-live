import { createStore } from 'vuex'
import Mapper from '../helper/Mapper.js';
import auth from './auth';

const store = createStore({
    state () {
        return {
            errorKeys: Mapper,
            loadingKeys: [],
            currentUser: null
        }
    },
    mutations: {
        setLoading(state, tag) {
            if(!state.loadingKeys.includes(tag)) {
                state.loadingKeys.push(tag)
            }
        },
        clearLoading(state, tag) {
            state.loadingKeys = state.loadingKeys.filter (i => i != tag)
        },
        setErrors(state, errors) {
            state.errorKeys.errors = errors;
        },
        clearErrors(state, key) {
            state.errorKeys.clear(key);
        },
        setUser(state, user) {
            state.currentUser = user
        }
    },
    actions: {
        post(context, data) {
            context.commit('clearErrors');
            context.commit('setLoading', data.tag)
            return axios.post(data.url, data.formData).then((res, rej) => {
                return res;
            }).catch(err => {
                context.commit('setErrors', err.response.data.errors);
                return Promise.reject(err);
            }).finally(() => {
                context.commit('clearLoading', data.tag)
            });
        },
        get(context, data) {
            context.commit('clearErrors');
            context.commit('setLoading', data.tag)
            return axios.get(data.url, {
                params: data.formData
            }).then((res, rej) => {
                return res;
            }).catch(err => {
                context.commit('setErrors', err.response.data.errors);
                return Promise.reject(err);
            }).finally(() => {
                context.commit('clearLoading', data.tag)
            });
        }
    },
    getters: {
        getErrors(state) {
            return state.errorKeys;
        },
        loadingKeys(state) {
            return state.loadingKeys;
        },
        getCurrentUser(state) {
            return state.currentUser;
        }
    },
    modules: {
        auth
    }
})

export default store
