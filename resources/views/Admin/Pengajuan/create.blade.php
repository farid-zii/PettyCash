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
                        <select name="type" style="width: 100%;background: rgb(223, 219, 219);padding:5px;">
                            <option value="pengajuan">Pengajuan</option>
                            <option value="penambahan">Penambahan</option>
                        </select>
                    </div>
                    <label class="text-xl text-dark font-weight-bolder col-6">Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="nama" name="nama">
                        <ul id="searchResult" class=""></ul>
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Nominal</label>
                    <div class="mb-2" style="display:flex;">
                        <div class="form-control text-center" disabled style="width: 7%;background: rgb(223, 219, 219);">Rp</div>
                        <input type="number" class="form-control" placeholder="300" name="nominal" id="nominal">
                    </div>

                    <label class="text-xl text-dark font-weight-bolder">No. Rekening</label>
                    <div class="mb-2" style="display:flex;">
                        <select name="bank" style="width: 20%;background: rgb(223, 219, 219);">
                            <option value="BRI">BRI</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BNI">BNI</option>
                            <option value="BCA">BCA</option>
                            <option value="BSI">BSI</option>
                            <option value="BJB">BJB</option>
                            <option value="Lainnya">Lain-lain</option>
                        </select>
                        <input type="number" class="form-control" placeholder="300" name="norek" id="nominal">
                    </div>
                    <label class="text-xl text-dark font-weight-bolder">Keterangan</label>
                    <div class="mb-2">
                        <textarea class="form-control" name="keterangan"></textarea>
                    </div>
                    {{-- <label class="text-xl text-dark font-weight-bolder">Jumlah</label>
                    <div class="mb-2">
                        <input type="number" class="form-control" placeholder="" name="hasil">
                     </div>/// --}}

                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Save</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $('#nama').on('input',function() {
        let keyword = $(this).val();
        var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

  // Setel CSRF token pada header Axios
    //  axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

        // $.ajax({
        //     url: `/api/searchNama`,
        //     type: "GET",
        //     data:{keyword: keyword}
        // })
        axios.get('/api/searchNama',{ params: {keyword: keyword}})
        .then(function (response) {
            var results = response.data;

            console.log(results)//cek data masuk atau tidak

            $('#searchResult').empty();

            results.forEach(function(result) {
                var listNama = $(`<li style="list-style-type:none;">`).text(result);
                $('#searchResult').append(listNama);
            })

        }).catch(function(error) {
            console.error(error)
        })
    })

        // Event listener saat opsi autocompleted di klik
    $(document).on('click', '#searchResult li', function () {
    var selectedValue = $(this).text();

    // Isi input field dengan opsi autocompleted yang dipilih
    $('#nama').val(selectedValue);

    // Kosongkan hasil pencarian
    $('#searchResult').empty();
    });

</script>
