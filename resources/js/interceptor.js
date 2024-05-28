import store from './store/store.js'

store.dispatch('get', {
    tag: 'check',
    url: '/api/auth/check',
}).then((res, rej) => {
    console.log(res.data);
});
