import { createRouter, createWebHistory } from 'vue-router';

//Patient View
import PatientIndexPage from "../components/Patient/PatientIndex.vue";

//Staff View
import StaffIndexPage from "../components/Staff/StaffIndex.vue";
import IndexStaffServices from "../components/Staff/Services/IndexStaffServices.vue";
import IndexStaffAppointment from "../components/Staff/Appointments/IndexStaffAppointment.vue";
import IndexStaffProfile from "../components/Staff/Profile/IndexStaffProfile.vue";


const routes = [
    {
        path: '/appointment/booking',
        name: 'patient',
        component: PatientIndexPage
    },
    //-----Start of Staff Page ---- ///
    {
        path: '/staff/dashboard',
        name: 'staff',
        component: StaffIndexPage
    },
    {
        path: '/staffservices',
        name: 'staffservices',
        component: IndexStaffServices
    },
    {
        path: '/staffappointment',
        name: 'staffappointment',
        component: IndexStaffAppointment,
    },
    {
        path: '/staffprofile',
        name: 'staffprofile',
        component: IndexStaffProfile,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;