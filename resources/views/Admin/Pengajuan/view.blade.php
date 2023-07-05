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
                <table style="border-spacing: 0 1em;">
                    <tr>
                        <th style="width: 20%">Nama </th>
                        <th > : </th>
                        <th>{{$data->pegawai->nama}}</th>
                    </tr>
                    <tr>
                        <th style="width: 20%">Departemen </th>
                        <th > : </th>
                        <td>{{$data->pegawai->nama}}</td>
                    </tr>
                    <tr style="">
                        <th style="width: 20%"> Nominal </th>
                        <th > : </th>
                        <td>{{$data->nominal}}</td>
                        <th> Rekening </th>
                        <th > : </th>
                        <td>{{$data->norek }} ({{$data->bank}})</td>
                    </tr>
                    <tr>
                        <th style="width: 20%"> Keterangan </th>
                        <th > : </th>
                        <td>{{$data->keterangan}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
