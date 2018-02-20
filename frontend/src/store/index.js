// Importation de vue et vuex
import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

// Activation de vuex dans vue
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        connected: false,
        user: {}
    },
    getters: {
        // Retourne l'état connecté
        isConnected: state => state.connected
    },
    mutations: {
        setConnectedUser: (state, user) => {
            state.connected = true
            state.user = user
        }
    }
})