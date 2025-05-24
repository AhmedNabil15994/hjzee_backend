@extends('admin.layout.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/charts/apexcharts.css')}}">
@endsection
@section('content')
{{--        <div class="row">--}}
{{--            <div class="col-lg-6 col-md-12 col-sm-12">--}}
{{--                <div class="card bg-analytics text-white">--}}
{{--                    <div class="card-content">--}}
{{--                        <div class="card-body text-center">--}}
{{--                            <img src="{{asset('admin/app-assets/images/elements/decore-left.png')}}" class="img-left" alt="card-img-left">--}}
{{--                            <img src="{{asset('admin/app-assets/images/elements/decore-right.png')}}" class="img-right" alt="card-img-right">--}}
{{--                            <div class="text-center">--}}
{{--                                <h1 class="mb-2 text-white">{{__('admin.welcome')}} {{auth('admin')->user()->name}}</h1>--}}
{{--                                <p class="m-auto w-75">{{  date('d-m-Y', strtotime(\Carbon\Carbon::now())) }} </p>--}}
{{--                                <p class="m-auto w-75">{{  date('h:i A', strtotime(\Carbon\Carbon::now())) }} </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6 col-md-12 weatherWidgetInner">--}}
{{--                <a class="weatherwidget-io" href="https://forecast7.com/{{lang()}}/24d7146d68/riyadh/" data-label_1="{{__('admin.riyadh')}}" data-label_2="{{__('admin.weather')}}" data-font="en-us"  data-icons="Climacons" data-theme="original" data-basecolor="rgb(16 22 58)" ></a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row align-center">
            @foreach($menus as $key => $menu)
                @php $color = $colores[array_rand($colores)] @endphp
                <a href="{{$menu['url']}}" class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-{{$color}} p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather {!! $menu['icon'] !!} text-{!! $color !!} font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{$menu['count']}}</h2>
                                <p class="mb-0 line-ellipsis" style="color: #6e6a6a">{{$menu['name']}}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        {{-- <div class="row">

            <h3 class="col-12 d-flex  mb-2">{{__('admin.induction_Statistics')}}</h3>

            @foreach($introSiteCards as $key => $menu)
                @php $color = $colores[array_rand($colores)] @endphp
                <a href="{{$menu['url']}}" class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-{{$color}} p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather {!! $menu['icon'] !!} text-{!! $color !!} font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{$menu['count']}}</h2>
                                <p class="mb-0 line-ellipsis" style="color: #6e6a6a">{{$menu['name']}}</p>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div> --}}
        <div class="row hight-card">
            
            <div class="col-lg-12 col-md-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <h4 class="card-title">{{__('admin.reservations_monthly')}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body pb-0">
                            <div id="revenue-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end">
                        <h4 class="card-title">{{__('admin.reservations_daily')}} </h4>
                            <div class="row">
                                    <div class="col-lg-6">
                                        <div class="controls">
                                            <select name="month" id="month" class=" form-control "  >
                                                <option value>{{__('admin.month')}}</option>
                                                <option value="01" {{ date('m') == '01'?'selected' : '' }} >{{__('admin.month')}} 1</option>
                                                <option value="02" {{ date('m') == '02'?'selected' : '' }} >{{__('admin.month')}} 2</option>
                                                <option value="03" {{ date('m') == '03'?'selected' : '' }} >{{__('admin.month')}} 3</option>
                                                <option value="04" {{ date('m') == '04'?'selected' : '' }} >{{__('admin.month')}} 4</option>
                                                <option value="05" {{ date('m') == '05'?'selected' : '' }} >{{__('admin.month')}} 5</option>
                                                <option value="06" {{ date('m') == '06'?'selected' : '' }} >{{__('admin.month')}} 6</option>
                                                <option value="07" {{ date('m') == '07'?'selected' : '' }} >{{__('admin.month')}} 7</option>
                                                <option value="08" {{ date('m') == '08'?'selected' : '' }} >{{__('admin.month')}} 8</option>
                                                <option value="09" {{ date('m') == '09'?'selected' : '' }} >{{__('admin.month')}} 9</option>
                                                <option value="10" {{ date('m') == '10'?'selected' : '' }} >{{__('admin.month')}} 10</option>
                                                <option value="11" {{ date('m') == '11'?'selected' : '' }} >{{__('admin.month')}} 11</option>
                                                <option value="12" {{ date('m') == '12'?'selected' : '' }} >{{__('admin.month')}} 12</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="controls">
                                                <select name="year" id="year" class="form-control"  >
                                                    <option value>{{__('admin.year')}}</option>
                                                    <option value="{{ date('Y') }}"  selected> {{ date('Y') }}</option>
                                                    <option value="{{ (int)date('Y') - 1 }}"  > {{ (int)date('Y') - 1 }}</option>
                                                    <option value="{{ (int)date('Y') - 2 }}"  > {{ (int)date('Y') - 2 }}</option>
                                                    <option value="{{ (int)date('Y') - 3 }}"  > {{ (int)date('Y') - 3 }}</option>
                                                    <option value="{{ (int)date('Y') - 4 }}"  > {{ (int)date('Y') - 4 }}</option>
                                                    <option value="{{ (int)date('Y') - 5 }}"  > {{ (int)date('Y') - 5 }}</option>
                                                </select>
                                        </div>
                                    </div>
                                </div>
                    </div>

                    <div class="card-content">
                        <div class="card-body pb-0" id="days-chart-body">
                            <div id="days-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

                  
        </div>
@endsection
@section('js')
    <script>
        !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
    </script>

    <script src="{{asset('admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{asset('admin/charts_functions.js')}}"></script>
    <script>
        //revenue-chart
        var revenueChartoptions = {
            chart: {
            height: 270,
            toolbar: { show: false },
            type: 'line',
            },
            stroke: {
            curve: 'smooth',
            dashArray: [0, 8],
            width: [4, 2],
            },
            grid: {
            borderColor: '#e7e7e7',
            },
            legend: {
            show: false,
            },
            colors: ['#f29292', '#b9c3cd'],

            fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                inverseColors: false,
                gradientToColors: ['#7367F0', '#b9c3cd'],
                shadeIntensity: 1,
                type: 'horizontal',
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            },
            },
            markers: {
            size: 0,
            hover: {
                size: 5
            }
            },
            xaxis: {
            labels: {
                style: {
                colors: '#b9c3cd',
                }
            },
            axisTicks: {
                show: false,
            },
            categories: ['1', '2', '3', '4', '5', '6', '7', '8' ,'9','10','11','12'],
            axisBorder: {
                show: false,
            },
            tickPlacement: 'on',
            },
            yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                color: '#b9c3cd',
                },
                formatter: function (val) {
                return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
                }
            }
            },
            tooltip: {
            x: { show: false }
            },
            series: [
            {
            name: "{{__('admin.reservations')}}",
            data: @json($reservationsArray)
            }
            ],

        }

        var revenueChart = new ApexCharts(
            document.querySelector("#revenue-chart"),
            revenueChartoptions
        ).render();
        
        //days-chart
        var revenueChartoptions = {
            chart: {
            height: 270,
            toolbar: { show: false },
            type: 'line',
            },
            stroke: {
            curve: 'smooth',
            dashArray: [0, 8],
            width: [4, 2],
            },
            grid: {
            borderColor: '#e7e7e7',
            },
            legend: {
            show: false,
            },
            colors: ['#f29292', '#b9c3cd'],

            fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                inverseColors: false,
                gradientToColors: ['#7367F0', '#b9c3cd'],
                shadeIntensity: 1,
                type: 'horizontal',
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            },
            },
            markers: {
            size: 0,
            hover: {
                size: 5
            }
            },
            xaxis: {
            labels: {
                style: {
                colors: '#b9c3cd',
                }
            },
            axisTicks: {
                show: false,
            },
            categories: ['1', '2', '3', '4', '5', '6', '7', '8' ,'9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'],
            axisBorder: {
                show: false,
            },
            tickPlacement: 'on',
            },
            yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                color: '#b9c3cd',
                },
                formatter: function (val) {
                return val > 999 ? (val / 1000).toFixed(1) + 'k' : val;
                }
            }
            },
            tooltip: {
            x: { show: false }
            },
            series: [
            {
            name: "{{__('admin.reservations')}}",
            data: @json($daysReservationsArray)
            }
            ],

        }

        var revenueChart = new ApexCharts(
            document.querySelector("#days-chart"),
            revenueChartoptions
        ).render();

    </script>
    <script>
        $('#month,#year').on('change', function(e) { //any select change on the dropdown with id country trigger this code
            e.preventDefault();
        var month = $('#month').val();
        var year = $('#year').val();
        $.post("<?=route('admin.getMonthsReservationChart')?>", {
            month: month,
            year: year,
        }, function(data) {
            $('#days-chart-body').html("");
            $('#days-chart-body').append(data);
        });
    });
    </script>
@endsection