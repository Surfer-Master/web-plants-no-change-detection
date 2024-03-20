@extends('layouts.main')

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('css')
@endpush

@push('style')
@endpush

@push('head-js')
@endpush

@push('head-script')
@endpush

@section('content')
    <div class="w-full bg-white rounded-lg shadow">
        <div class="border-b">
            <h5 class="text-xl font-bold text-gray-900 py-2 px-4 md:py-3 md:px-6">Node</h5>
        </div>
        <div class="relative overflow-x-auto m-3">
            <table class="datatable w-full text-sm text-left text-gray-50">
                <thead class="text-xs text-gray-700 uppercase font-bold bg-gray-50 dark:bg-gray-70">
                    <tr class="text-center">
                        <th scope="col" class="p-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Node
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sensor
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nodes as $node)
                        <tr
                            class="w-4 p-4 text-center odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4 text-gray-900">
                                {{ $node->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                {{ $node->connected_sensor ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
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
@endpush

@push('body-script')
@endpush
