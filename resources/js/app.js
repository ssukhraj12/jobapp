/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import './scripts';
import vuetify from "./vuetify";
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);
import AllCountries from "./components/AllCountries.vue";
app.component('all-countries',AllCountries);
import AllStates from "./components/AllStates.vue";
app.component('all-states',AllStates);
import AllCities from "./components/AllCities.vue";
app.component('all-cities',AllCities);
import AdminJobcats from "./components/AdminJobcats.vue";
app.component('admin-jobcats',AdminJobcats);
import AdminJobtypes from "./components/AdminJobtypes.vue";
app.component('admin-jobtypes',AdminJobtypes);
import AdminJobs from "./components/AdminJobs.vue";
app.component('admin-jobs',AdminJobs);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */
app.use(vuetify);
app.mount('#app');
