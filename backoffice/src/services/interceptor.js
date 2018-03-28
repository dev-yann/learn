import url from './configJwt'
import ls from './localStorage'
import store from './../store'

export default {
    install: (Vue, options = {}) => {
        // Add a request interceptor
        url.interceptors.request.use( function (config) {
            if(ls.get('tokenAuthor')){
                if(!config.params){
                    config.params = {}
                }
                config.headers['Authorization'] = 'Bearer '+ls.get('tokenAuthor')
            }
            return config
        }, function (error) {
            return Promise.reject(error)
        })

        // Add a response interceptor
        url.interceptors.response.use(function (response) {

            return response;

        }, function (error) {

            if(error.response && error.response.status == 401){

                store.commit('setDisconnectedUser');
                options.router.push({name: 'Connexion'})

            }
            return Promise.reject(error)
        })
    }
}