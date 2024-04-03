@push('css')
@endpush

@push('style')
@endpush

@push('head-js')
@endpush

@push('head-script')
@endpush

<div id="node-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        {{-- <!-- Modal content --> --}}
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            {{-- <!-- Modal header --> --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="node-modal-header">
                    Tambah Node
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
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nama"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white after:content-['*'] after:text-red-500 after:ml-0.5">Nama</label>
                        <input type="text" name="nama" id="nama"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nama Node" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="sensor"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white after:content-['*'] after:text-red-500 after:ml-0.5">
                            Jenis Sensor
                        </label>
                        <select name="sensor" id="sensor" class="select2" data-placeholder="Pilih Jenis Sensor"
                            required>
                            <option value=""></option>
                            <option value="dht">DHT</option>
                            <option value="soil-moisture">Soil Moisture</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="w-full text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <i class="fa-solid fa-plus fa-sm me-1"></i>Simpan
                </button>
            </form>
        </div>
    </div>
</div>

@push('body-js')
@endpush

@push('body-script')
    <script>
        $('#node-modal .select2').select2({
            dropdownParent: $('#node-modal'),
            width: '100%',
            allowClear: true,
        });



        // $('#node-modal').on('hidden.bs.modal', function(e) {
        //     console.log(123);
        // $('#editEDPSModal form').attr('action', '#');
        // $('#program_studi').val(null).trigger('change');
        // $('#kaprodi').val(null).trigger('change');
        // $('#asesor_1').val(null).trigger('change');
        // $('#asesor_2').val(null).trigger('change');
        // $('#tahun').val(null);
        // $('#waktu_mulai').val(null);
        // $('#waktu_akhir_pengisian_kaprodi').val(null);
        // $('#waktu_akhir_penilaian_asesor').val(null);
        // $('#status').val(null).trigger('change');
        // $('#assessment_by_assessor1').prop('checked', false);
        // $('#assessment_by_assessor2').prop('checked', false);
        // });

        myModal.updateOnHide(() => {
            // Tindakan yang ingin dilakukan setelah modal ditutup
            console.log("Modal telah ditutup");
        });
    </script>
@endpush
