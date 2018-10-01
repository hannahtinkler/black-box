
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./vendor/bootstrap');
require('./vendor/prismjs');

// Packages
import Vue from 'vue';
import Vuex from 'vuex';
import store from './store';

// Components
import SaveDraftButton from './components/SaveDraftButton';
import CategoryChapterSelect from './components/CategoryChapterSelect';
import DraftLastUpdated from './components/DraftLastUpdated';

// Libraries
import ClassToggler from './lib/ClassToggler';
import MarkdownEditor from './lib/MarkdownEditor';

new Vue({
    el: '#app',
    store,
    components: {
        SaveDraftButton,
        CategoryChapterSelect,
        DraftLastUpdated,
    }
});

new ClassToggler;
new MarkdownEditor;

axios.defaults.withCredentials = true;
