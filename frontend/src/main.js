// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Vuex from 'vuex'
import store from './store'
/*
 * Chargement du framework css vuetify
 * Ensure you are using css-loader
 */
import Vuetify from 'vuetify'
import('../node_modules/vuetify/dist/vuetify.min.css');

// require lib
import VueCodemirror from 'vue-codemirror'

// require styles
import 'codemirror/lib/codemirror.css'
import showhhint from 'codemirror/addon/hint/show-hint.css'

Vue.use(Vuetify);


Vue.config.productionTip = false

new Vue({
    el: '#app',
    router,
    store,
    components: {App},
    template: '<App/>'
})
