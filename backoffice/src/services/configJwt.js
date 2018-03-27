import axios from 'axios'
import ls from './localStorage'

export default axios.create({
    baseURL: `http://api.learn:10080`
})

// Add a request interceptor
axios.interceptors.request.use( function (config) {
    if(ls.get('token')){
        if(!config.params){
            config.params = {}
        }
        config.headers['Authorization'] = 'Bearer '+ls.get('token')
    }
    return config
}, function (error) {
    return Promise.reject(error)
});

// Add a response interceptor
/*axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    if(error.response && error.response.status == 401){

        store.dispatch('auth/logout', ! error.response.data.error.indexOf("wrong token"))
        options.router.push({name: 'signin'})
    }
    return Promise.reject(error)
})*/

