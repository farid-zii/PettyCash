@foreach ($pengajuan as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Bukti</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="/realisasi" method="post" enctype="multipart/form-data" >
            {{-- <form  action="/pengajuan-edit/{{$data->id}}" method="put" enctype="multipart/form-data"> --}}
                @method('POST')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder col-6">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="namaa" name="kode" value="{{$data->kode}}" readonly>
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>
                    <label class="text-xl text-dark font-weight-bolder col-6">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="namaa" name="nama" value="{{$data->pegawai->nama}}" readonly>
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>

                    <label class="text-xl text-dark font-weight-bolder col-6">Project</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="project" value="{{$data->project}}" readonly>
                        <input type="hidden" class="form-control" id="projecta" name="id" style="width: 200%" value="{{$data->id}}">
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>


                    <label class="text-xl text-dark font-weight-bolder">Uraian</label>
                    <div class="mb-2">
                        <textarea class="form-control" name="keterangan" id="keterangan" onkeydown="" readonly>{{$data->keterangan}}</textarea>
                    </div>


                    @if ($data->type==1)
                    <label class="text-xl text-dark font-weight-bolder">Terpakai</label>
                    <div class="mb-2" style="display:flex;">
                        <div class="form-control text-center" disabled style="width: 7%;background: rgb(223, 219, 219);">Rp</div>
                        <input type="number" class="form-control" placeholder="300" name="terpakai" id="nominal">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nominal"></div>
                    </div>
                    @endif



                     <label class="text-xl text-dark font-weight-bolder col-6">Bukti</label>
                     <table id="tabelBukti" class="col-8">
                        <tr>
                            <td width="90%">
                                <input type="file" class="form-control"  name="inputs[0][gambars]" multiple>
                            </td>
                            <td width="10%">
                                <button type="button" id="add" onclick="">+</button>
                            </td>
                        </tr>
                     </table>


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


<!-- Masukkan ini di bagian bawah halaman Anda -->
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.js"></script>
<script>

    var i = 0;
        $('#add').click(function(){
            ++i;
            $('#tabelBukti').append(
                `<tr>
                    <td width="90%"><input type="File" class="form-control" name="inputs[+i+][gambars]" placeholder="masukkan nama"></td>
                    <td width="10%"><button type="button" class="btn btn-danger remove-table-row">-</button></td>
                </tr>`
            );
        });

        $(document).on('click','.remove-table-row', function(){
            $(this).parents('tr').remove();
        });

</script>


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
