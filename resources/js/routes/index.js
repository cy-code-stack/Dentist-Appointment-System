import { createRouter, createWebHistory } from 'vue-router';

//Patient View
import PatientIndexPage from "../components/Patient/PatientIndex.vue";

const routes = [
    {
        path: '/appointment/booking',
        name: 'patient',
        component: PatientIndexPage
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;