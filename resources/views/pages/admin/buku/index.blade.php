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
        <div class="col-md-6">
            <label>Nama Buku</label>
         <form method="get" action="{{ route('buku_search') }}">
            <div class="input-group">
                <input type="search" name="search" class="form-control"  placeholder="Search Nama Buku..">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>
</div>

    <div class="card-body">
        <div style="margin-bottom: 20px">
            <a href="{{ route('buku_create') }}" class="btn btn-primary btn-flat">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
            <a href="{{ url('buku-export') }}" class="btn btn-success btn-flat">
                <i class="fa fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ url('buku-pdf') }}" class="btn btn-danger btn-flat">
                <i class="fa fa-file-pdf"></i> Export PDF
            </a>
        </div>
        <div style="overflow: auto">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Nama Buku</th>
                        <th style="text-align:center;">Tahun Terbit</th>
                        <th style="text-align:center;">Penulis</th>
                        <th style="text-align:center;">Penerbit</th>
                        <th style="text-align:center;">Kategori</th>
                        <th width="200px" style="text-align: center;">Sinopsis</th>
                        <th style="text-align:center;">Jumlah</th>
                        <th style="text-align:center;">Sampul</th>
                        <th width="250px" style="text-align: center;">Action</th>
                    </tr>
                </thead>
                @foreach($allBuku as $buku)
                <tbody>
                    <tr>
                        <td style="text-align:center">{{ $loop->iteration }}</td>
                        <td style="text-align:center">{{ $buku->nama }}</td>
                        <td style="text-align:center">{{ $buku->tahun_terbit }}</td>
                        <td style="text-align:center" style="text-align:center">{{ @$buku->penulis->nama }}</td>
                        <td style="text-align:center">{{ @$buku->penerbit->nama }}</td>
                        <td style="text-align:center">{{ @$buku->kategori->nama }}</td>
                        <td style="text-align:center">{{ $buku->sinopsis }}</td>
                        <td style="text-align:center">{{ $buku->jumlah }}</td>
                        <td style="text-align:center"><img src="{{ asset('storage/'.$buku->sampul) }}" style="width: 150px;"></td>
                        <td style="text-align:center">

                            <a href="{{ route('buku_show', $buku->id) }}" class="btn btn-info">
                                <i class="fa-regular fa-eye"></i>
                            </a>

                            <a href="{{ route('buku_edit', $buku->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('buku_destroy', $buku->id) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?');" class="btn btn-danger bi bi-trash"></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection