<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<link href="/css/print.css" rel="stylesheet" media="print" type="text/css">
	<link rel="stylesheet" href="{{ asset('css/admindashboard.css') }}"> 
	<title>Print</title>
</head>
<body>
	<div class="page-wrapper">
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="container" style="background-color: white;">
								<h3 style="text-align: center;">Payslip for the month of {{\Carbon\Carbon::now()->format('F, Y')}}</h3>
								<div class="row">
									<div class="col-md-6 m-b-20">
										<img src="/img/snow.png" style="width: 150px; ">
										<ul class="list-unstyled m-b-0">
											<li>Snow Flake</li>
											<li>Yangon</li>
											<li>Web Developement</li>
										</ul>
									</div>
									<div class="col-md-6 m-b-15" style="float: right;>
										<div class="invoice-details">
											<h3 class="text-uppercase">Payslip #49029</h3>
											<ul class="list-unstyled">
												<li>Salary Month: <span>{{\Carbon\Carbon::now()->format('jS \\ F, Y')}}</span></li>
											</ul>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 m-b-20">
										<ul class="list-unstyled">
										
										@foreach($employees as $employee)
										<li><h5 class="m-b-0"><strong>
											Name:  {{ $employee->name }}
										</strong></h5></li>	
										<li><span>Department : {{ $employee->department_name }}</span></li>
										<li><span>Designation : {{ $employee->designation_name }}</span></li>
										<li>{{ $employee->joined }}</li>
										@endforeach
											
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
														<td><strong>Basic Salary</strong> <span class="pull-right">$6500</span></td>
													</tr>
													<tr>
														<td><strong>House Rent Allowance (H.R.A.)</strong> <span class="pull-right">$55</span></td>
													</tr>
													<tr>
														<td><strong>Conveyance</strong> <span class="pull-right">$55</span></td>
													</tr>
													<tr>
														<td><strong>Other Allowance</strong> <span class="pull-right">$55</span></td>
													</tr>
													<tr>
														<td><strong>Total Earnings</strong> <span class="pull-right"><strong>$55</strong></span></td>
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
														<td><strong>Tax Deducted at Source (T.D.S.)</strong> <span class="pull-right">$0</span></td>
													</tr>
													<tr>
														<td><strong>Provident Fund</strong> <span class="pull-right">$0</span></td>
													</tr>
													<tr>
														<td><strong>ESI</strong> <span class="pull-right">$0</span></td>
													</tr>
													<tr>
														<td><strong>Loan</strong> <span class="pull-right">$300</span></td>
													</tr>
													<tr>
														<td><strong>Total Deductions</strong> <span class="pull-right"><strong>$59698</strong></span></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-md-12">
										<p><strong>Net Salary: $59698</strong> (Fifty nine thousand six hundred and ninety eight only.)</p>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
		

    <script type="text/javascript" src="{{ asset('js/admindashboard.js') }}"></script>
    <script>
		window.onload = function(){
			window.print();
		}
	</script>
</body>
</html>