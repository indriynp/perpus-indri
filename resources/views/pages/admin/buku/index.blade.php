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
                        <th style="text-align:center;">Id Penulis</th>
                        <th style="text-align:center;">Tahun Terbit</th>
                        <th style="text-align:center;">Id Penerbit</th>
                        <th style="text-align:center;">Id Kategori</th>
                        <th width="200px" style="text-align: center;">Sinopsis</th>
                        <th style="text-align:center;">Sampul</th>
                        <th width="250px" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                @foreach($buku as $b)
                <tbody>
                    <tr>
                        <td style="text-align:center">{{ $b->id }}</td>
                        <td style="text-align:center">{{ $b->nama }}</td>
                        <td style="text-align:center" style="text-align:center">{{ $b->id_penulis }}</td>
                        <td style="text-align:center">{{ $b->tahun_terbit }}</td>
                        <td style="text-align:center">{{ $b->id_penerbit }}</td>
                        <td style="text-align:center">{{ $b->id_kategori }}</td>
                        <td style="text-align:center">{{ $b->sinopsis }}</td>
                        <td style="text-align:center">{{ $b->sampul }}</td>
                        <td style="text-align:center">
                            <for action="" method="POST">

                                <a class="btn btn-info" href="">Show</a>

                                <a class="btn btn-primary" href="">Edit</a>

                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection