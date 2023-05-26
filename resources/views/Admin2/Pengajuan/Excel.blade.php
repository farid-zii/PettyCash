<table>
    <thead>
        <tr style="font-weight: bolder;text-align: center">
            <th>no</th>
            <th>aa</th>
            <th>aaa</th>
            <th colspan="2">aa</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $dataa)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$dataa->name}}</td>
            <td>{{$dataa->created_at->format('y-m-d')}}</td>
            <td colspan="2">{{$dataa->email}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
