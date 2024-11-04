@include('components.head')
@include('components.navbars')

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

    @include('components.topbar')

    <div class="container-fluid py-4">

        <div class="alert alert-dismissible fade show d-none" role="alert" id="dynamicAlert">
            <span class="alert-icon text-light"><i class="fas" id="alertIcon"></i></span>
            <span class="alert-text text-light" id="alertMessage"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        {{-- <div class="card">
            <div class="card-header pb-0 mb-0">
                <div class="d-flex justify-content-between">
                    <h6> <i class="fas fa-layer-group"></i> Dashboard</h6>
                </div>
            </div>
            <div class="card-body px-3 pt-0 pb-3 mt-0">
                
            </div>
        </div> --}}

        <div class="row">
            @foreach(range(0, 3) as $item)
            <div class="col-md-3 mb-4">
                <div class="card bg-gradient-light">
                    <div class="card-body p-3">
                      <div class="row">
                        <div class="col-8">
                          <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Card</p>
                            <h5 class="font-weight-bolder mb-0">
                              00.00
                              <span class="text-success text-sm font-weight-bolder">+00%</span>
                            </h5>
                          </div>
                        </div>
                        <div class="col-4 text-end">
                          <div class="icon icon-shape bg-gradient-dark shadow text-center border-radius-md">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            @endforeach

            <div class="col-md-12">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                      <h6>Sales overview</h6>
                      <p class="text-sm">
                        <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                        <span class="font-weight-bold">4% more</span> in 2021
                      </p>
                    </div>
                    <div class="card-body p-3">
                      <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="600" width="1033" style="display: block; box-sizing: border-box; height: 300px; width: 516.5px;"></canvas>
                      </div>
                    </div>
                  </div>
            </div>
        </div>

    </div>
</main>

@include('components.modal')
@include('components.footer')
 <script>
    var ctx2 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    new Chart(ctx2, {
    type: "line",
    data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#cb0c9f",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

        },
        {
            label: "Websites",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            fill: true,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
        },
        ],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            display: false,
        }
        },
        interaction: {
        intersect: false,
        mode: 'index',
        },
        scales: {
        y: {
            grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
            },
            ticks: {
            display: true,
            padding: 10,
            color: '#b2b9bf',
            font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        x: {
            grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            borderDash: [5, 5]
            },
            ticks: {
            display: true,
            color: '#b2b9bf',
            padding: 20,
            font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
            },
            }
        },
        },
    },
    });
 </script>