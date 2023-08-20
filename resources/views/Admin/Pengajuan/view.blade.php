@foreach ($pengajuan as $data)
<div class="modal fade" dty id="data-{{$data->id}}-view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">View {{$title}}</h1>
                <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="p-3">
                <table style="border-spacing: 0 1em;" class="col-12 table table-striped">
                    <tr>
                        <th class="3">Nama</th>
                        <td>{{$data->user->nama}}</td>
                    </tr>
                    <tr>
                        <th class="3">Departemen</th>
                        <td>{{$data->user->departemen->nama}}</td>
                    </tr>
                    <tr>
                        <th class="3">Nominal</th>
                        <td>Rp. @rp($data->nominalAcc)</td>
                    </tr>
                    <tr>
                        <th class="3">Keterengan</th>
                        <td>{{$data->keterangan}}</td>
                    </tr>
                    <tr>
                        <th class="3">Status</th>
                        <td>{{$data->approve}}</td>
                    </tr>
                    <tr>
                        <th class="3">Catatan Finance</th>
                        <td> {{$data->komen}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
