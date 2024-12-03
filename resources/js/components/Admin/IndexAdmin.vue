<template>
    <div class="main-container-card container-fluid p-2 mt-2">
        <div
            class="main-card card p-3 bg-info bg-gradient"
            style="min-width: 300px; border: none"
        >
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Patient</p>
            </div>
            <div
                class="card-icon d-flex justify-content-around align-items-center"
            >
                <div class="col col-lg-3">
                    <i class="fa-solid fa-hospital-user fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">100</p>
                    <p class="fs-6 fw-medium mb-0">Patient Total</p>
                </div>
            </div>
        </div>
        <div
            class="main-card card p-3 bg-success bg-gradient"
            style="min-width: 300px; border: none"
        >
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Medical Services</p>
            </div>
            <div
                class="card-icon d-flex justify-content-around align-items-center"
            >
                <div class="col col-lg-3">
                    <i class="fa-solid fa-list-check fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">10</p>
                    <p class="fs-6 fw-medium mb-0">Total Services</p>
                </div>
            </div>
        </div>
        <div
            class="main-card card p-3 bg-primary bg-gradient"
            style="min-width: 300px; border: none"
        >
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Trasaction History</p>
            </div>
            <div
                class="card-icon d-flex justify-content-around align-items-center"
            >
                <div class="col col-lg-3">
                    <i class="fa-solid fa-calendar-check fs-1"></i>
                </div>
                <div class="col col-md-8">
                    <p class="fs-2 fw-semibold mb-0">20</p>
                    <p class="fs-6 fw-medium mb-0">Total Trasaction</p>
                </div>
            </div>
        </div>
        <div
            class="main-card card p-3 bg-warning bg-gradient text-white"
            style="min-width: 300px; border: none"
        >
            <div class="card-title">
                <p class="fs-5 fw-semibold mb-1">Staff</p>
            </div>
            <div
                class="card-icon d-flex justify-content-around align-items-center"
            >
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
                    <div
                        class="d-flex justify-content-between align-items-center mb-3"
                    >
                        <p class="fs-4 fw-semibold mb-0">
                            Current Transactions
                        </p>
                        <div class="sort">
                            <div
                                class="select-input d-flex justify-content-center align-items-center"
                            >
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
                        <div
                            class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2"
                        >
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
                                <div
                                    class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1"
                                >
                                    <div class="text-center col-lg-3">
                                        <p
                                            class="fs-6 mb-0 fw-medium text-black-50"
                                        >
                                            John Doe
                                        </p>
                                    </div>
                                    <div class="text-center col-lg-3">
                                        <p
                                            class="fs-6 mb-0 fw-medium text-black-50"
                                        >
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
                            <p class="text-center fw-medium fs-4">Date Filter</p>
                            <div class="d-flex justify-content-between align-items-center mt-3 mb-2 gap-2">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Start Month</span>
                                    <input type="date" class="form-control" v-model="startDate" @change="fetchAndRenderCharts">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">End Month</span>
                                    <input type="date" class="form-control" v-model="endDate" @change="fetchAndRenderCharts">
                                </div>
                            </div>
                            <div class="d-flex flex-column mt-5 mb-2 gap-2">
                                <p class="fs-4 fw-semibold">Patients Demographics</p>
                                <canvas id="pieChart" class="chart"></canvas>
                            </div>
                            <div class="d-flex flex-column mt-2 mb-2 gap-2">
                                <p class="fs-4 fw-semibold">Patient Catered</p>
                                <canvas id="barChart" class="chart"></canvas>
                            </div>
                            <div class="d-flex flex-column mt-2 mb-2 gap-2">
                                <p class="fs-4 fw-semibold">Monthly Income</p>
                                <canvas id="lineChart" class="chart"></canvas>
                            </div>
                            <div class="d-flex flex-column mt-2 mb-2 gap-2">
                                <p class="fs-4 fw-semibold">Patient Appointment Data</p>
                                <canvas id="scatterChart" class="chart"></canvas>
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
            barChart: null,
            lineChart: null,
            pieChart: null,
            scatterChart: null,
            startDate: null,
            endDate: null,
        };
    },
    methods: {
        fetchAndRenderCharts() {
            const barCtx = document.getElementById("barChart");
            const lineCtx = document.getElementById("lineChart");
            const pieCtx = document.getElementById("pieChart");
            const scatterCtx = document.getElementById("scatterChart");

            if (this.barChart) this.barChart.destroy();
            if (this.lineChart) this.lineChart.destroy();
            if (this.pieChart) this.pieChart.destroy();
            if (this.scatterChart) this.scatterChart.destroy();

            this.createBarChart(barCtx);
            this.createLineChart(lineCtx);
            this.createPieChart(pieCtx);
            this.createScatterChart(scatterCtx);
        },
        
        createPieChart(ctx) {
            axios.get('/user/admin/patient/demographics').then((response)=>{
                    const data = {
                        labels: ["Male", "Female"],
                        datasets: [{
                            data: Object.values(response.data), 
                            backgroundColor: ["#89CFF0", "#FF69B4"],
                            hoverOffset: 4,
                        }]
                    };

                    this.pieChart = new Chart(ctx, {
                        type: "pie",
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'center',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw + ' patients';
                                        }
                                    }
                                }
                            }
                        }
                    });
                }).catch((error) =>{
                    console.log(error);
                });
        },

        createScatterChart(ctx) {
            const data = {
                datasets: [{
                    label: 'Patient Appointment Data',
                    data: [
                        { x: 1, y: 1200 }, 
                        { x: 2, y: 750 },   
                        { x: 3, y: 2000 },   
                        { x: 4, y: 1300 },  
                        { x: 5, y: 1500 },   
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 1)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 3,
                }]
            };

            this.scatterChart = new Chart(ctx, {
                type: 'scatter',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'linear',
                            position: 'bottom',
                            title: {
                                display: true,
                                text: 'Appointment Number'
                            }
                        },
                        y: {
                            min: 0,
                            max: 3000,
                            title: {
                                display: true,
                                text: 'Payment Amount (Peso)'  
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const appointmentNumber = tooltipItem.raw.x;
                                    const paymentAmount = tooltipItem.raw.y;
                                    return `Appointment ${appointmentNumber}: ₱ ${paymentAmount}`;
                                }
                            }
                        }
                    }
                }
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
                                    label: "Monthly Income",
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
                                    max: Math.max(...Object.values(response.data)) + 1000,
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
