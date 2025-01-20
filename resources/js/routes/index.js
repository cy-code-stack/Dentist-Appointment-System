import { createRouter, createWebHistory } from 'vue-router';

//Patient View
import IndexCalendarEventPage from "../components/Patient/Calendar/IndexCalendarEvent.vue"
import PatientIndexAppointment from '../components/Patient/Patient_Appointment/IndexAppointment.vue';
import IndexPatientProfile from '../components/Patient/Profile/IndexPatientProfile.vue';
import DeclineAppointment from '../components/Patient/Decline/DeclineAppointment.vue';

//Staff View
import StaffIndexPage from "../components/Staff/StaffIndex.vue";
import IndexManagePatient from "../components/Staff/Patient/IndexManagePatient.vue"
import IndexStaffAppointment from "../components/Staff/Appointments/IndexStaffAppointment.vue";
import IndexStaffServices from "../components/Staff/Services/IndexStaffServices.vue";
import IndexStaffProfile from "../components/Staff/Profile/IndexStaffProfile.vue";
import IndexArchieve from '../components/Staff/Archieve/IndexArchieve.vue';
import IndexTransaction from "../components/Staff/Transaction/IndexTransaction.vue";
import IndexRecords from "../components/Staff/Records/IndexViewRecord.vue";
import IndexStaffInquiry from '../components/Staff/Inquiry/IndexInquiry.vue';
import IndexStaffCallendarEvent from '../components/Staff/Callendar/IndexEventCallendar.vue';
import IndexViewRecord from '../components/Staff/Records/Forms/IndexViewForm.vue';
import TeethRecord from '../components/Staff/Records/Forms/TeethRecord.vue';
import PatientHistory from '../components/Staff/Records/Forms/PatientHistory.vue';
import RescheduleAppointmentPage from '../components/Staff/Appointments/ReschedAppointment.vue';
import RecomendAppointment from '../components/Staff/Appointments/VerifyUser.vue';

// Admin View
import IndexAdminPage from "../components/Admin/IndexAdmin.vue"
import IndexManageAdminPatient from "../components/Admin/Patient/IndexManagePatient.vue"
import IndexManageStaff from "../components/Admin/Staff/IndexManageStaff.vue"
import IndexReferPatients from "../components/Admin/Refer/IndexRefer.vue"
import IndexManageServices from "../components/Admin/Services/IndexManageServices.vue";
import IndexAdminProfile from "../components/Admin/Profile/IndexAdminProfile.vue";
import IndexAdminArchive from '../components/Admin/Archive/IndexAdminArchive.vue';
import IndexAdminCalendar from '../components/Admin/Calendar/IndexAdminCalendar.vue';
import ViewPatientInfo from '../components/Admin/Refer/ViewPatientInfo.vue';
import Teeth from '../components/Admin/Refer/Teeth.vue';
import ChildTeeth from '../components/Admin/Refer/ChildTeeth.vue';
import PaymentInfo from '../components/Admin/Refer/Payments/PaymentInfo.vue';
import AddToothPayment from '../components/Admin/Refer/Payments/AddToothPayment.vue';



const routes = [
    // {
    //     path: '/user/patient/booking',
    //     name: 'patient-booking',
    //     component: PatientIndexPage
    // },
    {
        path: '/user/patient/booking',
        name: 'calendar-event',
        component: IndexCalendarEventPage
    },
    {
        path: '/user/patient/decline',
        name: 'appointment-decline',
        component: DeclineAppointment
    },
    {
        path: '/user/patient/appointment',
        name: 'patient_appointment',
        component: PatientIndexAppointment
    },
    {
        path: '/user/patient/profile',
        name: 'patient_profile',
        component: IndexPatientProfile
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
        path: '/user/staff/appointment/recomend/:id',
        name: 'recomend-appointment',
        component: RecomendAppointment,
    },
    {
        path: '/user/staff/appointment/resched/:id',
        name: 'resched-appointment',
        component: RescheduleAppointmentPage,
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
    {
        path: '/user/staff/trasanction',
        name: 'admin-transaction',
        component: IndexTransaction,
    },
    {
        path: '/user/staff/record',
        name: 'admin-record',
        component: IndexRecords,
    },
    // End  of Staff Page

    // Start of Admin Page
    {
        path: '/user/admin/dashboard',
        name: 'admin-dashboard',
        component: IndexAdminPage,
    },
    {
        path: '/user/admin/patient',
        name: 'admin-patient',
        component: IndexManageAdminPatient,
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
        path: '/user/staff/record/view/:id',
        name: 'assistant-view',
        component: IndexViewRecord,
    },
    {
        path: '/user/patient/history/:id',
        name: 'assistant-history',
        component: PatientHistory,
    },
    {
        path: '/user/staff/record/teeth/:id',
        name: 'assistant-teeth',
        component: TeethRecord,
    },
    {
        path: '/user/admin/view/:id',
        name: 'patient-view',
        component: ViewPatientInfo,
    },
    {
        path: '/user/admin/payment/:id',
        name: 'payment-view',
        component: PaymentInfo,
    },
    {
        path: '/user/admin/payment/add/:id',
        name: 'payment-add',
        component: AddToothPayment,
    },
    {
        path: '/user/admin/diagnose/:id',
        name: 'patient-diagnose',
        component: Teeth,
    },
    {
        path: '/user/admin/child/:id',
        name: 'child-teeth',
        component: ChildTeeth,
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