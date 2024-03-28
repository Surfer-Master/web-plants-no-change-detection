@extends('layouts.main')

@push('meta')
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.tailwindcss.min.css') }}">
@endpush

@push('style')
@endpush

@push('head-js')
@endpush

@push('head-script')
@endpush

@section('content')
    <div class="flex flex-wrap gap-4 justify-center py-6">
        <div class="block w-80 p-5 bg-white border-l-[0.25rem] border-primary-600 rounded-lg shadow h-24">
            <div class="flex justify-between ">
                <div>
                    <div class="text-xs font-bold text-primary-600 uppercase mb-1">Node</div>
                    <div class="text-3xl mb-0 font-bold text-gray-800">1</div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-temperature-half fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="block w-80 p-5 bg-white border-l-[0.25rem] border-primary-600 rounded-lg shadow h-24">
            <div class="flex justify-between ">
                <div>
                    <div class="text-xs font-bold text-primary-600 uppercase mb-1">Tanaman</div>
                    <div class="text-3xl mb-0 font-bold text-gray-800">1</div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-temperature-half fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="block w-80 p-5 bg-white border-l-[0.25rem] border-primary-600 rounded-lg shadow h-24">
            <div class="flex justify-between ">
                <div>
                    <div class="text-xs font-bold text-primary-600 uppercase mb-1">Log Pengiriman</div>
                    <div class="text-3xl mb-0 font-bold text-gray-800">1</div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-temperature-half fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap h-min justify-center">
        <div class="flex flex-wrap h-min gap-4 w-full px-2 mb-4 lg:w-1/4">
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 mx-auto py-2 px-4 md:py-3 md:px-6">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">Suhu Udara</h5>
                <div id="temperature-radial-chart"></div>
            </div>
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 mx-auto py-2 px-4 md:py-3 md:px-6">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">Kelembapan Udara</h5>
                <div id="humidity-radial-chart"></div>
            </div>
        </div>
        <div class="w-full px-2 lg:w-3/4">
            <div class="w-full bg-white rounded-lg shadow">
                <div class="border-b">
                    <h5 class="text-xl font-bold text-gray-900 py-2 px-4 md:py-3 md:px-6">Kelembapan Tanah</h5>
                </div>
                <div class="relative overflow-x-auto m-3">
                    <table class="datatable w-full text-sm text-left text-gray-50">
                        <thead class="text-xs text-gray-700 uppercase font-bold bg-gray-50 dark:bg-gray-70">
                            <tr>
                                <th scope="col text-center" class="text-center p-3">
                                    No
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Nama Tanaman
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Lokasi
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Kelembapan Tanah
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plants as $plant)
                                <tr
                                    class="w-4 p-4 text-center odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-6 py-4 text-gray-900">
                                        {{ $plant->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">
                                        {{ $plant->location ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">
                                        {{ $plant->latestSoilMoisture ? $plant->latestSoilMoisture->moisture . ' %' : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-900">
                                        <a href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('body-js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.tailwindcss.min.js') }}"></script>
@endpush

@push('body-script')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "pageLength": 25,
            });
        });

        var temperatureRadialChartOptions = {
            series: [{{ $airTemperature->temperature ?? 0 }}],
            colors: ['#1C64F2'],
            chart: {
                height: 300,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    size: undefined,
                    hollow: {
                        margin: 5,
                        size: '60%',
                        background: 'transparent',
                    },
                    dataLabels: {
                        show: true,
                        name: {
                            offsetY: -10,
                            show: true,
                            // color: '#888',
                            // fontSize: '17px'
                        },
                        value: {
                            formatter: function(val) {
                                return parseInt(val) + '℃';
                            },
                            // color: '#111',
                            fontSize: '36px',
                            show: true,
                        }
                    },
                },
            },
            labels: ['Suhu Udara'],
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
                y: {
                    formatter: function(value) {
                        return value + '℃';
                    }
                }
            },
        };

        var temperatureChart = new ApexCharts(document.querySelector("#temperature-radial-chart"),
            temperatureRadialChartOptions);
        temperatureChart.render();

        var humidityRadialChartOptions = {
            series: [{{ $humidity->humidity ?? 0 }}],
            colors: ['#16BDCA'],
            chart: {
                height: 300,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    size: undefined,
                    hollow: {
                        margin: 5,
                        size: '60%',
                        background: 'transparent',
                    },
                    dataLabels: {
                        show: true,
                        name: {
                            offsetY: -10,
                            show: true,
                            // color: '#888',
                            // fontSize: '17px'
                        },
                        value: {
                            formatter: function(val) {
                                return parseInt(val) + '%';
                            },
                            // color: '#111',
                            fontSize: '36px',
                            show: true,
                        }
                    },
                },
            },
            labels: ['Kelembapan Udara'],
            tooltip: {
                enabled: true,
                x: {
                    show: false,
                },
                y: {
                    formatter: function(value) {
                        return value + '%';
                    }
                }
            },
        };

        var humidityChart = new ApexCharts(document.querySelector("#humidity-radial-chart"), humidityRadialChartOptions);
        humidityChart.render();

        // humidityChart.updateSeries([10]);
    </script>
@endpush
