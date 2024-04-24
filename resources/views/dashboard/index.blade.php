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
    <div class="grid pb-6 grid-cols-2 gap-4 lg:grid-cols-4">
        <div class="block p-5 bg-white border-l-[0.25rem] border-primary-600 rounded-lg shadow h-24">
            <div class="flex justify-between">
                <div>
                    <div class="text-xs font-bold text-primary-600 uppercase mb-1">Node</div>
                    <div class="text-3xl mb-0 font-bold text-gray-800">{{ $nodesCount }}</div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-circle-nodes fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="block p-5 bg-white border-l-[0.25rem] border-green-600 rounded-lg shadow h-24">
            <div class="flex justify-between">
                <div>
                    <div class="text-xs font-bold text-green-600 uppercase mb-1">Tanaman</div>
                    <div class="text-3xl mb-0 font-bold text-gray-800">{{ $plants->count() }}</div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-seedling fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="block p-5 bg-white border-l-[0.25rem] border-sky-600 rounded-lg shadow h-24">
            <div class="flex justify-between">
                <div>
                    <div class="text-xs font-bold text-sky-600 uppercase mb-1">Log Pengiriman</div>
                    <div class="text-3xl mb-0 font-bold text-gray-800">{{ $nodeSendLogsCount }}</div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-arrow-trend-up fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="block p-5 bg-white border-l-[0.25rem] border-red-600 rounded-lg shadow h-24">
            <div class="flex justify-between">
                <div>
                    <div class="text-xs font-bold text-red-600 uppercase mb-1">Users</div>
                    <div class="text-3xl mb-0 font-bold text-gray-800">{{ $usersCount }}</div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-users fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap h-min justify-center">
        <div class="flex flex-wrap h-min gap-4 w-full px-2 mb-4 lg:w-1/4">
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 mx-auto py-2 px-4 md:py-3 md:px-6">
                <h5 class="text-lg font-bold text-gray-900 dark:text-white">Suhu Udara</h5>
                <div id="temperature-radial-chart"></div>
            </div>
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 mx-auto py-2 px-4 md:py-3 md:px-6">
                <h5 class="text-lg font-bold text-gray-900 dark:text-white">Kelembapan Udara</h5>
                <div id="humidity-radial-chart"></div>
            </div>
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 mx-auto py-2 px-4 md:py-3 md:px-6">
                <h5 class="text-lg font-bold text-gray-900 dark:text-white">Penyimpanan</h5>
                <div id="storage-radial-chart"></div>
                <div class="font-semibold -mt-6 text-center">
                    @if (($storageSize->total_size_MB ?? 0) > 1024)
                        {{ number_format(($storageSize->total_size_MB ?? 0) / 1024, 2) }} GB / 5,00 GB
                    @else
                        {{ $storageSize->total_size_MB ?? '-' }} MB / 5,00 GB
                    @endif
                </div>
            </div>
        </div>
        <div class="w-full px-2 lg:w-3/4">
            <div class="w-full bg-white rounded-lg shadow">
                <div class="border-b">
                    <h5 class="text-lg font-bold text-gray-900 py-2 px-4 md:py-3 md:px-6">Kelembapan Tanah</h5>
                </div>
                <div class="relative overflow-x-auto p-2">
                    <table class="datatable w-full">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center uppercase">
                                    No
                                </th>
                                <th scope="col" class="text-center uppercase">
                                    Nama Tanaman
                                </th>
                                <th scope="col" class="text-center uppercase">
                                    Lokasi
                                </th>
                                <th scope="col" class="text-center uppercase">
                                    Kelembapan Tanah (%)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plants as $plant)
                                <tr class="text-center">
                                    <th scope="row">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td>
                                        {{ $plant->name ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $plant->location ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $plant->latestSoilMoisture ? $plant->latestSoilMoisture->moisture . ' %' : '-' }}
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
                height: 275,
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
                height: 275,
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

        var storageRadialChartOptions = {
            series: [{{ (($storageSize->total_size_MB ?? 0) / 5120) * 100 }}],
            colors: ['#eab308'],
            chart: {
                height: 275,
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
            labels: ['Penyimpanan'],
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

        var humidityChart = new ApexCharts(document.querySelector("#storage-radial-chart"), storageRadialChartOptions);
        humidityChart.render();

        // humidityChart.updateSeries([10]);
    </script>
@endpush
