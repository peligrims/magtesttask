export default {
    state:{
        loading:true,
        error:null
    },
    mutations:{
        setLoading (state, payload) {
            state.loading = payload
        },
    },
    action:{
        setLoading ({commit}, payload) {
            commit('setLoading', payload)
        },
    },
    getters: {
        loading (state) {
            return state.loading
        },
        error (state) {
            return state.error
        }
    }
}
