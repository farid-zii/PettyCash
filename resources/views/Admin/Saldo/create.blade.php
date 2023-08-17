<div class="modal fade" dty id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Entry Data {{$title}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="/hrd/saldo">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder" required>Saldo</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="number" class="form-control" id='saldo' name="saldo" value="{{$saldoNow}}"
                            aria-describedby="basic-addon1" readonly>
                    </div>
                    <label class="text-xl text-dark font-weight-bolder ">Nominal</label>
                    <div class="mb-2">
                        <input type="number" class="form-control " placeholder="" id='nominal' required name="nominal"
                            value="">
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Entry</button>
                    <button type="button" class="btn btn-danger float-sm-end col-md-2 mt-4"
                        data-bs-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-dark float-sm-end col-md-2 mt-4 me-3">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

                // let nominal = parseFloat($('#nominal').val());
                // let saldo = parseFloat($('#saldo').val());

                // if (!isNaN(nominal)) {
                //     let hasil = saldo + nominal;
                //     console.log(hasil);
                //     $('#saldo').val(hasil);
                // } else {
                //     // Jika input 'nominal' kosong, reset saldo ke nilai semula
                //     let hasil = saldo ;
                //     $('#saldo').val(hasil);
                // }
            });
</script>
