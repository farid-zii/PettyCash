@foreach ($pengajuan as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="/pengajuan-edit" method="post" enctype="multipart/form-data">
            {{-- <form  action="/pengajuan-edit/{{$data->id}}" method="put" enctype="multipart/form-data"> --}}

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
                        <input type="text" class="form-control" id="namaa" name="nama" value="{{$data->pegawai->nama}}" disabled>
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>

                    <label class="text-xl text-dark font-weight-bolder col-6">Project</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="projecta" name="project" style="" value="{{$data->project}}">
                        <input type="hidden" class="form-control" id="projecta" name="id" style="width: 200%" value="{{$data->id}}">
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>

                    <label class="text-xl text-dark font-weight-bolder">Nominal</label>
                    <div class="mb-2" style="display:flex;">
                        <div class="form-control text-center" disabled style="width: 7%;background: rgb(223, 219, 219);">Rp</div>
                        <input type="number" class="form-control" placeholder="300" name="nominal" id="nominal" value="">
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
                        <input type="number" class="form-control" placeholder="300" name="norek" id="norek" value="{{$data->norek}}">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Uraian</label>
                    <div class="mb-2">
                        <textarea class="form-control" name="keterangan" id="keterangan" onkeydown="">{{$data->keterangan}}</textarea>
                    </div>
                    {{-- <label class="text-xl text-dark font-weight-bolder">Jumlah</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" placeholder="" name="hasil">
                     </div>/// --}}

                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-warning float-sm-start col-md-2 mt-4">Edit</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>








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
@endforeach
