<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Employee Management</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{ asset('css/admindashboard.css') }}"> 
  <link rel="stylesheet" href="{{ asset('css/dataTables.css') }}"> 
  

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Main Header  -->
      @include('layouts.header')
     
      <!-- Sidebar -->
       @include('layouts.sidebar')
       
  <!-- Content Wrapper. Contains page content -->
         @yield ('content')
  <!-- /.content-wrapper -->

  <!-- Footer -->
  @include ('layouts.footer')

</div>
<script type="text/javascript" src="{{ asset('js/admindashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.js') }}"></script>
@stack('scripts')
<script>
  $(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.inline-block').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".upload").on('change', function(){
        readURL(this);
    });
    
    $(".btn-text").on('click', function() {
       $(".upload").click();
    });
});
</script>

</body>
</html>