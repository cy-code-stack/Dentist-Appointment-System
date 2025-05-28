<template>
    <div class="main-container-card container-fluid p-2 mt-2">
        <div class="main-card card p-3 bg-info bg-gradient" style="min-width: 300px; border: none">
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Patient</p>
            </div>
            <div class="card-icon d-flex justify-content-around align-items-center">
                <div class="col col-lg-3">
                    <i class="fa-solid fa-hospital-user fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">{{ patientCount }}</p>
                    <p class="fs-6 fw-medium mb-0">Patient Total</p>
                </div>
            </div>
        </div>
        <div class="main-card card p-3 bg-success bg-gradient" style="min-width: 300px; border: none">
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Medical Services</p>
            </div>
            <div class="card-icon d-flex justify-content-around align-items-center">
                <div class="col col-lg-3">
                    <i class="fa-solid fa-list-check fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">{{ serviceCount }}</p>
                    <p class="fs-6 fw-medium mb-0">Total Services</p>
                </div>
            </div>
        </div>
        <div class="main-card card p-3 bg-primary bg-gradient" style="min-width: 300px; border: none">
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Completed Trasaction</p>
            </div>
            <div class="card-icon d-flex justify-content-around align-items-center">
                <div class="col col-lg-3">
                    <i class="fa-solid fa-calendar-check fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">{{ transactionCount }}</p>
                    <p class="fs-6 fw-medium mb-0">Total Trasaction</p>
                </div>
            </div>
        </div>
        <div class="main-card card p-3 bg-warning bg-gradient text-white" style="min-width: 300px; border: none">
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Staff</p>
            </div>
            <div class="card-icon d-flex justify-content-around align-items-center">
                <div class="col col-lg-3">
                    <i class="fs-1 fa-solid fa-user-nurse"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">{{ assistantCount }}</p>
                    <p class="fs-6 fw-medium mb-0">Total Staff</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="col col-lg-12">
                <div class="d-flex justify-content-end p-3">
                    <button type="button" class="rounded-1 btn btn-primary text-white" @click="printReport()">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-print me-2"></i>
                            <span>Print</span>
                        </div>
                    </button>
                </div>
                <div class="active-card card p-2">
                    <div class="table-responsive-lg">
                        <div class="container-fluid">
                            <!-- Filter Dropdown -->
                            <div class="d-flex justify-content-between align-items-center mb-4 gap-2">
                                <div class="input-group">
                                    <span class="input-group-text">Filter</span>
                                    <select class="form-select" v-model="selectedFilter" @change="updateDateRange">
                                        <option value="daily">Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card mb-4" v-if="selectedFilter === 'daily'">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">Today's Appointments</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Appointment No.</th>
                                                    <th>Appointment Type</th>
                                                    <th>Patient Name</th>
                                                    <th>Service</th>
                                                    <th>Appointment Time</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-row text-center" v-for="appointment in dailyAppointments" :key="appointment.id">
                                                    <td>{{ appointment.id }}</td>
                                                    <td>{{ appointment.type ?? "Walk-in"}}</td>
                                                    <td>{{ appointment.patient_name }}</td>
                                                    <td>{{ appointment.services }}</td>
                                                    <td>{{ formatTime(appointment.sched_time) }}</td>
                                                    <td>{{ appointment.status }}</td>
                                                    <td>₱{{ appointment.amount }}</td>
                                                </tr>
                                                <tr v-if="dailyAppointments.length === 0">
                                                    <td colspan="7" class="text-center">No appointments for today</td>
                                                </tr>
                                                <tr class="table-row table-active text-center">
                                                    <td colspan="6" class="text-end fw-bold">Total:</td>
                                                    <td class="fw-bold">{{ formatCurrency(dailyTotal.amount) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Charts -->
                            <div class="d-flex justify-content-between align-items-center gap-2">
                                <div class="d-flex flex-column w-100">
                                    <p class="fs-4 fw-semibold mb-1">Appointment Booking Rate</p>
                                    <canvas id="barPieChart" class="chart"></canvas>
                                </div>
                                <div class="d-flex flex-column w-100">
                                    <p class="fs-4 fw-semibold mb-1">Patient Catered</p>
                                    <canvas id="barChart" class="chart"></canvas>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-2">
                                <div class="d-flex flex-column w-100">
                                    <p class="fs-4 fw-semibold mb-1">Revenue</p>
                                    <canvas id="lineChart" class="chart"></canvas>
                                </div>
                                <div class="d-flex flex-column w-100">
                                    <p class="fs-4 fw-semibold mb-1">Top Requested Services</p>
                                    <canvas id="barAreaChart" class="chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Chart from "chart.js/auto";

export default {
    data() {
        return {
            selectedFilter: "daily",
            // startDate: "",
            // endDate: "",
            barChart: null,
            pieChart: null,
            lineChart: null,
            barAreaChart: null,
            patientCount: 0,
            serviceCount: 0,
            transactionCount: 0,
            assistantCount: 0,
            dailyAppointments: [], 
        };
    },
    computed: {
        dailyTotal() {
            // Calculate the total amount for daily appointments
            const amount = this.dailyAppointments.reduce((sum, appt) => {
                const val = Number(appt.amount) || 0;
                return sum + val;
            }, 0);
            return { amount };
        }
    },
    methods: {
        formatCurrency(value) {
            if (typeof value !== 'number') value = Number(value) || 0;
            return value.toLocaleString('en-PH', { style: 'currency', currency: 'PHP', minimumFractionDigits: 2 }).replace('PHP', '₱');
        },
        displayPatientCount(){
            axios.get('/user/admin/patient/patientCount').then((response)=>{
                this.patientCount = response.data.data;
            }).catch((error)=>{
                console.log(error);
            });
        },

        fetchDailyAppointments() {
            if (this.selectedFilter === 'daily') {
                axios.get('/user/admin/appointment/daily')
                .then(response => {
                    this.dailyAppointments = response.data.data;
                }).catch(error => {
                    console.error("Error fetching daily appointments:", error);
                });
            }
        },

        formatTime(timeString) {
            if (!timeString) return '';
            const time = new Date(`2000-01-01T${timeString}`);
            return time.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        },

        displayServicesCount(){
            axios.get('/user/admin/services/adminCountServices').then((response)=>{
                this.serviceCount = response.data.data;
            }).catch((error)=>{
                console.log(error);
            });
        },
        displayTransactionCount(){
            axios.get('/user/admin/transtraction/adminTransactionCount').then((response)=>{
                this.transactionCount = response.data.data;
            }).catch((error)=>{
                console.log(error);
            });
        },
        displayAssistantCount(){
            axios.get('/user/admin/assistant/assistantCount').then((response)=>{
                this.assistantCount = response.data.data;
            }).catch((error)=>{
                console.log(error);
            });
        },
        updateDateRange() {
            const today = new Date();
            const year = today.getFullYear();
            const month = today.getMonth();
            const day = today.getDate();

            if (this.selectedFilter === "daily") {
                this.startDate = new Date(year, month, day).toISOString().slice(0, 10);
                this.endDate = this.startDate;
            } else if (this.selectedFilter === "weekly") {
                const firstDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
                const lastDayOfWeek = new Date(today.setDate(today.getDate() + 6));
                this.startDate = firstDayOfWeek.toISOString().slice(0, 10);
                this.endDate = lastDayOfWeek.toISOString().slice(0, 10);
            } else if (this.selectedFilter === "monthly") {
                this.startDate = new Date(year, month, 1).toISOString().slice(0, 10);
                this.endDate = new Date(year, month + 1, 0).toISOString().slice(0, 10);
            }

            this.fetchAndRenderCharts(); // Update charts
        },

        fetchAndRenderCharts() {
            const barCtx = document.getElementById("barChart");
            const barPieCtx = document.getElementById("barPieChart");
            const barAreaCtx = document.getElementById("barAreaChart");
            const lineCtx = document.getElementById("lineChart");

            if (this.barChart) this.barChart.destroy();
            if (this.pieChart) this.pieChart.destroy();
            if (this.lineChart) this.lineChart.destroy();
            if (this.barAreaChart) this.barAreaChart.destroy();

            this.createBarChart(barCtx);
            this.createPieRateChart(barPieCtx);
            this.createBarChart2(barAreaCtx);
            this.createLineChart(lineCtx);
        },

        createBarChart2(ctx) {
            axios.get('/user/admin/appointment/top', {
                params: { start_date: this.startDate, end_date: this.endDate },
            }).then((response) => {
                const labels = response.data.map(service => service.services_name);
                const data = response.data.map(service => service.services_count);

                this.barAreaChart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Services Rendered",
                            data: data,
                            backgroundColor: "rgba(13, 110, 253, 0.7)",
                            borderColor: "rgba(13, 110, 253, 1)",
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: { y: { beginAtZero: true, suggestedMax: 20 } },
                    },
                });
            }).catch(error => console.log(error));
        },

        createPieRateChart(ctx) {
            axios.get('/user/admin/appointment/percentage', {
                params: { start_date: this.startDate, end_date: this.endDate },
            }).then((response) => {
                const data = Object.values(response.data);
                const labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

                this.pieChart = new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Rate (Percentage)",
                            data: data,
                            backgroundColor: [
                                "rgba(13, 110, 253, 0.8)", "rgba(220, 53, 69, 0.8)", "rgba(40, 167, 69, 0.8)", "rgba(255, 193, 7, 0.8)",
                                "rgba(23, 162, 184, 0.8)", "rgba(108, 117, 125, 0.8)", "rgba(253, 126, 20, 0.8)", "rgba(255, 7, 58, 0.8)"
                            ],
                        }],
                    },
                    options: { responsive: true },
                });
            }).catch(error => console.log(error));
        },

        createBarChart(ctx) {
            axios.get('/user/admin/count')
                .then((response) => {
                    this.barChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: [
                                "January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                            ],
                            datasets: [{
                                label: "Patient Catered",
                                data: Object.values(response.data),
                                backgroundColor: "rgba(13, 110, 253)",
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            scales: { y: { beginAtZero: true, suggestedMax: 20 } },
                        },
                    });
                })
                .catch(error => console.error(error));
        },

        createLineChart(ctx) {
            axios.get('/user/admin/sales/count', {
                params: { start_date: this.startDate, end_date: this.endDate },
            }).then((response) => {
                const salesData = Object.values(response.data);
                const maxValue = Math.max(...salesData) * 1.5; 

                this.lineChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        datasets: [{
                            label: "Sales",
                            data: salesData,
                            borderColor: "rgba(54, 162, 235)",
                            fill: false,
                        }],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    suggestedMax: maxValue // Adjusted Y-axis max
                                }
                            }
                        }
                    },
                });
            }).catch(error => console.error(error));
        },
        printReport() {
            axios.get(`/print/consolidated-report`)
                .then(response => {
                    const printPath = response.data.path;
                    window.open(printPath, '_blank');
                })
                .catch(error => {
                    console.error("Error printing appointment:", error.response?.data?.message || error.message);
                });
        }
    },
    mounted() {
        this.updateDateRange();
        this.displayPatientCount();
        this.displayServicesCount();
        this.displayTransactionCount();
        this.displayAssistantCount();
        this.fetchDailyAppointments();
    },
};
</script>



<style scoped>
.main-container-card {
    display: flex !important;
    justify-content: space-evenly;
    flex-wrap: wrap;
}
.main-card {
    cursor: default;
}
.active-card {
    min-height: 72vh;
    margin-bottom: 0;
    border: none;
    background-color: transparent !important;
    box-shadow: none;
}
.select-input {
    width: 10rem !important;
}
.table-row {
    border: none;
    background-color: #d6ebff;
    border-radius: 0;
}
.chart {
    max-width: 100%; 
    max-height: 500px;
  }
</style>
