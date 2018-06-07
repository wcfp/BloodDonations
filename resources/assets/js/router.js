import RootPageComponent from "./components/shared/RootPageComponent"
import RegisterDonationComponent from "./components/donor/RegisterDonationComponent"
import LoginComponent from "./components/auth/LoginComponent"
import RegisterPageComponent from "./components/auth/RegisterPageComponent"
import DonorProfilePageComponent from "./components/donor/DonorProfilePageComponent"
import DonationHistoryPageComponent from './components/donor/DonationHistoryPageComponent'
import InvitationPageComponent from './components/admin/InvitationPageComponent'
import InvitationRegisterComponent from './components/auth/InvitationRegisterComponent';
import DoctorBloodRequestPageComponent from './components/doctor/DoctorBloodRequestPageComponent'
import EditProfileComponent from './components/donor/EditProfileComponent'
import BloodContainerComponent from './components/assistant/BloodContainersComponent'
import RequestHistoryPageComponent from './components/doctor/RequestHistoryPageComponent';
import OngoingRequestsPageComponent from './components/doctor/OngoingRequestsPageComponent';

import VueRouter from "vue-router"
import Vue from "vue"

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {path: '/', component: RootPageComponent},
        {path: '/login', component: LoginComponent},
        {path: '/register', component: RegisterPageComponent},
        {path: '/invitation', component: InvitationRegisterComponent},

        {path: '/donor/donate', component: RegisterDonationComponent},
        {path: '/donor/history', component: DonationHistoryPageComponent},
        {path: '/donor/profile', component: DonorProfilePageComponent},
        {path: '/donor/editProfile', component: EditProfileComponent},

        {path: '/admin/invite', component: InvitationPageComponent},

        {path: '/doctor/request', component: DoctorBloodRequestPageComponent},
        {path: '/doctor/history', component: RequestHistoryPageComponent},
        {path: '/doctor/requests', component: OngoingRequestsPageComponent},

        {path: '/assistant/containers', component: BloodContainerComponent},
        {path: '/assistant/donations', component: BloodContainerComponent},
        {path: '/assistant/requests', component: BloodContainerComponent},
    ],
    mode: 'history',
});