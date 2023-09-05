@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <h3>Buku</h3>
        </div>
    </div>
</div>

<div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Data Buku</h2>
    </div>

    <div class="card-body">
        <div style="margin-bottom: 20px">
            <a href="{{ route('buku_index') }}" class="btn btn-primary btn-flat">Kembali </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 180px">Nama</th>
                    <td>{{ $buku->nama }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Tahun Terbit</th>
                    <td>{{ $buku->tahun_terbit }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Penulis</th>
                    <td>{{ $buku->id_penulis }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Penerbit</th>
                    <td>{{ $buku->id_penerbit }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Kategori</th>
                    <td>{{ $buku->kategori }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Sinopsis</th>
                    <td>{{ $buku->sinopsis }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Sampul</th>
                    <td><img src="/sampul/{{ $buku->sampul }}" width="100px"></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
@endsection