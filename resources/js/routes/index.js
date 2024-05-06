import { createRouter, createWebHistory } from 'vue-router';

//Patient View
import PatientIndexPage from "../components/Patient/PatientIndex.vue";

//Staff View
import StaffIndexPage from "../components/Staff/StaffIndex.vue";
import IndexStaffAppointment from "../components/Staff/Appointments/IndexStaffAppointment.vue";
import IndexStaffServices from "../components/Staff/Services/IndexStaffServices.vue";
import IndexStaffProfile from "../components/Staff/Profile/IndexStaffProfile.vue";

// Admin View
import IndexAdminPage from "../components/Admin/IndexAdmin.vue"
import IndexManagePatient from "../components/Admin/Patient/IndexManagePatient.vue"
import IndexManageStaff from "../components/Admin/Staff/IndexManageStaff.vue"
import IndexManageServices from "../components/Admin/Services/IndexManageServices.vue";
import IndexTransaction from "../components/Admin/Transaction/IndexTransaction.vue";
import IndexSales from "../components/Admin/Sales/IndexSales.vue";
import IndexLogs from "../components/Admin/Logs/IndexLogs.vue";
import IndexAdminProfile from "../components/Admin/Profile/IndexAdminProfile.vue";


const routes = [
    {
        path: '/user/appointment/booking',
        name: 'booking',
        component: PatientIndexPage
    },
    //-----Start of Staff Page ---- ///
    {
        path: '/staff/dashboard',
        name: 'dashboard',
        component: StaffIndexPage,
    },
    {
        path: '/staff/appointment',
        name: 'appointment',
        component: IndexStaffAppointment,
    },
    {
        path: '/staffservice',
        name: 'staffservice',
        component: IndexStaffServices,
    },
    {
        path: '/staffprofile',
        name: 'staffprofile',
        component: IndexStaffProfile,
    },
    // End  of Staff Page
    // Start of Admin Page
    {
        path: '/admin/dashboard',
        name: 'admin',
        component: IndexAdminPage,
    },
    {
        path: '/admin/patient',
        name: 'patient',
        component: IndexManagePatient,
    },
    {
        path: '/admin/staff',
        name: 'staff',
        component: IndexManageStaff,
    },
    {
        path: '/admin/services',
        name: 'services',
        component: IndexManageServices,
    },
    {
        path: '/admin/trasanction',
        name: 'trasanction',
        component: IndexTransaction,
    },
    {
        path: '/admin/sales',
        name: 'sales',
        component: IndexSales,
    },
    {
        path: '/admin/logs',
        name: 'logs',
        component: IndexLogs,
    },
    {
        path: '/admin/profile',
        name: 'profile',
        component: IndexAdminProfile,
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;