@extends('layouts.main')
@section('content')

<div class="card shadow mb-4">
   <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data buku</h6>
</div>
<div class="card-body">
    <form action="/buku/tambah" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="id" class="form-label">Id</label>
                    <input type="text" class="form-control" id="id" name="id" placeholder="Id">
                </div>

            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="id_penulis" class="form-label">id_penulis</label>
                    <input type="text" class="form-control" id="id_penulis" name="id_penulis" placeholder="id_penulis">
                </div>

            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="tahun_penerbit" class="form-label">tahun_penerbit</label>
                    <input type="text" class="form-control" id="tahun_penerbit" name="tahun_penerbit" placeholder="tahun_penerbit">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="id_penerbit" class="form-label">id_penerbit</label>
                    <input type="text" class="form-control" id="id_penerbit" name="id_penerbit" placeholder="id_penerbit">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="id_kategori" class="form-label">id_kategori</label>
                    <input type="text" class="form-control" id="id_kategori" name="id_kategori" placeholder="id_kategori">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="sinopsis" class="form-label">sinopsis</label>
                    <input type="text" class="form-control" id="sinopsis" name="sinopsis" placeholder="sinopsis">
                </div>

            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="sampul" class="form-label">sampul</label>
                    <textarea class="form-control" id="sampul" name="sampul" row="3"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-primary btn-sm">Tambah Data</button>
        </div>                
    </form>
</div>
</div>

@endsection