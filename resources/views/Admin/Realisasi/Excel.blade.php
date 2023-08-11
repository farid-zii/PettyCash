
<table>
    <thead>
        <tr>
            <th colspan="5">{{$tanggal}}</th>
        </tr>
        <tr style="font-weight: bolder;text-align: center">
            <th>Kode</th>
            <th>Nama</th>
            <th>Departemen</th>
            <th>No.Rek</th>
            <th>Debit</th>
            <th>Uraian</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dataa)
        <tr>
            <td>{{$dataa->kode}}</td>
            <td>{{$dataa->pegawai->nama}}</td>
            <td>{{$dataa->pegawai->departemen->nama}}</td>
            <td>
                {{$dataa->norek}}<br>
                {{$dataa->bank}}
            </td>
            <td>{{$dataa->debit}}</td>
            <td>{{$dataa->debit}}</td>
            <td>{{$dataa->keterangan}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
