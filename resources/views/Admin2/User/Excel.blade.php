<style>
    table {
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
    }
</style>
<table style="border: 1px solid">
    <thead>
        <tr >
            <th style="font-weight: bolder;text-align: center" colspan="2">KODE</th>
            <th style="font-weight: bolder;text-align: center" colspan="2">NAMA</th>
            <th style="font-weight: bolder;text-align: center" colspan="2">DEPARTEMEN</th>
            <th style="font-weight: bolder;text-align: center" colspan="2">PROJECT</th>
            <th style="font-weight: bolder;text-align: center" colspan="2">BANK</th>
            <th style="font-weight: bolder;text-align: center" colspan="2">NOMINAL</th>
            <th style="font-weight: bolder;text-align: center" colspan="2">URAIAN</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dataa)
        <tr>
            <td style="text-align: center" colspan="2">{{$dataa->kode}}</td>
            <td style="" colspan="2">{{$dataa->pegawai->nama}}</td>
            <td style="font-weight: bolder;text-align: center">{{$dataa->created_at->format('y-m-d')}}</td>
            <td style="" colspan="2">{{$dataa->norek}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
