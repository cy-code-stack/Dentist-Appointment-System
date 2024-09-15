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
                        <div class="container-fluid d-flex justify-content-evenly align-items-center flex-wrap">
                            <canvas id="barChart" class="chart"></canvas>
                            <canvas id="lineChart" class="chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Chart from "chart.js/auto";

export default {
    data() {
        return {
            barChartData: {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                ],
                datasets: [
                    {
                        label: "Net Income Sales (Monthly)",
                        data: [
                            12000, 19000, 3000, 5000, 2000, 3000, 10000, 8000,
                            15000, 7000, 9000, 6000,
                        ],
                        backgroundColor: "rgba(54, 162, 235)",
                        borderRadius: 5,
                    },
                ],
            },
            lineChartData: {
                labels: [
                    "2020",
                    "2021",
                    "2022",
                    "2023",
                    "2024",
                    "2025",
                    "2026",
                    "2027",
                    "2028",
                    "2029",
                    "2030",
                    "2031",
                ],
                datasets: [
                    {
                        label: "Yearly Net Income Sales",
                        data: [
                            100000, 120000, 130000, 140000, 160000, 180000,
                            190000, 200000, 220000, 230000, 240000, 250000,
                        ],
                        borderColor: "rgba(54, 162, 235)",
                        borderWidth: 2,
                        fill: false,
                    },
                ],
            },
        };
    },
    methods: {
        createBarChart(ctx) {
            const barChart = new Chart(ctx, {
                type: "bar",
                data: this.barChartData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 20000,
                        },
                    },
                },
            });
        },
        createLineChart(ctx) {
            const lineChart = new Chart(ctx, {
                type: "line",
                data: this.lineChartData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        },
    },
    mounted() {
        const barCtx = document.getElementById("barChart");
        const lineCtx = document.getElementById("lineChart");

        if (!barCtx || !lineCtx) {
            console.error("Could not find canvas elements");
            return;
        }

        this.createBarChart(barCtx);
        this.createLineChart(lineCtx);
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
    max-width: 550px; 
    max-height: 500px;
  }
</style>
