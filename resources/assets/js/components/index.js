import Vue from "vue";
import FontAwesomeIcon from "./FontAwesomeIcon";
import App from "./App";
import NavigationBar from './Navbar'
import UserControls from './UserControls'
import HomePageComponent from "./HomePageComponent"
import WelcomePageComponent from "./WelcomePageComponent"

Vue.component('fa-icon', FontAwesomeIcon);
Vue.component('app', App);
Vue.component('app-navbar', NavigationBar);
Vue.component('user-controls', UserControls);
Vue.component('home-page', HomePageComponent);
Vue.component('welcome-page', WelcomePageComponent);