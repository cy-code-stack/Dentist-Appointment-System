<template>
    <div class="container-fluid">
      <div class="container p-2 d-flex justify-content-evenly flex-wrap">
        <canvas id="barChart" class="chart"></canvas>
        <canvas id="lineChart" class="chart"></canvas>
      </div>
      <div class="container">
        <div class="txt-title mt-2">
            <p class="fs-5 fw-semibold mb-0">Sales Report</p>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-2">
            <div class="sort">
                <div class="select-input d-flex justify-content-center align-items-center">
                    <form class="d-flex" role="search">
                        <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    <button class="btn btn-success btn-gradient btn-sm">
                        <i class="fa-solid fa-file-pdf me-2"></i>
                        <span>Generate Report</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="table-responsive-lg">
            <div class="header d-flex p-2 justify-content-between align-items-center bg-info bg-gradient rounded-1 mb-2">
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Name</p>
                </div>
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Services</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Assigned Doctor</p>
                </div>
                <div class="text-center col-lg-2">
                    <p class="fs-6 fw-semibold mb-0">Income</p>
                </div>
                <div class="text-center col-lg-3">
                    <p class="fs-6 fw-semibold mb-0">Actions</p>
                </div>
            </div>
            <div class="main-table-body">
                <div class="table-row card mb-1">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Dentist 1
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-black-50">
                                1100 PHP
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>More Details</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-1">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Dentist 1
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-black-50">
                                1100 PHP
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>More Details</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-1">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Dentist 1
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-black-50">
                                1100 PHP
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>More Details</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-1">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Dentist 1
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-black-50">
                                1100 PHP
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>More Details</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-1">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Dentist 1
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-black-50">
                                1100 PHP
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>More Details</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-1">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Dentist 1
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-black-50">
                                1100 PHP
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>More Details</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-1">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Dentist 1
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-black-50">
                                1100 PHP
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>More Details</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-1">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Dentist 1
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-black-50">
                                1100 PHP
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>More Details</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-1">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Dentist 1
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-black-50">
                                1100 PHP
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>More Details</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-row card mb-1">
                    <div class="d-flex p-2 justify-content-between align-items-center bg-light bg-gradient rounded-1">
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Paul Petter
                            </p>
                        </div>
                        <div class="text-center col-lg-3">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                               Teeth Cleaning
                            </p>
                        </div>
                        <div class="text-center col-lg-2">
                            <p class="fs-6 mb-0 fw-medium text-black-50">
                                Dentist 1
                            </p>
                        </div>
                        <div
                            class="text-center justify-content-center col-lg-2">
                            <p class="fs-6 fw-medium mb-0 text-black-50">
                                1100 PHP
                            </p>
                        </div>
                        <div class="text-center d-flex justify-content-center col-lg-3">
                            <button type="button" class="me-1 rounded-1 btn btn-info btn-sm text-white">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-eye me-2"></i>
                                    <span>More Details</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid d-flex justify-content-end align-items-center">
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
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
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
      </div>
    </div>
</template>
  
  <script>
  import Chart from 'chart.js/auto';
  
  export default {
    data() {
      return {
        barChartData: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          datasets: [{
            label: 'Net Income Sales (Monthly)',
            data: [12000, 19000, 3000, 5000, 2000, 3000, 10000, 8000, 15000, 7000, 9000, 6000],
            backgroundColor: 'rgba(54, 162, 235)',
            borderRadius: 5
          }]
        },
        lineChartData: {
          labels: ['2020', '2021', '2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030', '2031'],
          datasets: [{
            label: 'Yearly Net Income Sales',
            data: [100000, 120000, 130000, 140000, 160000, 180000, 190000, 200000, 220000, 230000, 240000, 250000],
            borderColor: 'rgba(54, 162, 235)',
            borderWidth: 2,
            fill: false
          }]
        },
        
      };
    },
    methods: {
      createBarChart(ctx) {
        const barChart = new Chart(ctx, {
          type: 'bar',
          data: this.barChartData,
          options: {
            scales: {
              y: {
                beginAtZero: true,
                max: 20000
              }
            }
          }
        });
      },
      createLineChart(ctx) {
        const lineChart = new Chart(ctx, {
          type: 'line',
          data: this.lineChartData,
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      },
     
    },
    mounted() {
      const barCtx = document.getElementById('barChart');
      const lineCtx = document.getElementById('lineChart');
  
      if (!barCtx || !lineCtx) {
        console.error('Could not find canvas elements');
        return;
      }
  
      this.createBarChart(barCtx);
      this.createLineChart(lineCtx);
    }
  };
  </script>
  
  <style scoped>
  .chart {
    max-width: 600px; 
    max-height: 500px;
  }
  </style>
  