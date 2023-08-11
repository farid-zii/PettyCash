            <form method="post" action="/finance/saldo">
                @method('POST')
                @csrf
                <div class="modal-body">
                    <label class="text-xl text-dark font-weight-bolder" required>saldo</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="number" class="form-control" id='saldo' name="saldo" value="{{$saldoNow}}"
                            aria-describedby="basic-addon1" readonly>
                    </div>
                    <label class="text-xl text-dark font-weight-bolder ">nominal</label>
                    <div class="mb-2">
                        <input type="number" class="form-control " placeholder="" id='nominal' required name="nominal"
                            value="">
                    </div>
                </div>
                <div class="footer px-4 mb-2">
                    <button type="submit" class="btn btn-primary float-sm-start col-md-2 mt-4">Save</button>
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
