@extends ('dashboard')
@section('page-style-files')
<style>
	.panel-body{
		width: 100%;
		box-sizing: 50px;
		word-wrap: break-word;
}
</style>
@endsection
@section('action-content')

<div class="page-wrapper">
    <div class="content container-fluid">
		<div class="row">

			<div class="col-md-12">
				<div class="container" style="background-color: white;">
					<h2 style="text-align: center;"> Notice Board</h2>
						<div class="row">
							<div class="col-md-9 m-b-20">
								<img src="/img/snow.png" style="width: 150px; ">
									<ul class="list-unstyled" style="margin-left: 30px;">
										<li>Snow Flake</li>
										<li>Yangon</li>
										<li>Web Developement</li>
									</ul>
								</div>
						<div class="col-md-3 m-b-15">
							<div class="invoice-details">
								<h3 class="text-uppercase"> #00{{$posts->id}}</h3>
									<ul class="list-unstyled">
										<li>Created date : <span> {{ $posts->created_at}}</span></li>
									</ul>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12 m-b-20">
								<div class="panel-body" style="">
								<p>{{$posts->description}}</p>
	                          	</div>
							</div>
						</div>
						<div class="row" style="float: right;">
							<div class="col-lg-12 m-b-20">
								<div class="panel-body" style="	text-align: center;">
								<p>{{$posts->author}}</p>
								<p>Manager</p>
								<p>IT Department</p>
	                          	</div>
							</div>
						</div>
					
					</div>
				</div>
           </div>
       </div>
   </div>

@endsection




              