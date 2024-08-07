import { createRouter, createWebHistory } from 'vue-router';

//Patient View
import PatientIndexPage from "../components/Patient/PatientIndex.vue";
import IndexCalendarEventPage from "../components/Patient/Calendar/IndexCalendarEvent.vue"
import PatientIndexAppointment from '../components/Patient/Patient_Appointment/IndexAppointment.vue';

//Staff View
import StaffIndexPage from "../components/Staff/StaffIndex.vue";
import IndexManagePatient from "../components/Staff/Patient/IndexManagePatient.vue"
import IndexStaffAppointment from "../components/Staff/Appointments/IndexStaffAppointment.vue";
import IndexStaffServices from "../components/Staff/Services/IndexStaffServices.vue";
import IndexStaffProfile from "../components/Staff/Profile/IndexStaffProfile.vue";
import IndexArchieve from '../components/Staff/Archieve/IndexArchieve.vue';
import IndexStaffInquiry from '../components/Staff/Inquiry/IndexInquiry.vue'
import IndexStaffCallendarEvent from '../components/Staff/Callendar/IndexEventCallendar.vue'

// Admin View
import IndexAdminPage from "../components/Admin/IndexAdmin.vue"
import IndexManageStaff from "../components/Admin/Staff/IndexManageStaff.vue"
import IndexReferPatients from "../components/Admin/Refer/IndexRefer.vue"
import IndexManageServices from "../components/Admin/Services/IndexManageServices.vue";
import IndexTransaction from "../components/Admin/Transaction/IndexTransaction.vue";
import IndexSales from "../components/Admin/Sales/IndexSales.vue";
import IndexLogs from "../components/Admin/Logs/IndexLogs.vue";
import IndexAdminProfile from "../components/Admin/Profile/IndexAdminProfile.vue";
import IndexAdminArchive from '../components/Admin/Archive/IndexAdminArchive.vue';
import IndexAdminCalendar from '../components/Admin/Calendar/IndexAdminCalendar.vue';


const routes = [
    {
        path: '/user/patient/booking',
        name: 'patient-booking',
        component: PatientIndexPage
    },
    {
        path: '/user/patient/calendar/event',
        name: 'calendar-event',
        component: IndexCalendarEventPage
    },
    {
        path: '/user/patient/appointment',
        name: 'patient_appointment',
        component: PatientIndexAppointment
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
        path: '/user/staff/inquiry',
        name: 'inquiry',
        component: IndexStaffInquiry,
    },
    {
        path: '/user/staff/callendar/event',
        name: 'event',
        component: IndexStaffCallendarEvent,
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
    {
        path: '/user/staff/archieve',
        name: 'staff-archieve',
        component: IndexArchieve,
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
        path: '/user/admin/refer',
        name: 'admin-refer',
        component: IndexReferPatients,
    },
    {
        path: '/user/admin/calendar',
        name: 'admin-calendar',
        component: IndexAdminCalendar,
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
    {
        path: '/user/admin/archive',
        name: 'admin-archive',
        component: IndexAdminArchive,
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;