import RootPageComponent from "./components/RootPageComponent"
import RegisterDonationComponent from "./components/RegisterDonationComponent"
import LoginComponent from "./components/LoginComponent"
import RegisterPageComponent from "./components/RegisterPageComponent"
import ProfilePageComponent from "./components/ProfilePageComponent"

import VueRouter from "vue-router"
import Vue from "vue"

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {path: '/', component: RootPageComponent},
        {path: '/donate', component: RegisterDonationComponent},
        {path: '/login', component: LoginComponent},
        {path: '/register', component: RegisterPageComponent},
        {path: '/profile', component: ProfilePageComponent},
    ],
    mode: 'history',
});