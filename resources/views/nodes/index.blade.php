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
        <h3 class="text-2xl font-bold text-slate-700">Node</h3>
        <button data-modal-target="node-modal" data-modal-toggle="node-modal"
            class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
            type="button">
            <i class="fa-solid fa-plus h-3 me-2 -ms-1"></i>
            Tamabah Node
        </button>
    </div>
    <div class="w-full bg-white rounded-lg shadow">
        <div class="border-b">
            <h5 class="text-lg font-bold text-gray-900 py-2 px-4 md:py-3 md:px-6">Data Node</h5>
        </div>
        <div class="relative overflow-x-auto p-2">
            <table class="datatable w-full">
                <thead>
                    <tr>
                        <th scope="col" class="w-16 text-center uppercase">
                            No
                        </th>
                        <th scope="col" class="text-center uppercase">
                            Nama Node
                        </th>
                        <th scope="col" class="text-center uppercase">
                            Sensor
                        </th>
                        <th scope="col" class="text-center uppercase">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nodes as $node)
                        <tr class="text-center">
                            <th scope="row" class="text-center">
                                {{ $loop->iteration }}
                            </th>
                            <td>
                                {{ $node->name ?? '-' }}
                            </td>
                            <td>
                                {{ $node->connected_sensor ?? '-' }}
                            </td>
                            <td>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('nodes.create')
@endsection

@push('body-js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.tailwindcss.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endpush

@push('body-script')
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "pageLength": 25,
            });
        });

        
    </script>
@endpush
