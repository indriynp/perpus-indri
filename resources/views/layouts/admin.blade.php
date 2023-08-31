<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <!-- icon bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- My Style -->
  <link rel="stylesheet" href="{{url('/css/style.css')}}">

  <title>Perpus</title>

  @include('includes.style')


</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    @include('includes.header')

    @include('includes.sidebar')
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          @yield('content')
        </div>
        
      </div> 

    </div>

    <!-- /.content -->
    <!-- /.content-wrapper -->
    @include('includes.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>


    <!-- /.control-sidebar -->
  </div>
</body>
</html>