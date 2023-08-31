@extends('layouts.admin')

@section('content')




<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Rubah Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <form action="{{ url('/buku/update') }}" method="post">
                    @method('put')
                    @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">No</label>
                    <input type="text" class="form-control" id="no" placeholder="Enter no">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Judul Buku</label>
                    <input type="text" class="form-control" id="judul_buku" placeholder="Enter judul buku">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tahun Terbit</label>
                    <input type="text" class="form-control" id="tahun_terbit" placeholder="Enter tahun terbit">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Penulis</label>
                    <input type="text" class="form-control" id="penulis" placeholder="Enter penulis">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit" placeholder="Enter Penerbit">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Kategori</label>
                    <input type="text" class="form-control" id="kategori" placeholder="Enter kategori">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sinopsis</label>
                    <input type="text" class="form-control" id="sinopsis" placeholder="Enter sinopsis">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sampul</label>
                    <input type="text" class="form-control" id="sampul" placeholder="Enter sampul">
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
              </form>
            </div>
            <!-- /.card -->

            

    @endsection