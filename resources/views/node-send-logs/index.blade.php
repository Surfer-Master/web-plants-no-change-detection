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
        <h3 class="text-2xl font-bold text-slate-700">Log Pengiriman</h3>
    </div>

    <div class="w-full bg-white rounded-lg shadow">
        <div class="border-b">
            <h5 class="text-lg font-bold text-gray-900 py-2 px-4 md:py-3 md:px-6">Data Log Pengiriman</h5>
        </div>
        <div class="relative overflow-x-auto p-2">
            <table class="datatable w-full">
                <thead>
                    <tr>
                        <th scope="col" class="text-center uppercase">
                            No
                        </th>
                        <th scope="col" class="text-center uppercase">
                            Nama Node
                        </th>
                        <th scope="col" class="text-center uppercase">
                            Data Sensor
                        </th>
                        <th scope="col" class="text-center">
                            BANDWIDTH (Kbps)
                        </th>
                        <th scope="col" class="text-center uppercase">
                            Delay
                        </th>
                        <th scope="col" class="text-center uppercase">
                            Jitter
                        </th>
                        <th scope="col" class="text-center uppercase">
                            created_at
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nodeSendLogs as $nodeSendLog)
                        <tr>
                            <th scope="row" class=" text-center">
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $nodeSendLog->node->name ?? '-' }}
                            </td>
                            <td>
                                @if ($nodeSendLog->node->sensor == 'dht')
                                    <ul class="space-y-1">
                                        <li>
                                            Suhu: {{ $nodeSendLog->airTemperature->temperature ?? '-' }}
                                        </li>
                                        <li>
                                            Kelembapan : {{ $nodeSendLog->humidity->humidity ?? '-' }}
                                        </li>
                                    </ul>
                                @else
                                    <ul class="space-y-1">
                                        @foreach ($nodeSendLog->soilMoistures as $soilMoisture)
                                            <li>
                                                {{ $soilMoisture->plant->name ?? '-' }}
                                                {{ $soilMoisture->plant->location ? '(' . $soilMoisture->plant->location . ')' : '' }}:
                                                {{ $soilMoisture->moisture ?? '-' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td>
                                {{ $nodeSendLog->bandwidth->bandwidth ?? '-' }}
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
    </div>
@endsection

@push('body-js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.tailwindcss.min.js') }}"></script>
@endpush

@push('body-script')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "pageLength": 100,
            });
        });
    </script>
@endpush
