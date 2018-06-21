@extends ('layouts.main')

@section ('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <section class="content">
        <div class="container">
          @if(session()->has('message'))
       		<div class="row">
            <div id="hide" class="alert alert-success alert-dismissible alert-important" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
                
              <strong>Notification</strong> {{ session()->get('message')}}
            </div>
              
            @endif
            @if(session()->has('danger'))
          
            <div id="hide" class="alert alert-danger alert-dismissible alert-important" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
                
              <strong>Notification</strong> {{ session()->get('danger')}}
            </div>
              
            @endif

		      @yield('action-content')
          
		      </div>
		  	</div>

		</section>
    </section>
</div>
<script>
  $("#hide").ready(function(){
    setTimeout(function(){
        $("div.alert").remove();
    }, 5000 ); // 5 secs

});
</script>

@endsection