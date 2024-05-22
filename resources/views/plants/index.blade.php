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
        <button data-modal-target="plant-modal" data-modal-toggle="plant-modal"
            class="block text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 btn-add"
            type="button">
            <i class="fa-solid fa-plus h-3 me-2 -ms-1"></i>
            Tambah Tanaman
        </button>
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
                            Node
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
                                {{ $plant->node->name ?? '-' }}
                            </td>
                            <td>
                                {{ $plant->soil_moisture_order ?? '-' }}
                            </td>
                            <td>
                                <a href="{{ route('plants.edit', ['plant' => $plant->id]) }}"
                                    data-modal-target="plant-modal" data-modal-toggle="plant-modal"
                                    class="m-1 p-1.5 text-base text-yellow-400 rounded-lg hover:text-yellow-900 hover:bg-yellow-100 dark:text-yellow-400 dark:hover:text-white dark:hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-600 btn-edit"
                                    title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('plants.destroy', ['plant' => $plant->id]) }}"
                                    class="m-1 p-1.5 text-base text-red-700 rounded-lg hover:text-red-900 hover:bg-red-100 dark:text-red-400 dark:hover:text-white dark:hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-600 btn-delete"
                                    title="Hapus"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tambah & Edit Plant --}}
    <div id="plant-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            {{-- <!-- Modal content --> --}}
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                {{-- <!-- Modal header --> --}}
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="plant-modal-header">
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="plant-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('plants.store') }}" method="post" class="p-4 md:p-5" autocomplete="off">
                    @method('post')
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="nama"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white after:content-['*'] after:text-red-500 after:ml-0.5">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Nama Tanaman" required>
                        </div>
                        <div class="col-span-2">
                            <label for="lokasi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white after:content-['*'] after:text-red-500 after:ml-0.5">Lokasi</label>
                            <input type="text" name="lokasi" id="lokasi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Lokasi Tanaman" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="node"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white after:content-['*'] after:text-red-500 after:ml-0.5">Node</label>
                            <select name="node" id="node" class="select2" data-placeholder="Pilih Node" required>
                                <option value=""></option>
                                @foreach ($nodes as $node)
                                    <option value="{{ $node->id }}">{{ $node->name ?? '-' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="urutan_sensor"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white after:content-['*'] after:text-red-500 after:ml-0.5">Urutan
                                Sensor</label>
                            <select name="urutan_sensor" id="urutan_sensor" class="select2"
                                data-placeholder="Pilih Urutan Sensor" required>
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
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

        $('#plant-modal .select2').select2({
            dropdownParent: $('#plant-modal'),
            width: '100%',
            allowClear: true,
        });

        $('.btn-add').on('click', function(e) {
            e.preventDefault();
            let link = '{{ route('plants.store') }}';

            $('#plant-modal #plant-modal-header').text('Tambah Tanaman');
            $('#plant-modal form').attr('action', link);
            $('#plant-modal form input[name="_method"]').val('post');
            $('#nama').val(null);
            $('#lokasi').val(null);
            $('#node').val(null).trigger('change');
            $('#urutan_sensor').val(null).trigger('change');
        });

        $('.btn-edit').on('click', function(e) {
            e.preventDefault();
            let link = $(this).attr('href');

            $('#plant-modal #plant-modal-header').text('Edit Tanaman');
            $('#plant-modal form').attr('action', link.replace("/edit", ""));
            $('#plant-modal form input[name="_method"]').val('put');

            $.get(link, function(data) {
                    $('#nama').val(data.nama);
                    $('#lokasi').val(data.lokasi);
                    $('#node').val(data.node).trigger('change');
                    $('#urutan_sensor').val(data.urutan_sensor).trigger('change');
                })
                .fail(function(error) {
                    Swal.fire({
                        icon: "error",
                        title: "Opps..",
                        text: "Terjadi Kesalahan",
                    });
                    console.error('Error:', error);
                });
        });

        $('#plant-modal form').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData($('#plant-modal form')[0]);
            // formData.forEach((value, key) => {
            //     console.log(key, value);
            // });

            Swal.fire({
                title: "Sedang mengirim...",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: $("#plant-modal form").attr("action"),
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
