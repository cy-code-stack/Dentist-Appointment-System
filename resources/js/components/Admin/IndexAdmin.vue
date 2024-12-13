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
                    <p class="fs-2 fw-semibold mb-0">100</p>
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
                    <p class="fs-2 fw-semibold mb-0">10</p>
                    <p class="fs-6 fw-medium mb-0">Total Services</p>
                </div>
            </div>
        </div>
        <div class="main-card card p-3 bg-primary bg-gradient" style="min-width: 300px; border: none">
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Trasaction History</p>
            </div>
            <div class="card-icon d-flex justify-content-around align-items-center">
                <div class="col col-lg-3">
                    <i class="fa-solid fa-calendar-check fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">20</p>
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
                    <p class="fs-2 fw-semibold mb-0">20</p>
                    <p class="fs-6 fw-medium mb-0">Total Staff</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <div class="col col-lg-12">
                <div class="active-card card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="fs-4 fw-semibold mb-0">Current Transactions</p>
                        <div class="sort">
                            <div class="select-input d-flex justify-content-center align-items-center">
                                <select class="form-control form-control-sm">
                                    <option selected disabled>Sort by</option>
                                    <option value="">Pending</option>
                                    <option value="">Completed</option>
                                    <option value="">Decline</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive-lg">
                        <div class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2">
                            <div class="text-center col-lg-3">
                                <p class="fs-6 fw-semibold mb-0">Name</p>
                            </div>
                            <div class="text-center col-lg-3">
                                <p class="fs-6 fw-semibold mb-0">
                                    Appointment Schedule
                                </p>
                            </div>
                            <div class="text-center col-lg-3">
                                <p class="fs-6 fw-semibold mb-0">Services</p>
                            </div>
                            <div class="text-center col-lg-3">
                                <p class="fs-6 fw-semibold mb-0">Status</p>
                            </div>
                        </div>
                        <div class="main-table-body">
                            <div class="table-row card mb-2">
                                <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                                    <div class="text-center col-lg-3">
                                        <p class="fs-6 mb-0 fw-medium text-black-50">John Doe</p>
                                    </div>
                                    <div class="text-center col-lg-3">
                                        <p class="fs-6 mb-0 fw-medium text-black-50">
                                            May 3 2024 9:30 AM - 10:30 AM
                                        </p>
                                    </div>
                                    <div class="text-center col-lg-3">
                                        <p
                                            class="fs-6 mb-0 fw-medium text-black-50"
                                        >
                                            Tooth Cleaning
                                        </p>
                                    </div>
                                    <div
                                        class="text-center justify-content-center col-lg-3 rounded-1"
                                    >
                                        <p
                                            class="fs-6 fw-medium mb-0 text-warning"
                                        >
                                            Pending
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="container-fluid d-flex justify-content-end align-items-center"
                        >
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a
                                            class="page-link"
                                            href="#"
                                            aria-label="Previous"
                                        >
                                            <span aria-hidden="true"
                                                >&laquo;</span
                                            >
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a
                                            class="page-link"
                                            href="#"
                                            aria-label="Next"
                                        >
                                            <span aria-hidden="true"
                                                >&raquo;</span
                                            >
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="container-fluid">
                            <p class="text-center fw-medium fs-4 mb-2">Date Filter</p>
                            <div class="d-flex justify-content-between align-items-center mb-4 gap-2">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Start Month</span>
                                    <input type="date" class="form-control" v-model="startDate" @change="fetchAndRenderCharts">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">End Month</span>
                                    <input type="date" class="form-control" v-model="endDate" @change="fetchAndRenderCharts">
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items center gap-2">
                                <div class="d-flex flex-column w-100">
                                    <p class="fs-4 fw-semibold mb-1">Appointment Booking Rate</p>
                                    <canvas id="barPieChart" class="chart"></canvas>
                                </div>
                                <div class="d-flex flex-column w-100">
                                    <p class="fs-4 fw-semibold mb-1">Catered Patient</p>
                                    <canvas id="barChart" class="chart"></canvas>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items center gap-2">
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
            barAreaCtx: null,
            barPieCtx: null,
            barChart: null,
            lineChart: null,
            startDate: null,
            endDate: null,
        };
    },
    methods: {
        fetchAndRenderCharts() {
            const barCtx = document.getElementById("barChart");
            const barPieCtx = document.getElementById("barPieChart");
            const barAreaCtx = document.getElementById("barAreaChart");
            const lineCtx = document.getElementById("lineChart");

            if (this.barChart) this.barChart.destroy();
            if (this.barRateCtx) this.barRateCtx.destroy();
            if (this.lineChart) this.lineChart.destroy();

            this.createBarChart(barCtx);
            this.createPieRateChart(barPieCtx);
            this.createAreaChart(barAreaCtx);
            this.createLineChart(lineCtx);
        },

        createAreaChart(ctx) {
            axios.get('/user/admin/appointment/top', {
                params: { start_date: this.startDate, end_date: this.endDate },
            }).then((response) => {
                const labels = response.data.map(service => service.services_name); 
                const data = response.data.map(service => service.services_count);

                this.areaChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: labels, 
                        datasets: [
                            {
                                label: "Services Rendered",
                                data: data, 
                                backgroundColor: "rgba(13, 110, 253, 0.3)", 
                                borderColor: "rgba(13, 110, 253, 1)", 
                                fill: true,
                                tension: 0.4,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: 20,
                                ticks: {
                                    stepSize: 1,
                                },
                            },
                            x: {
                                ticks: {
                                    autoSkip: false,
                                },
                            },
                        },
                        plugins: {
                            legend: {
                                display: true,
                            },
                        },
                    },
                });
            }).catch((error) => {
                console.log(error);
            });
        },



        createPieRateChart(ctx) {
            axios.get('/user/admin/appointment/percentage', {
                    params: { start_date: this.startDate, end_date: this.endDate },
                }).then((response) => {
                    const data = Object.values(response.data);
                    const labels = [
                        "January", "February", "March", "April", "May", 
                        "June", "July", "August", "September", 
                        "October", "November", "December"
                    ];

                    this.pieChart = new Chart(ctx, {
                        type: "pie",
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    label: "Rate (Percentage)",
                                    data: data,
                                    backgroundColor: [
                                        "rgba(13, 110, 253, 0.8)", 
                                        "rgba(220, 53, 69, 0.8)", 
                                        "rgba(40, 167, 69, 0.8)", 
                                        "rgba(255, 193, 7, 0.8)", 
                                        "rgba(23, 162, 184, 0.8)", 
                                        "rgba(108, 117, 125, 0.8)", 
                                        "rgba(253, 126, 20, 0.8)", 
                                        "rgba(255, 7, 58, 0.8)", 
                                        "rgba(111, 66, 193, 0.8)", 
                                        "rgba(0, 123, 255, 0.8)", 
                                        "rgba(52, 58, 64, 0.8)", 
                                        "rgba(232, 62, 140, 0.8)"
                                    ],
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const percentage = context.raw;
                                            return `${context.label}: ${percentage}%`; 
                                        },
                                    },
                                },
                            },
                        },
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },


        
        createBarChart(ctx) {
            axios.get('/user/admin/count', {
                    params: { start_date: this.startDate, end_date: this.endDate },
                })
                .then((response) => {
                    this.barChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: [
                                "January", "February", "March", "April", "May", 
                                "June", "July", "August", "September", 
                                "October", "November", "December"
                            ],
                            datasets: [
                                {
                                    label: "Patient Catered",
                                    data: Object.values(response.data),
                                    backgroundColor: "rgba(13, 110, 253)",
                                    borderRadius: 5,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: Math.max(...Object.values(response.data)) + 5,
                                },
                            },
                        },
                    });
                })
                .catch((error) => {
                    console.error(error);
                });
        },

        createLineChart(ctx) {
            axios.get('/user/admin/sales/count', {
                    params: { start_date: this.startDate, end_date: this.endDate },
                })
                .then((response) => {
                    this.lineChart = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: [
                                "January", "February", "March", "April", "May", 
                                "June", "July", "August", "September", 
                                "October", "November", "December"
                            ],
                            datasets: [
                                {
                                    label: "Sales",
                                    data: Object.values(response.data),
                                    borderColor: "rgba(54, 162, 235)",
                                    borderWidth: 1,
                                    fill: false,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: Math.max(...Object.values(response.data)) + 100,
                                },
                            },
                        },
                    });
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
    mounted() {
        const today = new Date();
        const startOfYear = new Date(today.getFullYear(), 0, 1).toISOString().slice(0, 10);
        const endOfYear = new Date(today.getFullYear(), 11, 31).toISOString().slice(0, 10);

        this.startDate = startOfYear;
        this.endDate = endOfYear;

        this.fetchAndRenderCharts();
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
