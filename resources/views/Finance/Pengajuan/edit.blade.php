@foreach ($pengajuan as $data)
<div class="modal fade" dty id="data-{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tolak Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form  action="/finance/pengajuan/{{$data->id}}" method="put" enctype="multipart/form-data">
            {{-- <form  action="/pengajuan-edit/{{$data->id}}" method="put" enctype="multipart/form-data"> --}}
                @method('put')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder col-6">Alasan</label>
                    <div class="mb-2">
                        <textarea type="text" class="form-control" id="namaa" name="alasan" value="" placeholder=""></textarea>
                        {{-- <ul id="searchResult" class=""></ul> --}}
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Tolak</button>
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
