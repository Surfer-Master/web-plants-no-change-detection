@extends('layouts.main')

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('css')
@endpush

@push('style')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.tailwindcss.min.css') }}">
@endpush

@push('head-js')
@endpush

@push('head-script')
@endpush

@section('content')
    <div class="flex justify-between flex-wrap mb-4">
        <h3 class="text-2xl font-bold text-slate-700">Tanaman</h3>
    </div>
    <div class="w-full bg-white rounded-lg shadow">
        <div class="border-b">
            <h5 class="text-lg font-bold text-gray-900 py-2 px-4 md:py-3 md:px-6">Data Tanaman</h5>
        </div>
        <div class="relative overflow-x-auto p-2">
            <table class="datatable w-full ">
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
                            Urutan Sensor
                        </th>
                        <th scope="col" class="text-center uppercase">
                            Aksi
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
                                {{ $plant->soil_moisture_order ?? '-' }}
                            </td>
                            <td>
                                <a href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
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
