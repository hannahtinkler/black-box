import Vue from 'vue';
import Vuex from 'vuex';

// Modules
import pages from './modules/pages';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        pages: pages,
    },
});
