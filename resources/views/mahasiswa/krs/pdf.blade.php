
<!DOCTYPE html>
<html>
<head>
    <title>Kartu Rencana Studi</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Kartu Rencana Studi (KRS)</h2>
    <p><strong>NPM:</strong> {{ $user->npm }}<br>
    <strong>Nama:</strong> {{ $user->name }}</p>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($krs as $index => $k)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $k->matakuliah->kode_matakuliah }}</td>
                    <td>{{ $k->matakuliah->nama_matakuliah }}</td>
                    <td>{{ $k->matakuliah->sks }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right; font-weight: bold;">Total SKS</td>
                <td style="font-weight: bold;">{{ $totalSks }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
