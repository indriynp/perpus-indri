@extends('layouts.admin')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Data</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('peminjaman_store') }}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                <label for="id_buku">Nama Buku :</label>
                <select class="form-control" id="id_buku" name="id_buku">
                  <option selected>Pilih Nama Buku</option>
                  @foreach($bukus as $buku)
                  <option value="{{ $buku->id }}">{{ $buku->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="id_anggota">Anggota :</label>
                <input type="text" class="form-control  @error('id_anggota') is-invalid @enderror" id="id_anggota" name="id_anggota" value="{{ old('id_anggota') }}" placeholder="Enter anggota">
                @error('id_anggota')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam :</label>
                <input type="Date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}" placeholder="Enter penulis">
                @error('tanggal_pinjam')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali :</label>
                <input type="Date" class="form-control @error('tanggal_kembali') is-invalid @enderror" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" placeholder="Enter penerbit">
                @error('tanggal_kembali')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="denda">Denda :</label>
                <input type="text" class="form-control @error('denda') is-invalid @enderror" id="denda" name="denda" value="{{ old('denda') }}" placeholder="Enter denda">
                @error('denda')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="id_status_peminjaman">Status Peminjaman :</label>
                <input type="text" class="form-control @error('id_status_peminjaman') is-invalid @enderror" id="id_status_peminjaman" name="id_status_peminjaman" value="{{ old('id_status_peminjaman') }}" placeholder="Enter status peminjaman">
                @error('id_status_peminjaman')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="card-footer">
              <a href="{{ route('peminjaman_index') }}" class="btn btn-info">Back</a>
              <button type="submit" class="btn btn-primary">Submit</button>
              
            </div>
          </form>

        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>


@endsection