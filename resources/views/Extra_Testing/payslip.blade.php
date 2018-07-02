@extends ('dashboard')

@section('action-content')
	<link href="/css/print.css" rel="stylesheet" media="print" type="text/css">
<div class="page-wrapper">
    <div class="content container-fluid">
		<div class="row">
			<div id="buttons" class="pull-right"></div>
				<div class="col-xs-8">
					<h2>Payslip</h2>
				</div>
			<div class="col-sm-4 text-right m-b-30">
				<div class="btn-group btn-group-sm">					
							<i class="fa fa-print fa-lg"></i> Print </a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="container" style="background-color: white;">
							<h3 style="text-align: center;">Payslip for the month of {{\Carbon\Carbon::now()->format('F, Y')}}</h3>
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
								<h3 class="text-uppercase">Payslip #00345</h3>
									<ul class="list-unstyled">
										<li>Salary Month: <span>{{\Carbon\Carbon::now()->format('jS \\ F, Y')}}</span></li>
									</ul>
								</div>
							</div>
						</div><br>
						<div class="row">
							<div class="col-lg-12 m-b-20">
								<ul class="list-unstyled">
						 			
										<li><h4 class="m-b-0"><strong>
											Name: Dummy Name  
                                		</strong></h4></li>	                           	
										<li><h4>Department : Dummy Department </h4></li>
										<li><h4>Designation : Dummy Designation </h4></li>
										</ul>
									</div>
								</div>
					<div class="row">
						<div class="col-sm-6">
							<div>
								<h4 class="m-b-10"><strong>Earnings</strong></h4>
									<table class="table table-bordered">
										<tbody>
											<tr>
												<td>
												<strong>Basic Salary</strong> <span class="pull-right">
													1000000
												</span> 
												</td>
											</tr>
											<tr>
												<td><strong> Over-Time </strong> <span class="pull-right">Yes</span>
												</td>
											</tr>		
											<tr>
												<td>
													<strong> Hours </strong> 
													<span class="pull-right">
														2hours
													</span>
												</td>
											</tr>		
													
													
											<tr>
												<td>
												<strong> Pay Rate </strong> 
													<span class="pull-right">
													5000
													</span>
												</td>
											</tr>
											<tr>
												<td>
												<strong>Total Earnings</strong> 
												<span class="pull-right">
												<strong>1010000</strong>
												</span>
												</td>
											</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-sm-6">
										<div>
											<h4 class="m-b-10"><strong>Deductions</strong></h4>
											<table class="table table-bordered">
												<tbody>
													<tr>
														<td><strong>Late</strong> <span class="pull-right">$0</span></td>
													</tr>
													<tr>
														<td><strong>Provident Fund</strong> <span class="pull-right">$0</span></td>
													</tr>

													<tr>
														<td><strong>Loan</strong> <span class="pull-right">$0</span></td>
													</tr>
													<tr>
													<td><strong>Total Deductions</strong> <span class="pull-right"><strong>$0</strong></span></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-md-12">
					
								</div>
							</div>
						</div>
					</div>
				</div>
               </div>
           @endsection




              