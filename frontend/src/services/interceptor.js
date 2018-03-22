import Vue from 'vue'
import url from './config'
import ls from './localStorage'
import store from 'store'

// Permet d'envoyer automatiquement le header quand le token existe
export default {
    install: (Vue, options = {}) => {

        // Add a request interceptor
        url.interceptors.request.use( function (config) {
            if(ls.get('token')){
                if(!config.params){
                    config.params = {}
                }
                config.headers['Authorization'] = 'Bearer '+ls.get('token')
            }
            return config
        }, function (error) {
            return Promise.reject(error)
        })

       /* // Add a response interceptor
        url.interceptors.response.use(function (response) {
            return response;
        }, function (error) {
            if(error.response && error.response.status == 401){
                store.dispatch('auth/logout', ! error.response.data.error.indexOf("wrong token"))
                options.router.push({name: 'signin'})
            }
            return Promise.reject(error)
        })
*/
    }
}