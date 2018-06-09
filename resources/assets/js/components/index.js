import Vue from "vue";
import FontAwesomeIcon from "./shared/FontAwesomeIcon";
import App from "./App";
import NavigationBar from './shared/Navbar'
import UserControls from './shared/UserControls'
import HomePageComponent from "./shared/HomePageComponent"
import WelcomePageComponent from "./shared/WelcomePageComponent"
import ErrorsComponent from "./shared/ErrorsComponent"
import VModal from 'vue-js-modal'



Vue.component('fa-icon', FontAwesomeIcon);
Vue.component('app', App);
Vue.component('app-navbar', NavigationBar);
Vue.component('user-controls', UserControls);
Vue.component('home-page', HomePageComponent);
Vue.component('welcome-page', WelcomePageComponent);
Vue.component('errors', ErrorsComponent);
Vue.use(VModal)