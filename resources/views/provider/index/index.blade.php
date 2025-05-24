@extends('provider.layout.master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/vendors/css/charts/apexcharts.css')}}">
@endsection
@section('content')

        <div class="page-contant mt-4">
            <div class="container">
                <div class="statics">
                    {{-- @if(auth('provider')->user()->type == 'place')
                        <div class="d-flex flex-column align-items-center">
                            <img src="{{asset('provider/images/note.png')}}" alt="">
                            <h6 class="mt-2 mb-2">{{__('provider.new_orders_count')}}</h6>
                            <span><a href="{{ route('provider.new') }}">{{$new_orders_count}}</a></span>
                        </div>

                        <div class="d-flex flex-column align-items-center">
                            <img src="{{asset('provider/images/note.png')}}" alt="">
                            <h6 class="mt-2 mb-2">{{__('provider.finished_orders_count')}}</h6>
                            <span><a href="{{ route('provider.finished') }}">{{$finished_orders_count}}</a></span>
                        </div>
                    @else --}}
                        <div class="d-flex flex-column align-items-center col-md-6">
                            <img src="{{asset('provider/images/note.png')}}" alt="">
                            <h6 class="mt-2 mb-2">{{__('provider.orders_count')}}</h6>
                            <span><a href="{{ route('provider.reservations') }}">{{$orders_count}}</a></span>
                        </div>
                    {{-- @endif --}}


                </div>
                <div class="Charts">
                    <h6>{{__('provider.Reservations by month')}}</h6>
                        <div id="chart1"></div>
                </div>
            </div>
        </div>

@section('js')
            <script src="{{asset('admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
        
        <script>
            //chart1
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
                    categories: @json($months),
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
                    series: [{
                    name: "{{__('admin.reservations')}}",
                    data: @json($lastYearCountByMonth)
                    }
                    ],
        
                }
        
                var revenueChart = new ApexCharts(
                    document.querySelector("#chart1"),
                    revenueChartoptions
                ).render();

        </script>
        
        @endsection
@endsection
