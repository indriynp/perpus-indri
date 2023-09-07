@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <h3>Peminjaman</h3>
        </div>
    </div>
</div>

<div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Data Peminjam</h2>
    </div>

    <div class="card-body">
        <div style="margin-bottom: 20px">
            <a href="{{ route('peminjaman_index') }}" class="btn btn-primary btn-flat">Kembali </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 180px">Nama Buku</th>
                    <td>{{ $data->id_buku }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Anggota</th>
                    <td>{{ $data->id_anggota }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Tanggal Pinjam</th>
                    <td>{{ $data->tanggal_pinjam }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Tanggal Kembali</th>
                    <td>{{ $data->tanggal_kembali }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Denda</th>
                    <td>{{ $data->denda }}</td>
                </tr>
                <tr>
                    <th style="width: 180px">Status Peminjaman</th>
                    <td>{{ $data->id_status_peminjaman }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
</div>
@endsection