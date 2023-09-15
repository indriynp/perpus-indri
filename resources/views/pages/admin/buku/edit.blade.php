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
            <h3 class="card-title">Rubah Data</h3>
          </div>

          <div class="card-body">
            <form action="{{ route('buku_update', $item->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="nama">Nama Buku</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama buku" value="{{ $item->nama }}">
              </div>
              <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" placeholder="Enter tahun terbit" value="{{ $item->tahun_terbit }}">
              </div>
              <div class="form-group">
                <label for="id_penulis">Penulis</label>
                <select class="form-control" id="id_penulis" name="id_penulis" class="form-control">
                  <option value="">Penulis</option>
                  @foreach($penulis as $pen)
                  <option value="{{ $pen->id }}" {{ $pen->id == $item->id_penulis ? 'selected' : '' }}>{{ $pen->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="id_penerbit">Penerbit</label>
                <select class="form-control" id="id_penerbit" name="id_penerbit" class="form-control">
                  <option value="">Pilih Penerbit</option>
                  @foreach($penerbits as $penerbit)
                  <option value="{{ $penerbit->id }}" {{ $penerbit->id == $item->id_penerbit ? 'selected' : '' }}>{{ $penerbit->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="id_kategori">Kategori</label>
                <select class="form-control" id="id_kategori" name="id_kategori" class="form-control">
                  <option value="">Pilih Kategori</option>
                  @foreach($kategoris as $kategori)
                  <option value="{{ $kategori->id }}" {{ $kategori->id == $item->id_kategori ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="sinopsis">Sinopsis</label>
                <textarea class="form-control" style="height:150px" id="sinopsis" name="sinopsis">{{ @$item->sinopsis }}</textarea>
              </div>
               <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Enter penerbit" value="{{ $item->jumlah }}">
              </div>
              <div class="form-group">
                <label for="sampul">Sampul</label>
                <input type="file" class="form-control" id="sampul" name="sampul" value="{{ $item->sampul }}">
                <img src="{{ asset('storage/'.$item->sampul) }}" style="width: 115px;">
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