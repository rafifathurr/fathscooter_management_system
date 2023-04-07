<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
    @csrf
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">{{$title}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row mt--2">
                        <div class="col-md-6">
                            <div class="card full-height">
                                <div class="card-body">
                                    <div class="card-title">Statistics of Today</div>
                                    <div class="card-category">Daily information about statistics in system</div>
                                    <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                                        <div class="px-2 pb-2 pb-md-0 text-center">
                                            <div id="circles-1"></div>
                                            <h6 class="fw-bold mt-3 mb-0">Today Orders</h6>
                                        </div>
                                        <div class="px-2 pb-2 pb-md-0 text-center">
                                            <div id="circles-2"></div>
                                            <h6 class="fw-bold mt-3 mb-0">Month Orders</h6>
                                        </div>
                                        <div class="px-2 pb-2 pb-md-0 text-center">
                                            <div id="circles-3"></div>
                                            <h6 class="fw-bold mt-3 mb-0">Year Orders</h6>
                                        </div>
                                        <div class="px-2 pb-2 pb-md-0 text-center">
                                            <div id="circles-4"></div>
                                            <h6 class="fw-bold mt-3 mb-0">Total Orders</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card full-height">
                                <div class="card-body">
                                    <div class="card-title">Total Income & Tax Statistics <br><strong>{{date('M Y')}}</strong></div>
                                    <div class="row py-3">
                                        <div class="col-md-4 d-flex flex-column justify-content-around">
                                            <div>
                                                <h6 class="fw-bold text-uppercase text-success op-8">Total Income</h6>
                                                <div style="display:flex">
                                                    <h4 class="fw-bold">Rp. {{number_format($totalincome, 0 , ',' , '.')}},-</h4>
                                                    @if($totalincomelast < $totalincome)
                                                        <i class="fa fa-arrow-up" style="color:#31ce36;font-size:18px;margin-top: 0.22rem !important;margin-left:10px;"></i>
                                                    @elseif($totalincomelast > $totalincome)
                                                        <i class="fa fa-arrow-down" style="color:#f25961;font-size:18px;margin-top: 0.22rem !important;margin-left:10px;"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-uppercase text-success op-8" style="color:#1269db !important;">Total Profit</h6>
                                                <div style="display:flex">
                                                    <h4 class="fw-bold">Rp. {{number_format($totalprofit,0,',','.')}},-</h4>
                                                    @if($totalprofitlast < $totalprofit)
                                                        <i class="fa fa-arrow-up" style="color:#31ce36;font-size:18px;margin-top: 0.22rem !important;margin-left:10px;"></i>
                                                    @elseif($totalprofitlast > $totalprofit)
                                                        <i class="fa fa-arrow-down" style="color:#f25961;font-size:18px;margin-top: 0.22rem !important;margin-left:10px;"></i>
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold text-uppercase text-danger op-8">Total Tax</h6>
                                                <div style="display:flex">
                                                    <h4 class="fw-bold">Rp. {{number_format($totaltax,0,',','.')}},-</h4>
                                                    @if($totaltaxlast < $totaltax)
                                                        <i class="fa fa-arrow-up" style="color:#f25961;font-size:18px;margin-top: 0.22rem !important;margin-left:10px;"></i>
                                                    @elseif($totaltaxlast > $totaltax)
                                                        <i class="fa fa-arrow-down" style="color:#31ce36;font-size:18px;margin-top: 0.22rem !important;margin-left:10px;"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div id="chart-container">
                                                <canvas id="totalIncomeChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title"><strong>Profit of Year</strong> </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="min-height: 375px">
                                        <canvas id="statisticsChartYear"></canvas>
                                    </div>
                                    <div id="myChartLegend"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title"><strong>Month Profit of {{date('Y')}}</strong> </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="min-height: 375px">
                                        <canvas id="statisticsChart"></canvas>
                                    </div>
                                    <div id="myChartLegend"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Top Sales Products</div>
                                </div>
                                <div class="card-body pb-0">
                                {{-- @foreach($topproduct as $tp)
                                    <div class="d-flex">
                                        <div class="flex-1 pt-1 ml-2">
                                            <h6 class="fw-bold mb-1">{{$tp->product->product_name}}</h6>
                                        </div>
                                        <div class="d-flex ml-auto align-items-center">
                                            <h3 class="text-info fw-bold">+{{$tp->total}}</h3>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                @endforeach --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Top Sales Payment Type</div>
                                </div>
                                <div class="card-body pb-0">
                                    {{-- @foreach($topsource as $ts)
                                    <div class="d-flex">
                                        <div class="flex-1 pt-1 ml-2">
                                            <h6 class="fw-bold mb-1">{{$ts->source->source}}</h6>
                                        </div>
                                        <div class="d-flex ml-auto align-items-center">
                                            <h3 class="text-info fw-bold">+{{$ts->total}}</h3>
                                        </div>
                                    </div>
                                    <div class="separator-dashed"></div>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
                <script>
                    var ctx = document.getElementById('statisticsChart').getContext('2d');
                    var ctx_2 = document.getElementById('statisticsChartYear').getContext('2d');

                    <?php 
                        $year=[];
                        $mos=[];
                        $inc=[];
                        $profs=[];
                        $profsyear=[];
                    ?>
                    @foreach($years as $y)
                            <?php 
                            $year[] = $y;
                            ?>
                    @endforeach
                    @foreach($month as $mo)
                        @foreach($mo as $m)
                            <?php 
                            $mos[] = $m;
                            ?>
                        @endforeach
                    @endforeach
                    @foreach($incomepermonth as $in)
                        <?php 
                        $inc[] = $in->income;
                        ?>
                    @endforeach
                    @foreach($profityear as $py)
                        @foreach($py as $p)
                            <?php 
                            $profsyear[] = $p;
                            ?>
                        @endforeach
                    @endforeach
                    @foreach($profitpermonth as $pm)
                        @foreach($pm as $p)
                            <?php 
                            $profs[] = $p;
                            ?>
                        @endforeach
                    @endforeach
                    @if(json_encode($dayofweeks)!='[]')
                        @foreach($dayofweeks as $day)
                            <?php 
                            $days[] = $day->name_day;
                            ?>
                        @endforeach
                        @foreach($calofday as $cal)
                            <?php 
                            $cals[] = $cal->total;
                            ?>
                        @endforeach
                        var days = @json($days);
                        var cal = @json($cals);
                    @else
                        var days =[];
                        var cal =[];
                    @endif
                    var month = @json($mos);
                    var income = @json($inc);
                    var profitmonth = @json($profs);
                    var year = @json($year);
                    var profityear = @json($profsyear);
                </script>
                <script>
                    Circles.create({
                        id: 'circles-1',
                        radius: 45,
                        value: {{$countorderday}},
                        maxValue: {{$countorderlastday}},
                        width: 7,
                        text: "{{$countorderday}}",
                        colors: ['#f1f1f1', '#FF9E27'],
                        duration: 400,
                        wrpClass: 'circles-wrp',
                        textClass: 'circles-text',
                        styleWrapper: true,
                        styleText: true
                    })

                    Circles.create({
                        id: 'circles-2',
                        radius: 45,
                        value: {{$countordermonth}},
                        maxValue: {{$countorderlastmonth}},
                        width: 7,
                        text: "{{$countordermonth}}",
                        colors: ['#f1f1f1', '#2BB930'],
                        duration: 400,
                        wrpClass: 'circles-wrp',
                        textClass: 'circles-text',
                        styleWrapper: true,
                        styleText: true
                    })

                    Circles.create({
                        id: 'circles-3',
                        radius: 45,
                        value: {{$countorderyear}},
                        maxValue: {{$countorderlastyear}},
                        width: 7,
                        text: "{{$countorderyear}}",
                        colors: ['#f1f1f1', '#F25961'],
                        duration: 400,
                        wrpClass: 'circles-wrp',
                        textClass: 'circles-text',
                        styleWrapper: true,
                        styleText: true
                    })

                    Circles.create({
                        id: 'circles-4',
                        radius: 45,
                        value: {{$countorderall}},
                        maxValue: {{$countorderall}},
                        width: 7,
                        text: "{{$countorderall}}",
                        colors: ['#f1f1f1', '#1269db'],
                        duration: 400,
                        wrpClass: 'circles-wrp',
                        textClass: 'circles-text',
                        styleWrapper: true,
                        styleText: true
                    })

                    var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

                    
                    var mytotalIncomeChart = new Chart(totalIncomeChart, {
                        type: 'bar',
                        data: {
                            labels: days,
                            datasets: [{
                                label: "Total Income",
                                backgroundColor: '#ff9e27',
                                borderColor: 'rgb(23, 125, 255)',
                                data: cal,
                            }],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false,
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        display: false //this will remove only the label
                                    },
                                    gridLines: {
                                        drawBorder: false,
                                        display: false
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        drawBorder: false,
                                        display: false
                                    }
                                }]
                            },
                        }
                    });

                    var statisticsChartYear = new Chart(ctx_2, {
                        type: 'line',
                        data: {
                            labels: year,
                            datasets: [ {
                                label: "Profit",
                                borderColor: '#31ce36',
                                pointRadius: 0,
                                backgroundColor: '#31ce3675',
                                legendColor: '#1269db',
                                fill: true,
                                borderWidth: 2,
                                data: profityear
                            }]
                        },
                        options : {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            tooltips: {
                                bodySpacing: 4,
                                mode:"nearest",
                                intersect: 0,
                                position:"nearest",
                                xPadding:10,
                                yPadding:10,
                                caretPadding:10,
                                callbacks: {
                                    label: (item) => `Rp. ${item.yLabel} ,-`,
                                },
                            },
                            layout:{
                                padding:{left:5,right:5,top:15,bottom:15}
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        fontStyle: "500",
                                        beginAtZero: true,
                                        maxTicksLimit: 10,
                                        padding: 10,
                                        precision:0 
                                    },
                                    gridLines: {
                                        drawTicks: false,
                                        display: false
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        zeroLineColor: "transparent"
                                    },
                                    ticks: {
                                        padding: 10,
                                        fontStyle: "500"
                                    }
                                }]
                            },
                            legendCallback: function(chart) {
                                var text = [];
                                text.push('<ul class="' + chart.id + '-legend html-legend">');
                                for (var i = 0; i < chart.data.datasets.length; i++) {
                                    text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>');
                                    if (chart.data.datasets[i].label) {
                                        text.push(chart.data.datasets[i].label);
                                    }
                                    text.push('</li>');
                                }
                                text.push('</ul>');
                                return text.join('');
                            }
                        }
                    });

                    var statisticsChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: month,
                            datasets: [ {
                                label: "Profit",
                                borderColor: '#1269db',
                                pointRadius: 0,
                                backgroundColor: '#006EFF8E',
                                legendColor: '#1269db',
                                fill: true,
                                borderWidth: 2,
                                data: profitmonth
                            }]
                        },
                        options : {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            tooltips: {
                                bodySpacing: 4,
                                mode:"nearest",
                                intersect: 0,
                                position:"nearest",
                                xPadding:10,
                                yPadding:10,
                                caretPadding:10,
                                callbacks: {
                                    label: (item) => `Rp. ${item.yLabel} ,-`,
                                },  
                            },
                            layout:{
                                padding:{left:5,right:5,top:15,bottom:15}
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        fontStyle: "500",
                                        beginAtZero: false,
                                        maxTicksLimit: 10,
                                        padding: 10,
                                        min: 0
                                    },
                                    gridLines: {
                                        drawTicks: false,
                                        display: false
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        zeroLineColor: "transparent"
                                    },
                                    ticks: {
                                        padding: 10,
                                        fontStyle: "500"
                                    }
                                }]
                            },
                            legendCallback: function(chart) {
                                var text = [];
                                text.push('<ul class="' + chart.id + '-legend html-legend">');
                                for (var i = 0; i < chart.data.datasets.length; i++) {
                                    text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor + '"></span>');
                                    if (chart.data.datasets[i].label) {
                                        text.push(chart.data.datasets[i].label);
                                    }
                                    text.push('</li>');
                                }
                                text.push('</ul>');
                                return text.join('');
                            }
                        }
                    });

                    // $('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
                    //     type: 'line',
                    //     height: '70',
                    //     width: '100%',
                    //     lineWidth: '2',
                    //     lineColor: '#ffa534',
                    //     fillColor: 'rgba(255, 165, 52, .14)'
                    // });
                </script>
            </div>
        </div>
    </div>
</body>

</html>
