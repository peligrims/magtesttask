import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import colors from 'vuetify/lib/util/colors'



Vue.use(Vuetify)
const opts = { theme: {themes: {light: {primary: colors.red.darken1, secondary: '#b0bec5', anchor: '#8c9eff',},},},}
export default new Vuetify(opts)
