<div class="modal fade" dty id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Pengajuan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/pengajuan">
                @method('POST')
                @csrf
                <div class="modal-body">

                    <div class="mb-1 col-4 float-sm-end">
                        <select name="type" id='type' style="width: 100%;background: rgb(223, 219, 219);padding:5px;">
                            <option value="1">Pengajuan</option>
                            <option value="0">Penambahan</option>
                        </select>
                    </div>
                    <label class="text-xl text-dark font-weight-bolder col-6">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="nama" name="nama">
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>

                    <label class="text-xl text-dark font-weight-bolder col-6">Project</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="project" name="project" style="width: 200%">
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>

                    <label class="text-xl text-dark font-weight-bolder">Nominal</label>
                    <div class="mb-2" style="display:flex;">
                        <div class="form-control text-center" disabled style="width: 7%;background: rgb(223, 219, 219);">Rp</div>
                        <input type="number" class="form-control" placeholder="300" name="nominal" id="nominal">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nominal"></div>
                    </div>

                    <label class="text-xl text-dark font-weight-bolder">No. Rekening</label>
                    <div class="mb-2" style="display:flex;">
                        <select name="bank" id="bank" style="width: 20%;background: rgb(223, 219, 219);">
                            <option value="BRI">BRI</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BNI">BNI</option>
                            <option value="BCA">BCA</option>
                            <option value="BSI">BSI</option>
                            <option value="BJB">BJB</option>
                            <option value="Lainnya">Lain-lain</option>
                        </select>
                        <input type="number" class="form-control" placeholder="300" name="norek" id="norek">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Uraian</label>
                    <div class="mb-2">
                        <textarea class="form-control" name="keterangan" id="keterangan" onkeydown="addNumberOnEnter(event)"></textarea>
                    </div>
                    {{-- <label class="text-xl text-dark font-weight-bolder">Jumlah</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" placeholder="" name="hasil">
                     </div>/// --}}

                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4" >Save</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {
    // Initialize the Typeahead.js autocomplete
    var namaInput = $('#nama');
    var namaData = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/api/searchNama?keyword=%QUERY',
            wildcard: '%QUERY'
        }
    });

    namaInput.typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'nama-autocomplete',
            display: 'nama',
            source: namaData,
            templates: {
                suggestion: function(data) {
                    return '<div class="custom-suggestion" style="z-index: 999; background: #c3bdbd; ; width: 120%;">' + data.nama + '</div>';
                },
            }
        }
    );

    var projectInput = $('#project');
    var projectData = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('project'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: '/api/get-project?q=%QUERY',
            wildcard: '%QUERY'
        }
    });

    projectInput.typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'project-autocomplete',
            display: 'project',
            source: projectData,
            templates: {
                suggestion: function(data) {
                    return '<div class="custom-suggestion" style="z-index: 999; background: #c3bdbd; ; width: 200%;">' + data.project + '</div>';
                },
            }
        }
    );


});

// Rest of your code
$('#nama').on('typeahead:selected', function(event, suggestion, dataset) {
    // Do something when a suggestion is selected
    console.log(suggestion);
});

// Rest of your code
$('#project').on('typeahead:selected', function(event, suggestion, dataset) {
    // Do something when a suggestion is selected
    console.log(suggestion);
});




    var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    // function simpan() {
    //     let nama = $('#nama').val();
    //     let type = $('#type').val();
    //     let nominal = $('#nominal').val();
    //     let bank = $('#bank').val();
    //     let norek = $('#norek').val();
    //     let project = $('#project').val();
    //     let keterangan = $('#keterangan').val();
    //     axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken
    //     axios.post('/api/iPengajuan',{
    //         nama:nama,
    //         type:type,
    //         bank:bank,
    //         nominal:nominal,
    //         norek:norek,
    //         project:project,
    //         keterangan:keterangan
    //     }).then(function(response) {

    //         console.log(response.data)

    //         //Menutup modal
    //         let modal = $('#staticBackdrop')
    //         let bModal = bootstrap.Modal.getInstance(modal)
    //         // toastr.error();('berhasil')
    //         let closeButton = $('#staticBackdrop .btn-danger');
    //         // closeButton.click()
    //         // location.reload();


    //     }).catch(function(error) {

    //         Swal.fire({
    //             title: 'Error!',
    //             text: 'Pastikan Semua Data Di isi',
    //             icon: 'error',
    //             timer: 2000,
    //             confirmButtonText: 'Close'
    //         })
    //     })
    // }



//    $('#nama').on('input', function() {
//     let keyword = $(this).val();
//     // var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

//     axios.get('/api/searchNama', { params: { keyword: keyword } })
//         .then(function(response) {
//             var results = response.data;

//             console.log(results); // Cek data masuk atau tidak

//             $('#searchResult').empty();

//             results.forEach(function(result) {
//                 // Cek jika value gambar === null sebelum menambahkan elemen <li>
//                 if (keyword !== null || keyword !== undefined) {
//                     var listNama = $('<li style="list-style-type:none;">').text(result);
//                     $('#searchResult').append(listNama);
//                 }else{
//                 $('#searchResult').empty();
//                 }
//             });
//         })
//         .catch(function(error) {
//             console.error(error);
//         });
// });


        // Event listener saat opsi autocompleted di klik
    // $(document).on('click', '#searchResult li', function () {
    // var selectedValue = $(this).text();

    // // Isi input field dengan opsi autocompleted yang dipilih
    // $('#nama').val(selectedValue);

    // // Kosongkan hasil pencarian
    // $('#searchResult').empty();
    // });

</script>
