@extends ('layouts.main')

@section ('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <section class="content">
        <div class="container">
          

		      @yield('action-content')
          
        </div>

		</section>
  </section>
</div>

@endsection