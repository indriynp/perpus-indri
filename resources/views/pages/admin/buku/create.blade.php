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
            <form action="{{ route('buku_store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="nama">Nama Buku :</label>
                <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Enter nama buku">
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit :</label>
                <input type="text" class="form-control  @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}" placeholder="Enter tahun terbit">
                @error('tahun_terbit')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="id_penulis">Penulis :</label>
                <select class="form-control" id="id_penulis" name="id_penulis">
                  <option selected>Nama Penulis</option>
                  @foreach($penulis as $pen)
                  <option value="{{ $pen->id }}">{{ $pen->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="id_penerbit">Penerbit :</label>
                <select class="form-control" id="id_penerbit" name="id_penerbit">
                  <option selected>Pilih Penerbit</option>
                  @foreach($penerbits as $penerbit)
                  <option value="{{ $penerbit->id }}">{{ $penerbit->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="id_kategori">Kategori :</label>
                <select class="form-control" id="id_kategori" name="id_kategori">
                  <option selected>Pilih Kategori</option>
                  @foreach($kategoris as $kategori)
                  <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="sinopsis">Sinopsis :</label>
                <textarea class="form-control  @error('sinopsis') is-invalid @enderror" style="height:150px" name="sinopsis" value="{{ old('sinopsis') }}" placeholder=""></textarea>
                @error('sinopsis')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="jumlah">Jumlah :</label>
                <input type="text" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" placeholder="Enter jumlah buku">
                @error('jumlah')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="sampul">Sampul :</label>
                <input type="file" class="form-control @error('sampul') is-invalid @enderror" id="sampul" name="sampul" value="{{ old('sampul') }}">
                @error('sampul')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="card-footer">
              <a href="{{ route('buku_index') }}" class="btn btn-info">Back</a>
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