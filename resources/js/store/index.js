import  Vue from 'vue'
import Vuex from 'vuex'
import realties from './realties'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        realties
    }
})
