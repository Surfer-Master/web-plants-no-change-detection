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
<div class=""></div>
@endsection

@push('body-js')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
@endpush

@push('body-script')
    <script>
        $('.btn-edit').on('click', function(e) {
            let link = $(this).attr('href');

            $.get(link, function(data) {
                    $('#editEDPSModal form').attr('action', link.replace("/edit", ""));
                    $('#program_studi').val(data.study_program).trigger('change');
                    $('#waktu_mulai').val(data.start_time);
                    $('#waktu_selesai').val(data.end_time);
                    $('#asesor_1').val(data.assessor_1).trigger('change');
                    $('#asesor_2').val(data.assessor_2).trigger('change');
                    $('#status').val(data.status).trigger('change');
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

        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            let link = $(this).attr('href');
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Iya, hapus sekarang!",
                customClass: {
                    cancelButton: "btn btn-secondary me-3",
                    confirmButton: "btn btn-primary",
                },
                buttonsStyling: false,
                reverseButtons: true
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: link,
                        method: 'DELETE',
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'),
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: response.status,
                                title: response.title,
                                text: response.message,
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: status,
                                title: "Opps..",
                                text: xhr.responseJSON.message,
                            });
                            console.error('Error:', error);
                        }
                    });
                }
            });
        });

        $('#form').on('submit', function(e) {
            e.preventDefault();
            formData = new FormData($('#form')[0])
            // formData.forEach((value, key) => {
            //     console.log(key, value);
            // });

            Swal.fire({
                title: 'Sedang mengirim...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    $.ajax({
                        url: $('#form').attr('action'),
                        method: 'POST', // atau 'POST', 'PUT', dll.
                        data: formData,
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'),
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: response.status,
                                title: "Berhasil",
                                text: response.message,
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: status,
                                title: "Opps..",
                                text: xhr.responseJSON.message,
                            });
                            console.error('Error:', error);

                            console.log('status: ' + status);
                            console.log('xhr: ' + xhr);
                            console.log('error: ' + error);
                        }
                    });
                }
            });
        });
    </script>
@endpush
