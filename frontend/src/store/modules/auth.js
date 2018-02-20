const initialState = {
    connected: false,
    user: {}
};

export default {
    namespaced: true, //permet d'y accéder de façon nommée
    state: {
        connected: false,
        user: {}
    },
    getters: {
        isConnected(state) {
            return state.connected
        },
        getConnectedUser(state) {
            return state.user
        }
    },
    mutations: {
        setConnectedUser(state, u) {
            state.user = u
            state.connected = true
        },
        initState(state) {
            Object.assign(state, initialState)
        }
    }
}