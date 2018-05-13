import RootPageComponent from "./components/RootPageComponent"
import RegisterDonationComponent from "./components/RegisterDonationComponent"
import LoginComponent from "./components/LoginComponent"
import RegisterPageComponent from "./components/RegisterPageComponent"
import ProfilePageComponent from "./components/ProfilePageComponent"
import DonationHistoryPageComponent from './components/DonationHistoryPageComponent'
import InvitationPageComponent from './components/InvitationPageComponent'
import InvitationRegisterComponent from './components/InvitationRegisterComponent';

import VueRouter from "vue-router"
import Vue from "vue"

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {path: '/', component: RootPageComponent},
        {path: '/donate', component: RegisterDonationComponent},
        {path: '/login', component: LoginComponent},
        {path: '/history', component: DonationHistoryPageComponent},
        {path: '/register', component: RegisterPageComponent},
        {path: '/profile', component: ProfilePageComponent},
        {path: '/invite', component: InvitationPageComponent},
        {path: '/invitation', component: InvitationRegisterComponent},
    ],
    mode: 'history',
});