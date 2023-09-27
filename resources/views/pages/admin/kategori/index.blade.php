@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <h3>Kategori</h3>
        </div>
    </div>
</div>


<div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Data Kategori</h2>
    </div>


    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="card-body">
        <div class="col-md-6">
            <label>Nama Kategori</label>
         <form method="get" action="{{ route('kategori_search') }}">
            <div class="input-group">
                <input type="search" name="search" class="form-control"  placeholder="Search Kategori..">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>

    <div class="card-body">
        <div style="margin-bottom: 20px">
            <a href="{{ route('kategori_create') }}" class="btn btn-primary btn-flat">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
            <a href="{{ url('kategori-export') }}" class="btn btn-success btn-flat">
                <i class="fa fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ url('kategori-pdf') }}" class="btn btn-danger btn-flat">
                <i class="fa fa-file-pdf"></i> Export PDF
            </a>
        </div>
        <div style="overflow: auto">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Nama Kategori</th>
                        <th style="text-align:center;">Jumlah Buku</th>
                        <th width="250px" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                @foreach($kategori as $k)
                <tbody>
                    <tr>
                        <td style="text-align:center">{{ $loop->iteration }}</td>
                        <td style="text-align:center">{{ $k->nama }}</td>
                        <td style="text-align:center">{{ $k->getJumlahBuku() }}</td>
                        <td style="text-align:center">
                            <for action="" method="POST">

                                <a href="{{ route('kategori_show', $k->id) }}" class="btn btn-info">
                                <i class="fa-regular fa-eye"></i>
                            </a>

                                <a href="{{ route('kategori_edit', $k->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <form action="{{ route('kategori_destroy', $k->id) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?');" class="btn btn-danger bi bi-trash"></button>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @endsection