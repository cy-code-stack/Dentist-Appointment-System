import { createRouter, createWebHistory } from 'vue-router';

//Patient View
import PatientIndexPage from "../components/Patient/PatientIndex.vue";

//Staff View
import StaffIndexPage from "../components/Staff/StaffIndex.vue";
import IndexManagePatient from "../components/Staff/Patient/IndexManagePatient.vue"
import IndexStaffAppointment from "../components/Staff/Appointments/IndexStaffAppointment.vue";
import IndexStaffServices from "../components/Staff/Services/IndexStaffServices.vue";
import IndexStaffProfile from "../components/Staff/Profile/IndexStaffProfile.vue";

// Admin View
import IndexAdminPage from "../components/Admin/IndexAdmin.vue"
import IndexManageStaff from "../components/Admin/Staff/IndexManageStaff.vue"
import IndexManageServices from "../components/Admin/Services/IndexManageServices.vue";
import IndexTransaction from "../components/Admin/Transaction/IndexTransaction.vue";
import IndexSales from "../components/Admin/Sales/IndexSales.vue";
import IndexLogs from "../components/Admin/Logs/IndexLogs.vue";
import IndexAdminProfile from "../components/Admin/Profile/IndexAdminProfile.vue";


const routes = [
    {
        path: '/user/patient/booking',
        name: 'booking',
        component: PatientIndexPage
    },
    //-----Start of Staff Page ---- ///
    {
        path: '/user/staff/dashboard',
        name: 'dashboard',
        component: StaffIndexPage,
    },
    {
        path: '/user/staff/patient',
        name: 'staff-patient',
        component: IndexManagePatient,
    },
    {
        path: '/user/staff/appointment',
        name: 'appointment',
        component: IndexStaffAppointment,
    },
    {
        path: '/user/staff/service',
        name: 'staff-services',
        component: IndexStaffServices,
    },
    {
        path: '/user/staff/profile',
        name: 'staff-profile',
        component: IndexStaffProfile,
    },
    // End  of Staff Page
    // Start of Admin Page
    {
        path: '/user/admin/dashboard',
        name: 'admin-dashboard',
        component: IndexAdminPage,
    },
    {
        path: '/user/admin/staff',
        name: 'admin-staff',
        component: IndexManageStaff,
    },
    {
        path: '/user/admin/services',
        name: 'admin-services',
        component: IndexManageServices,
    },
    {
        path: '/user/admin/trasanction',
        name: 'admin-transaction',
        component: IndexTransaction,
    },
    {
        path: '/user/admin/sales',
        name: 'admin-sales',
        component: IndexSales,
    },
    {
        path: '/user/admin/logs',
        name: 'admin-logs',
        component: IndexLogs,
    },
    {
        path: '/user/admin/profile',
        name: 'admin-profile',
        component: IndexAdminProfile,
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;