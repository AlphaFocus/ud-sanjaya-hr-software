<div class="w-full">
  
    <div class="flex flex-col md:flex-row w-full p-2 space-y-4 md:space-y-0 md:space-x-4">

      {{-- Stats --}}
        <div class="md:w-1/2 space-y-4 xl:flex xl:flex-row xl:space-y-0 xl:space-x-4">
          {{-- Penjualan --}}
          <div class="w-full xl:w-1/2 transition duration-500 transform hover:scale-105">
              <div class="relative flex justify-between overflow-hidden bg-white border border-gray-100 rounded-lg shadow-md lg:flex-wrap xl:flex-nowrap">
                  <div class="flex flex-wrap justify-between w-1/2 p-4 md:w-1/2 lg:w-7/12">
                      <div class="w-full">
                          <h4 class="leading-tight text-gray-500 text-md">Penjualan</h4>
                          @php
                            $sale2Week = $sale2Week == 0 ? "0" : number_format((($saleWeek->sum('quantity')-$sale2Week)/$sale2Week)*100, 2)
                          @endphp
                          <p class="text-xs leading-tight {{ $sale2Week == 0 ? "text-gray-400" : ($sale2Week > 0 ? "text-green-500" : "text-red-500") }}">
                            {{ $sale2Week == 0 ? "--" : ($sale2Week > 0 ? "▲" : "▼") }} 
                            {{ $sale2Week }} %
                          </p>
                      </div>
                      <div class="w-full text-md xl:text-lg font-semibold text-gray-700 xl:w-full xl:mt-0">
                          <h3 class="">{{ number_format($saleWeek->sum('quantity'), '0', '', '.') }}</h3>
                      </div>
                  </div>
                  <div class="w-6/12 md:w-1/2 lg:w-5/12">
                      <canvas id="chart1" height="70"></canvas>
                  </div>
              </div>
          </div>
          {{-- Produksi --}}
          <div class="w-full xl:w-1/2 transition duration-500 transform hover:scale-105">
              <div class="relative flex justify-between overflow-hidden bg-white border border-gray-100 rounded-lg shadow-md lg:flex-wrap xl:flex-nowrap">
                  <div class="flex flex-wrap justify-between w-1/2 p-4 md:w-1/2 lg:w-7/12">
                      <div class="w-full">
                          <h4 class="leading-tight text-gray-500 text-md">Produksi</h4>
                          @php
                            $prod2Week = $prod2Week == 0 ? "0" : number_format((($prodWeek->sum('quantity')-$prod2Week)/$prod2Week)*100, 2)
                          @endphp
                          <p class="text-xs leading-tight {{ $prod2Week == 0 ? "text-gray-400" : ($prod2Week > 0 ? "text-green-500" : "text-red-500") }}">
                            {{ $prod2Week == 0 ? "--" : ($prod2Week > 0 ? "▲" : "▼") }} 
                            {{ $prod2Week }} %
                          </p>
                      </div>
                      <div class="w-full text-md xl:text-lg font-semibold text-gray-700 xl:w-full xl:mt-0">
                          <h3 class="">{{ number_format($prodWeek->sum('quantity'), '0', '', '.') }}</h3>
                      </div>
                  </div>
                  <div class="w-6/12 md:w-1/2 lg:w-5/12">
                      <canvas id="chart2" height="70"></canvas>
                  </div>
              </div>
          </div>
        </div>

        <div class="md:w-1/2 space-y-4 xl:flex xl:flex-row xl:space-y-0 xl:space-x-4">
          {{-- Pendapatan --}}
          <div class="w-full xl:w-1/2 transition duration-500 transform hover:scale-105">
              <div class="relative flex justify-between overflow-hidden bg-white border border-gray-100 rounded-lg shadow-md lg:flex-wrap xl:flex-nowrap">
                  <div class="flex flex-wrap justify-between w-1/2 p-4 md:w-1/2 lg:w-7/12">
                    <div class="w-full">
                        <h4 class="leading-tight text-gray-500 text-md">Pendapatan</h4>
                        {{-- @php
                          $sale2Week = $sale2Week == 0 ? "0" : number_format((($saleWeek->sum('quantity')-$sale2Week)/$sale2Week)*100, 2)
                        @endphp --}}
                        <p class="text-xs leading-tight {{ $sale2Week == 0 ? "text-gray-400" : ($sale2Week > 0 ? "text-green-500" : "text-red-500") }}">
                          {{ $sale2Week == 0 ? "--" : ($sale2Week > 0 ? "▲" : "▼") }} 
                          {{ $sale2Week }} %
                        </p>
                    </div>
                    <div class="w-full text-md xl:text-lg font-semibold text-gray-700 xl:w-full xl:mt-0">
                        <h3 class="inline">Rp. {{ number_format($saleWeek->sum('quantity')*10000, '0', '', '.') }}</h3>
                    </div>
                  </div>
                  <div class="w-6/12 md:w-1/2 lg:w-5/12">
                      <canvas id="chart3" height="70"></canvas>
                  </div>
              </div>
          </div>
          {{-- Pengeluaran --}}
          <div class="w-full xl:w-1/2 transition duration-500 transform hover:scale-105">
              <div class="relative flex justify-between overflow-hidden bg-white border border-gray-100 rounded-lg shadow-md lg:flex-wrap xl:flex-nowrap">
                  <div class="flex flex-wrap justify-between w-1/2 p-4 md:w-1/2 lg:w-7/12">
                      <div class="w-full">
                        <h4 class="leading-tight text-gray-500 text-md">Pengeluaran</h4>
                        <p class="text-xs leading-tight {{ $prod2Week == 0 ? "text-gray-400" : ($prod2Week > 0 ? "text-green-500" : "text-red-500") }}">
                          {{ $prod2Week == 0 ? "--" : ($prod2Week > 0 ? "▲" : "▼") }} 
                          {{ $prod2Week }} %
                        </p>
                      </div>
                      <div class="w-full text-md xl:text-lg font-semibold text-gray-700 xl:w-full xl:mt-0">
                          <h3 class="inline">Rp. {{ number_format($prodWeek->sum('quantity')*500, '0', '', '.') }}</h3>
                      </div>
                  </div>
                  <div class="w-6/12 md:w-1/2 lg:w-5/12">
                      <canvas id="chart4" height="70"></canvas>
                  </div>
              </div>
          </div>
        </div>

    </div>

    {{-- Bottom Section --}}
    <div class="flex flex-wrap lg:flex-row w-full flex-auto">

      {{-- Bar Chart --}}
      <div class="w-full lg:w-3/4 p-2">
        <div class="flex flex-col bg-white rounded-lg shadow-md p-4 h-full w-full">
              
          <div class="w-full mb-10">
            <h6 class="w-full text-xs font-semibold uppercase text-blueGray-400">
              Performa
            </h6>
            <h2 class="w-full text-xl font-semibold text-blueGray-700">
              Penjualan dan Produksi
            </h2>
          </div>

          <div class="w-full h-full">
              <!-- Chart -->
              <canvas id="bar-chart" width="463" height="515"></canvas>
          </div>

        </div>
      </div>

      {{-- Pie Chart --}}
      <div class="hidden lg:flex lg:w-1/4 p-2">
        <div class="flex flex-col w-full p-4 bg-white border border-gray-100 rounded-lg shadow-md justify-evenly">
          
          <h6 class="w-full text-xs font-semibold uppercase text-blueGray-400">
            Perbandingan
          </h6>
          <h2 class="w-full text-xl font-semibold text-blueGray-700">
            Keseluruhan
          </h2>

          <div class="flex flex-col flex-auto justify-evenly">

            <div class="">
              <!-- Chart -->
              <canvas id="doughnut1"></canvas>
            </div>

            <div class="">
              <!-- Chart -->
              <canvas id="doughnut2"></canvas>
            </div>

          </div>
    
        </div>
      </div>

    </div>

  {{-- Line chart --}}
  <script>
    config = {
          type: "bar",
          data: {
            labels: [
              @foreach ($prodYear as $label)
                "{{ $label->date }}",
              @endforeach
            ],
            datasets: [
              {
                label: "Penjualan",
                backgroundColor: "#4c51bf",
                borderColor: "#4c51bf",
                data: [
                  @foreach ($saleYear as $saleData)
                  {{ $saleData->quantity }},
                  @endforeach
                ],
                fill: false,
                barThickness: 8,
              },
              {
                label: "Produksi",
                fill: false,
                backgroundColor: "#ed64a6",
                borderColor: "#ed64a6",
                data: [
                  @foreach ($prodYear as $quantity)
                    "{{ $quantity->quantity }}",
                  @endforeach
                ],
                barThickness: 8,
              },
            ],
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            title: {
              display: false,
              text: "Orders Chart",
            },
            tooltips: {
              mode: "index",
              intersect: false,
            },
            hover: {
              mode: "nearest",
              intersect: true,
            },
            legend: {
              labels: {
                fontColor: "rgba(0,0,0,.4)",
              },
              align: "middle",
              position: "bottom",
            },
            scales: {
              xAxes: [
                {
                  display: false,
                  scaleLabel: {
                    display: true,
                    labelString: "Month",
                  },
                  gridLines: {
                    borderDash: [2],
                    borderDashOffset: [2],
                    color: "rgba(33, 37, 41, 0.3)",
                    zeroLineColor: "rgba(33, 37, 41, 0.3)",
                    zeroLineBorderDash: [2],
                    zeroLineBorderDashOffset: [2],
                  },
                },
              ],
              yAxes: [
                {
                  display: true,
                  scaleLabel: {
                    display: false,
                    labelString: "Value",
                  },
                  gridLines: {
                    borderDash: [2],
                    drawBorder: false,
                    borderDashOffset: [2],
                    color: "rgba(33, 37, 41, 0.2)",
                    zeroLineColor: "rgba(33, 37, 41, 0.15)",
                    zeroLineBorderDash: [2],
                    zeroLineBorderDashOffset: [2],
                  },
                  ticks: {
                    // suggestedMax: 200,
                  },
                },
              ],
            },
          },
        };
        
        ctx = document.getElementById("bar-chart").getContext("2d");
        window.myBar = new Chart(ctx, config);
    
  </script>

  {{-- Pie Chart --}}
  <script>
    chartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      title: {
        display: false,
        text: "Orders Chart",
      },
      tooltips: {
        mode: "index",
        intersect: false,
      },
      hover: {
        mode: "nearest",
        intersect: true,
      },
      legend: {
        labels: {
          fontColor: "rgba(0,0,0,.4)",
        },
        align: "middle",
        position: "right",
      },
    }
    //  
    ctx = document.getElementById("doughnut1").getContext("2d");
    window.myBar = new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: [
          "Penjualan",
          "Produksi",
        ],
        datasets: [
          {
            backgroundColor: ["rgba(101, 116, 205, 1)", "rgba(246, 109, 155, 1)"],
            data: [{{ $saleWeek->sum('quantity') }}, {{ $prodWeek->sum('quantity') }}],
          }
        ],
      },
      options: chartOptions,
    });
    //
    ctx = document.getElementById("doughnut2").getContext("2d");
    window.myBar = new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: [
          "Pendapatan",
          "Pengeluaran",
        ],
        datasets: [
          {
            // label: new Date().getFullYear(),
            backgroundColor: ["#06d6a0", "#ffd166"],
            data: [{{ $saleWeek->sum('quantity')*10000 }}, {{ $prodWeek->sum('quantity')*500 }}],
            fill: false,
          }
        ],
      },
      options: chartOptions,
    });
  </script>

  {{-- Stats chart --}}
  <script>
    chartOptions = {
        maintainAspectRatio: false,
        legend: {
            display: false,
        },
        tooltips: {
            enabled: false,
        },
        elements: {
            point: {
                radius: 0
            },
        },
        scales: {
            xAxes: [{
                gridLines: false,
                scaleLabel: false,
                ticks: {
                    display: false
                }
            }],
            yAxes: [{
                gridLines: false,
                scaleLabel: false,
                ticks: {
                    display: false,
                    suggestedMin: 0,
                    suggestedMax: 10
                }
            }]
        }
    };
    //
    ctx = document.getElementById('chart1').getContext('2d');
    chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: [0,
              @foreach($saleWeek as $saleLabel)
                {{ $saleLabel->quantity }},
              @endforeach
            ],
            datasets: [
                {
                    backgroundColor: "rgba(101, 116, 205, 0.1)",
                    borderColor: "rgba(101, 116, 205, 0.8)",
                    borderWidth: 2,
                    data: [0,
                      @foreach($saleWeek as $saleData)
                        {{ $saleData->quantity }},
                      @endforeach
                    ],
                },
            ],
        },
        options: chartOptions
    });
    //
    ctx = document.getElementById('chart2').getContext('2d');
    chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: [0,
              @foreach ($prodWeek as $prodlabel)
                {{ $prodlabel->quantity }},
              @endforeach
            ],
            datasets: [
                {
                    backgroundColor: "rgba(246, 109, 155, 0.1)",
                    borderColor: "rgba(246, 109, 155, 0.8)",
                    borderWidth: 2,
                    data: [0,
                      @foreach ($prodWeek as $prodData)
                        {{ $prodData->quantity }},
                      @endforeach
                    ],
                },
            ],
        },
        options: chartOptions
    });
    //
    ctx = document.getElementById('chart3').getContext('2d');
    chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: [0,
              @foreach($saleWeek as $profitLabel)
                {{ $profitLabel->quantity }},
              @endforeach
            ],
            datasets: [
                {
                    backgroundColor: "rgba(84, 234, 210, 0.1)",
                    borderColor: "rgba(84, 234, 210, 0.8)",
                    borderWidth: 2,
                    data: [0,
                    @foreach($saleWeek as $profitData)
                      {{ $profitData->quantity }},
                    @endforeach
                  ],
                },
            ],
        },
        options: chartOptions
    });

    ctx = document.getElementById('chart4').getContext('2d');
    chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: [0,
              @foreach ($prodWeek as $expenseLabel)
                {{ $expenseLabel->quantity }},
              @endforeach
            ],
            datasets: [
                {
                    backgroundColor: "rgba(246, 153, 63, 0.1)",
                    borderColor: "rgba(246, 153, 63, 0.8)",
                    borderWidth: 2,
                    data: [0,
                    @foreach ($prodWeek as $expenseData)
                      {{ $expenseData->quantity }},
                    @endforeach
                  ],
                },
            ],
        },
        options: chartOptions
    });
  </script>
</div>