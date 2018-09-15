
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import Prism from 'prismjs';
import ExampleComponent from './components/ExampleComponent';
import ClassToggler from './lib/ClassToggler';

new Vue({
    el: '#app',
    components: {
        ExampleComponent,
    }
});

new ClassToggler;
