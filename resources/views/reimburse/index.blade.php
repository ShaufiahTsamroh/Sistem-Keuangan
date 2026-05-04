<h2>Data Reimburse Saya</h2>

<a href="/reimburse/create">Ajukan Baru</a>

<table border="1">
    <tr>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{ $d->amount }}</td>
        <td>{{ $d->status }}</td>
        <td>{{ $d->date }}</td>
    </tr>
    @endforeach
</table>