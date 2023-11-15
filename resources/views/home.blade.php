@extends('layouts.backend')

@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

    <div class="row">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Avg Start Time - End time</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="clock"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $data['avg_start_end_time'] }}</h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Avg Start - Assign PIC Time</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $data['avg_start_pic_time'] }}</h1>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Avg Assign PIC - End Time</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="check"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">{{ $data['avg_pic_end_time'] }}</h1>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Current Month Open Ticket</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="file-text"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    @if($data['current_open_ticket'] > 0)
                                        <span class="text-danger">
                                    @endif
                                    {{ $data['current_open_ticket'] }}
                                    @if($data['current_open_ticket'] > 0)
                                        </span>
                                    @endif
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-xxl-3 d-flex order-2 order-xxl-3">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">PIC Count</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-pie"></canvas>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 col-xxl-3 d-flex order-2 order-xxl-3">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Fastest and Slowest Resolution Time</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                            <div class="chart chart-xs">
                                <canvas id="chartjs-dashboard-bar"></canvas>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>      
    <div class="row">
        <div class="col-xl-4 col-xxl-4">
            <div class="card flex-fill w-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Rating</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div class="chart chart-xs">
                            <canvas id="chartjs-rating-pie"></canvas>
                        </div>
                    </div>
                    {{-- <div class="app">
                        <div class="rating">
                            <div class="rating__average">
                                <h1>4.5</h1>
                                <div class="star-outer">
                                    <div class="star-inner"></div>
                                </div>
                                <p>290.000</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>   
        <div class="col-xl-8 col-xxl-8">
            <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Total Ticket Per Category</h5>
                </div>
                <div class="card-body py-3">
                    <div class="chart chart-sm">
                        <canvas id="chartjs-dashboard-line"></canvas>
                    </div>
                </div>
            </div>
        </div>        
    </div>

</div>
@endsection
@push('scripts')
<script>
    function getRandomColor(count, opacity) {
        var arr = [];
        var colors = [];
        for (var i = 0; i < count; i++) {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var x = 0; x < 6; x++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            colors.push(color+opacity);
        }
        return colors;
    }

    document.addEventListener("DOMContentLoaded", function() {
        var data = {!! json_encode($data['pic_count']) !!};
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "polarArea",
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.value,
                    backgroundColor: getRandomColor(data.value.length,40),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: true
                },
                cutoutPercentage: 50,
                
            }
        });
    });
    
    document.addEventListener("DOMContentLoaded", function() {
        var data = {!! json_encode($data['rating_count']) !!};
        new Chart(document.getElementById("chartjs-rating-pie"), {
            type: "pie",
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.value,
                    backgroundColor: getRandomColor(data.value.length,90),
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: true
                },
                cutoutPercentage: 0
            }
        });
    });
		document.addEventListener("DOMContentLoaded", function() {
            var data = {!! json_encode($data['ticket_per_category']) !!}
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets : data,
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: true
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: false
					},
					plugins: {
						filler: {
							propagate: true
						}
					},
                    scales: {
						yAxes: [{
							gridLines: {
								display: true
							},
							stacked: false,
							ticks: {
								stepSize: 1
							}
						}],
					}
				}
			});
		});


        document.addEventListener("DOMContentLoaded", function() {
            // var data = {!! json_encode($data['min_max_resolution_time'])!!}
            var data_slow = {!! json_encode($data['max_resolution_time'])!!}
            var data_fast = {!! json_encode($data['min_resolution_time'])!!}
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "radar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Slowest",
						// backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						// hoverBackgroundColor: window.theme.primary,
						// hoverBorderColor: window.theme.primary,
						data: data_slow,
					},
                    {
						label: "Fastest",
						// backgroundColor: window.theme.primary,
						borderColor: getRandomColor(1),
						// hoverBackgroundColor: window.theme.primary,
						// hoverBorderColor: window.theme.primary,
						data: data_fast,
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					// scales: {
					// 	yAxes: [{
					// 		gridLines: {
					// 			display: true
					// 		},
					// 		stacked: false,
					// 		ticks: {
					// 			stepSize: 1
					// 		}
					// 	}],
					// }
				}
			});
		});
        window.setTimeout( function() {
        window.location.reload();
        }, 60000);

	</script>
@endpush