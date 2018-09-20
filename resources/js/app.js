
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// Packages
import Vue from 'vue';
import Prism from 'prismjs';

// Components
import CategoryChapterSelect from './components/CategoryChapterSelect';

// Libraries
import ClassToggler from './lib/ClassToggler';
import MarkdownEditor from './lib/MarkdownEditor';

new Vue({
    el: '#app',
    components: {
        CategoryChapterSelect,
    }
});

new ClassToggler;
new MarkdownEditor;
