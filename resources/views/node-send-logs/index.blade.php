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
    <div class="grid pb-6 grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="block p-5 bg-white border-l-[0.25rem] border-primary-600 rounded-lg shadow">
            <div class="mb-2">
                <div class="text-xs font-bold text-primary-600 uppercase mb-1">Jumlah Log Pengiriman</div>
                <ul>
                    @foreach ($nodes as $node)
                        <li class="text-base font-bold text-gray-800">
                            {{ $node->name }} : {{ number_format($node->node_send_logs_count) }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <h5 class="text-lg font-bold text-primary-600">
                Total : {{ number_format($nodes->sum('node_send_logs_count')) }}
            </h5>
        </div>
        <div class="block p-5 bg-white border-l-[0.25rem] border-green-600 rounded-lg shadow">
            <div class="mb-2">
                <div class="text-xs font-bold text-green-600 uppercase mb-1">Packet Loss</div>
                <ul>
                    @foreach ($nodes as $node)
                        <li class="text-base font-bold text-gray-800">
                            {{ $node->name }} :
                            {{ $node->packet_loss !== null ? number_format($node->packet_loss, 2) . '%' : '-' }}
                            {{ $node->packet_loss_count ? '(' . number_format($node->packet_loss_count) . ')' : '' }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <h5 class="text-lg font-bold text-green-600">
                Total : {{ number_format($nodes->sum('packet_loss'), 2) . '%' }}
                ({{ number_format($nodes->sum('packet_loss_count')) }})
            </h5>
        </div>
        <div class="block p-5 bg-white border-l-[0.25rem] border-sky-600 rounded-lg shadow">
            <div class="mb-2">
                <div class="text-xs font-bold text-sky-600 uppercase mb-1">Delay Rata-Rata</div>
                <ul>
                    @foreach ($nodes as $node)
                        <li class="text-base font-bold text-gray-800">
                            {{ $node->name }} :
                            {{ $node->node_send_logs_avg_delay !== null ? number_format($node->node_send_logs_avg_delay, 2) . ' ms' : '-' }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <h5 class="text-lg font-bold text-sky-600">
                Total Rata-Rata: {{ number_format($nodes->avg('node_send_logs_avg_delay'), 2) . ' ms' }}
            </h5>
        </div>
        <div class="block p-5 bg-white border-l-[0.25rem] border-red-600 rounded-lg shadow">
            <div class="mb-2">
                <div class="text-xs font-bold text-red-600 uppercase mb-1">Jitter</div>
                <ul>
                    @foreach ($nodes as $node)
                        <li class="text-base font-bold text-gray-800">
                            {{ $node->name }} :
                            {{ $node->node_send_logs_avg_jitter !== null ? number_format($node->node_send_logs_avg_jitter, 2) . ' ms' : '-' }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <h5 class="text-lg font-bold text-red-600">
                Total Rata-Rata: {{ number_format($nodes->avg('node_send_logs_avg_jitter'), 2) . ' ms' }}
            </h5>
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
                            NAMA NODE
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
                                {{-- {{ $loop->iteration }} --}}
                            </th>
                            <td>
                                {{ $nodeSendLog->node->name ?? '-' }}
                            </td>
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
                info: false,
                paging: false
            });
        });
    </script>
@endpush
