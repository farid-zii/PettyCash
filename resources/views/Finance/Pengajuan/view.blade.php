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
                        <th>{{$data->user->nama}}</th>
                    </tr>
                    <tr>
                        <th style="width: 20%">Departemen </th>
                        <th > : </th>
                        <td>{{$data->user->departemen->nama}}</td>
                    </tr>
                    <tr style="">
                        <th style="width: 20%"> Nominal </th>
                        <th > : </th>
                        <td>{{$data->debit}}</td>
                        <th> Rekening </th>
                        <th > : </th>
                        <td>{{$data->norek }} ({{$data->bank->nama}})</td>
                    </tr>

                    <tr>
                        <th style="width: 20%"> Keterangan</th>
                        <th > : </th>
                        <td>{{$data->keterangan}}</td>
                    </tr>
                    <tr>
                        <th style="width: 20%"> Status Aprrove</th>
                        <th > : </th>
                        <td>{{$data->approve}}</td>
                        <td>@if ($data->approve=='❌')
                                        <div class=""><b>ALASAN :</b>{{$data->komenF}}</div>
                                        @endif</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
