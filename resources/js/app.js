/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

const options = {
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
};
import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, options);

import Gate from "./userGate";
Vue.prototype.$gate = new Gate(window.user);

export const eventBus = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('menu-header', require('./components/MenuHeader.vue').default);
Vue.component('profile-header', require('./components/ProfileHeader').default);
Vue.component('mobile-menu', require('./components/MobileMenu').default);
Vue.component('newspaper-ver-ad', require('./components/NewspaperVerAd').default);
Vue.component('hor-ad', require('./components/HorAd').default);
Vue.component('daily-tags', require('./components/DailyTags').default);
Vue.component('slidebar-news', require('./components/SlidebarNews').default);
Vue.component('inline-news-by-cat', require('./components/InlineNewsByCat').default);
Vue.component('inline-news', require('./components/InlineNews').default);
Vue.component('newspaper-suggestion-news', require('./components/NewspaperSuggestionNews').default);
Vue.component('sign-in', require('./components/SignIn').default);
Vue.component('popup-sign-in', require('./components/PopupSignIn').default);
Vue.component('mobile-bottom-ad', require('./components/MobileBottomAd').default);
Vue.component('ali-input', require('./components/AliInput').default);
Vue.component('forget-pass', require('./components/ForgetPassword').default);
Vue.component('sign-up', require('./components/SignUp').default);
Vue.component('validation-email', require('./components/ValidationEmail').default);
Vue.component('page-new-news', require('./components/PageNewNews').default);
Vue.component('page-sidebar-news', require('./components/PageSidebarNews').default);
Vue.component('page-best-news', require('./components/PageBestNews').default);
Vue.component('sidebar-best-journalist', require('./components/SidebarBestJournalist').default);
Vue.component('news', require('./components/News').default);
Vue.component('news-setting', require('./components/NewsSetting').default);
Vue.component('poll', require('./components/Poll').default);
Vue.component('poll-chart', require('./components/PollChart').default);
Vue.component('best-newspaper-news', require('./components/BestNewspaperNews').default);
Vue.component('header-journalist-pic', require('./components/HeaderJouranlistPic').default);
Vue.component('confirm-box', require('./components/ConfirmBox').default);
Vue.component('modal', require('./components/aliModal').default);
Vue.component('notifications', require('./components/Notifications').default);
Vue.component('profile-setting', require('./components/ProfileSetting').default);
Vue.component('news-hor-ad', require('./components/NewsHorAd').default);
Vue.component('news-slidebar-news', require('./components/NewsSlidebarNews').default);
Vue.component('news-ver-ad', require('./components/NewsVerAd').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
