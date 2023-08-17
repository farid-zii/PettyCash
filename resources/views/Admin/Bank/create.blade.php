<div class="modal fade" dty id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Entry Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="/hrd/bank">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder" required>Nama</label>
                    <div class="mb-2">
                        <input type="text" class="form-control" placeholder="" name="nama" id="nama" value="{{old('nama')}}">
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" id='save' class="btn btn-primary float-sm-start col-md-2 mt-4" data-bs-dismiss="modal">Entry</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-dark float-sm-end col-md-2 mt-4 me-3">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function() {
    //     $.ajaxSetup({
    //         headers:{
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $('#save').on('click',function() {
    //     let nama=$('#nama').val()
    //     $.ajax({
    //         url:'/admin/departemen',
    //         type:'POST',
    //         cache:false,
    //         data:{
    //             'nama':nama,

    //         },success:function(response){
    //             $('').text(`${reponse.data.id}`)
    //             let dataPost =`<tr id="index_${response.data.id}">
    //                                 <td class="">2</td>
    //                                 <td class="" style="">
    //                                     <p class="align-middle">${response.data.nama}</p>
    //                                 </td>
    //                                 <td class="bg-info">
    //                                     <div class="d-flex">
    //                                         <button class="btn btn-warning font-weight-bold m-auto"
    //                                             data-bs-toggle="modal" data-bs-target="#data-${response.data.id}"><i
    //                                                 class="bi bi-pencil-square"></i></button>
    //                                         <button class="btn btn-danger font-weight-bold m-auto"
    //                                             data-bs-toggle="modal" data-bs-target="#delete-${response.data.id}"><i
    //                                                 class="bi bi-trash3-fill"></i></button>
    //                                     </div>
    //                                 </td>
    //                             </tr>`

    //             $('#table-departemen').append(dataPost);

    //         //clear form
    //             $('#nama').val('');
    //              displayMessage("berhasil")
    //         },
    //         errror:function(error){
    //             displayMessage("gagal")
    //         }
    //     }
    //     )
    // })
    // })

    function displayMessage(message) {
        toast.success(message,'Event')
    }
</script>
