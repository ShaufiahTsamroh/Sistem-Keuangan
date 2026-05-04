<h2>Review Reimburse</h2>

<table border="1">
<tr>
    <th>User</th>
    <th>Jumlah</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($data as $r)
<tr>
    <td>{{ $r->user_id }}</td>
    <td>{{ $r->amount }}</td>
    <td>{{ $r->status }}</td>
    <td>
    @if($r->status == 'pending')
        <a href="/approve/{{ $r->id }}">Approve</a> |
        <a href="/reject/{{ $r->id }}">Reject</a>
    @else
        Selesai
    @endif
</td>
</tr>
@endforeach
</table>