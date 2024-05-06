@extends('layouts.main')

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <div class="flex justify-between flex-wrap mb-4">
        <h3 class="text-2xl font-bold text-slate-700"><span class="text-slate-500">Node / </span>{{ $node->name }}</h3>
        <div class=" flex gap-3 items-center">
            <a href="{{ route('nodes.index') }}"
                class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                title="Kembali">
                <i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
            <a href="{{ route('nodes.edit', ['node' => $node->id]) }}" data-modal-target="node-modal"
                data-modal-toggle="node-modal"
                class="block text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2 text-center dark:bg-yellow-300 dark:hover:bg-yellow-400 dark:focus:ring-yellow-500 btn-edit"
                title="Edit">
                <i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
            <a href="{{ route('nodes.destroy', ['node' => $node->id]) }}"
                class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 btn-delete"
                title="Hapus">
                <i class="fa-solid fa-trash-can me-2"></i>Hapus</a>
        </div>
    </div>

    <div class="grid mb-6 grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="block p-5 bg-white border-l-[0.25rem] border-primary-600 rounded-lg shadow h-24">
            <div class="flex justify-between">
                <div>
                    <div class="text-xs font-bold text-primary-600 uppercase mb-1">Log Penyimpanan</div>
                    <div class="text-2xl mb-0 font-bold text-gray-800">
                        {{ number_format($node->node_send_logs_count) }}</div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-bookmark fa-2xl fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="block p-5 bg-white border-l-[0.25rem] border-red-600 rounded-lg shadow h-24">
            <div class="flex justify-between">
                <div>
                    <div class="text-xs font-bold text-red-600 uppercase mb-1">Packet Loss</div>
                    <div class="text-2xl mb-0 font-bold text-gray-800">
                        {{ $node->packet_loss !== null ? number_format($node->packet_loss, 2) . '%' : '-' }}
                        {{ $node->packet_loss_count ? '(' . number_format($node->packet_loss_count) . ')' : '' }}</div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-arrow-trend-down fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="block p-5 bg-white border-l-[0.25rem] border-sky-600 rounded-lg shadow h-24">
            <div class="flex justify-between">
                <div>
                    <div class="text-xs font-bold text-sky-600 uppercase mb-1">Delay Rata-Rata</div>
                    <div class="text-2xl mb-0 font-bold text-gray-800">
                        {{ $node->node_send_logs_avg_delay !== null ? number_format($node->node_send_logs_avg_delay, 2) . ' ms' : '-' }}
                    </div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-hourglass-start fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
        <div class="block p-5 bg-white border-l-[0.25rem] border-green-600 rounded-lg shadow h-24">
            <div class="flex justify-between">
                <div>
                    <div class="text-xs font-bold text-green-600 uppercase mb-1">Jitter Rata-Rata</div>
                    <div class="text-2xl mb-0 font-bold text-gray-800">
                        {{ $node->node_send_logs_avg_jitter !== null ? number_format($node->node_send_logs_avg_jitter, 2) . ' ms' : '-' }}
                    </div>
                </div>
                <div class="my-auto">
                    <i class="fa-solid fa-wave-square fa-2xl text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-8 w-full bg-white rounded-lg shadow">
        <div class="w-full p-5">
            <div id="packet_chart"></div>
        </div>
    </div>
    <div class="mb-8 w-full bg-white rounded-lg shadow">
        <div class="w-full p-5">
            <div id="delay_jitter_chart"></div>
        </div>
    </div>

    <div class="w-full bg-white rounded-lg shadow">
        <div class="border-b">
            <h5 class="text-lg font-bold text-gray-900 py-2 px-4 md:py-3 md:px-6">Data Log Pengiriman</h5>
        </div>
        <div class="relative overflow-x-auto p-2">
            <table class="datatable w-full">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            NO
                        </th>
                        <th scope="col" class="text-center">
                            DATA SENSOR
                        </th>
                        <th scope="col" class="text-center">
                            DELAY (ms)
                        </th>
                        <th scope="col" class="text-center">
                            JITTER (ms)
                        </th>
                        <th scope="col" class="text-center">
                            WAKTU
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nodeSendLogs as $nodeSendLog)
                        <tr class="text-center">
                            <th scope="row">
                                {{ ($nodeSendLogs->currentPage() - 1) * $nodeSendLogs->perPage() + $loop->iteration }}
                            </th>
                            <td>
                                @if ($nodeSendLog->node->connected_sensor == 'dht')
                                    <ul>
                                        <li>
                                            <span class="font-medium">Suhu:</span>
                                            {{ $nodeSendLog->airTemperature ? $nodeSendLog->airTemperature->temperature . '℃' : '-' }}
                                        </li>
                                        <li>
                                            <span class="font-medium">Kelembapan:</span>
                                            {{ $nodeSendLog->humidity ? $nodeSendLog->humidity->humidity . '%' : '-' }}
                                        </li>
                                    </ul>
                                @else
                                    <ul>
                                        @foreach ($nodeSendLog->soilMoistures as $soilMoisture)
                                            <li>
                                                <span class="font-medium">
                                                    {{ $soilMoisture->plant->name ?? '-' }}
                                                    {{ $soilMoisture->plant->location ? '(' . $soilMoisture->plant->location . ')' : '' }}:
                                                </span>
                                                {{ $soilMoisture->moisture . '%' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td>
                                {{ $nodeSendLog->delay ?? '-' }}
                            </td>
                            <td>
                                {{ $nodeSendLog->jitter ?? '-' }}
                            </td>
                            <td>
                                {{ $nodeSendLog->created_at ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mx-2 pb-3">
            {{ $nodeSendLogs->links() }}
        </div>
    </div>

    {{-- Modal Edit Node --}}
    <div id="node-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            {{-- <!-- Modal content --> --}}
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                {{-- <!-- Modal header --> --}}
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="node-modal-header">
                        Edit Node
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="node-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('nodes.update', ['node' => $node->id]) }}" method="post" class="p-4 md:p-5"
                    autocomplete="off">
                    @method('put')
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="nama"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white after:content-['*'] after:text-red-500 after:ml-0.5">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                value="{{ $node->name ?? '' }}" placeholder="Nama Node" required>
                        </div>
                        <div class="col-span-2">
                            <label for="sensor"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white after:content-['*'] after:text-red-500 after:ml-0.5">Jenis
                                Sensor</label>
                            <select name="sensor" id="sensor" class="select2" data-placeholder="Pilih Jenis Sensor"
                                required>
                                <option value=""></option>
                                <option value="dht" @selected($node->connected_sensor == 'dht')>DHT</option>
                                <option value="soil-moisture" @selected($node->connected_sensor == 'soil-moisture')>Soil Moisture</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <i class="fa-solid fa-check-double me-1"></i>Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('body-js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.tailwindcss.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endpush

@push('body-script')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                info: false,
                paging: false
            });

            var packetChartOptions = {
                series: [{
                    name: 'Jumlah Pengiriman',
                    data: {!! $dataSendChartData !!}
                }, {
                    name: 'Jumlah Packet Loss',
                    data: {!! $packetLossChartData !!}
                }],
                chart: {
                    type: 'area',
                    stacked: false,
                    height: 350,
                    zoom: {
                        type: 'x',
                        enabled: true,
                        autoScaleYaxis: true
                    },
                    toolbar: {
                        autoSelected: 'pan'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                markers: {
                    size: 0,
                },
                title: {
                    text: 'Jumlah Pengiriman & Packet Loss',
                    align: 'left',
                    style: {
                        fontSize: '18'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        inverseColors: false,
                        opacityFrom: 0.5,
                        opacityTo: 0,
                        stops: [0, 50, 100]
                    },
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return val.toLocaleString('id-ID');
                        },
                    },
                    title: {
                        text: 'Jumlah'
                    },
                },
                xaxis: {
                    type: 'datetime',
                },
                tooltip: {
                    shared: true,
                    x: {
                        formatter: function(val) {
                            return new Date(val).toLocaleString('id-ID', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                second: 'numeric'
                            });
                        }
                    },
                    y: {
                        formatter: function(val) {
                            return val.toLocaleString('id-ID')
                        }
                    }
                },
                stroke: {
                    width: 1
                },
                colors: ['#1d4ed8', '#dc2626']
            };

            var packetChart = new ApexCharts(document.querySelector("#packet_chart"),
                packetChartOptions);
            packetChart.render();

            var delayJitterChartOptions = {
                series: [{
                    name: 'Delay',
                    data: {!! $delayChartData !!}
                }, {
                    name: 'Jitter',
                    data: {!! $jitterChartData !!}
                }],
                chart: {
                    type: 'area',
                    stacked: false,
                    height: 350,
                    zoom: {
                        type: 'x',
                        enabled: true,
                        autoScaleYaxis: true
                    },
                    toolbar: {
                        autoSelected: 'pan'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                markers: {
                    size: 0,
                },
                title: {
                    text: 'Delay & Jitter',
                    align: 'left',
                    style: {
                        fontSize: '18'
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        inverseColors: false,
                        opacityFrom: 0.5,
                        opacityTo: 0,
                        stops: [0, 50, 100]
                    },
                },
                yaxis: {
                    labels: {
                        formatter: function(val) {
                            return val.toLocaleString('id-ID');
                        },
                    },
                    title: {
                        text: 'Waktu (ms)'
                    },
                },
                xaxis: {
                    type: 'datetime',
                },
                tooltip: {
                    shared: true,
                    x: {
                        formatter: function(val) {
                            return new Date(val).toLocaleString('id-ID', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                second: 'numeric'
                            });
                        }
                    },
                    y: {
                        formatter: function(val) {
                            return val.toLocaleString('id-ID') + ' ms'
                        }
                    }
                },
                stroke: {
                    width: 1
                },
                colors: ['#2563eb', '#0d9488']
            };

            var delayJitterChart = new ApexCharts(document.querySelector("#delay_jitter_chart"),
                delayJitterChartOptions);
            delayJitterChart.render();
        });

        $('#node-modal .select2').select2({
            dropdownParent: $('#node-modal'),
            width: '100%',
            allowClear: true,
        });

        $('.btn-edit').on('click', function(e) {
            e.preventDefault();
        });

        $('#node-modal form').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData($('#node-modal form')[0]);
            // formData.forEach((value, key) => {
            //     console.log(key, value);
            // });

            Swal.fire({
                title: "Sedang mengirim...",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: $("#node-modal form").attr("action"),
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: response.status,
                                title: "Berhasil",
                                text: response.message,
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 500);
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: status,
                                title: "Opps..",
                                text: xhr.responseJSON.message,
                            });
                            console.error("Error:", error);
                        },
                    });
                },
            });
        });

        $(".btn-delete").on("click", function(e) {
            e.preventDefault();
            let link = $(this).attr("href");
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Iya, hapus sekarang!",
                customClass: {
                    cancelButton: "block text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-base px-5 py-2 text-center dark:bg-gray-600 dark:hover:bg-gray-600 dark:focus:ring-gray-800 me-3",
                    confirmButton: "block text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-base px-5 py-2 text-center dark:bg-primary-600 dark:hover:bg-primary-600 dark:focus:ring-primary-800",
                },
                buttonsStyling: false,
                reverseButtons: true,
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: link,
                        method: "DELETE",
                        contentType: "application/json",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: response.status,
                                title: response.title,
                                text: response.message,
                            });
                            setTimeout(function() {
                                window.location.reload();
                            }, 500);
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: status,
                                title: "Opps..",
                                text: xhr.responseJSON.message,
                            });
                            console.error("Error:", error);
                        },
                    });
                }
            });
        });
    </script>
@endpush
