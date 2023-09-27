<!DOCTYPE html>
<html>
<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
        table tr td,
        table tr th{
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Laporan Penerbit PDF</h4>
        <h6><a target="_blank" href="https://www.malasngoding.com/membuat-laporan-…n-dompdf-laravel/"></a></h5>
    </center>
 
    <table class='table table-bordered'>
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Jumlah Buku</th>
        </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach($kategoris as $kategori)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $kategori->nama }}</td>
            <td>{{ $kategori->getJumlahBuku() }}</td>
        </tr>
            @endforeach
        </tbody>
    </table>
 
</body>
</html>