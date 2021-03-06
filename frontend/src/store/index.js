// Importations de vue et vuex
import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import ls from '../services/localStorage'

// Activation de vuex dans vue
Vue.use(Vuex);

export default new Vuex.Store({
    plugins: [createPersistedState()],
    state: {
        connected: false,
        member:true,
        user: {},
        parcours: {}
    },
    getters: {
        // Retourne l'état connecté
        isConnected: state => state.connected,
        getUser: state => state.user,
        getParcours: state => state.parcours,
    },
    mutations: {
        setConnectedUser: (state, user) => {
            state.connected = true
            state.user = user
        },
        setDisconnectedUser: (state, user) => {
            state.connected = false
            state.user = {}
            ls.remove('token');
        },
        setParcours: (state,parcours) => {
            state.parcours = parcours
        }
    }
})
