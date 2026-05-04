<h2>Ajukan Reimburse</h2>

<form method="POST" action="/reimburse">
    @csrf

    <label>Jumlah:</label>
    <input type="number" name="amount">

    <br>

    <label>Keterangan:</label>
    <input type="text" name="description">

    <br>

    <label>Tanggal:</label>
    <input type="date" name="date">

    <br><br>

    <button type="submit">Ajukan</button>
</form>