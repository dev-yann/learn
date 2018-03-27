import axios from 'axios'
import ls from './localStorage'

export default axios.create({
    baseURL: `http://api.learn:10080`
})

// Add a request interceptor
axios.interceptors.request.use( function (config) {
    if(ls.get('tokenAuthor')){
        if(!config.params){
            config.params = {}
        }
        config.headers['Authorization'] = 'Bearer '+ls.get('tokenAuthor')
    }
    return config
}, function (error) {
    return Promise.reject(error)
});

