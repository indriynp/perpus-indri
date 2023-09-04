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


    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card-body">
        <div style="margin-bottom: 20px">
            <a href="{{ route('buku_create') }}" class="btn btn-primary btn-flat">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
        </div>
        <div style="overflow: auto">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Nama</th>
                        <th style="text-align:center;">Penulis</th>
                        <th style="text-align:center;">Tahun Terbit</th>
                        <th style="text-align:center;">Penerbit</th>
                        <th style="text-align:center;">Kategori</th>
                        <th width="200px" style="text-align: center;">Sinopsis</th>
                        <th style="text-align:center;">Sampul</th>
                        <th width="250px" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align:center">{{ $buku->nama }}</td>
                        <td style="text-align:center" style="text-align:center">{{ $buku->id_penulis }}</td>
                        <td style="text-align:center">{{ $buku->tahun_terbit }}</td>
                        <td style="text-align:center">{{ $buku->id_penerbit }}</td>
                        <td style="text-align:center">{{ $buku->id_kategori }}</td>
                        <td style="text-align:center">{{ $buku->sinopsis }}</td>
                        <td style="text-align:center">{{ $buku->sampul }}</td>
                        <td style="text-align:center">

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection