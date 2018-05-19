@extends('admin.layouts.app')

@section('style')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('head')
	@parent
@endsection

@section('mainpanel')
	
	<div class="msf-container">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 msf-form">

					<form method="POST" action="meeting" >
						<!-- @csrf -->
						@csrf
						<fieldset>

							<h4>Introduction <span class="step">(Step 1 / 3)</span></h4>

							<div class="container">
								<div class="row">

									<div class="col">
										<div class="jumbotron">

											<img 
											src="http://dfat.gov.au/about-us/corporate/PublishingImages/australian-government-stacked-black.png" 
											width=""
											height="" 
											class="d-inline-block align-top" 
											alt=""
											/>
											<hr class="my-4">

											<h1 class="display-10">WELCOME TO CEDAR WOODS PROPERS TIES LIMITED AGM ONLINE VOTING PORTAL</h1>
											<br><br>
											<div class="row">
												<div class="col">
													<h4>Meeting Details</h4>
													<table class="table table-dark">    
														<tbody>
															<tr>
																<th>Date</th>
																<td >Mark</td>
															</tr>
															<tr>
																<th >Location</th>
																<td >Jacob</td>
															</tr>
															<tr>
																<th >Time</th>
																<td >Larry the Bird</td>
															</tr>
														</tbody>
													</table>
												</div>
												<div class="col">
													<h4>Attached Documents</h4>
													<table class="table table-dark">    
														<tbody>
															<tr>
																<td>Reporting</td>
															</tr>
															<tr>
																<td >Financial Report</td>
															</tr>
															<tr>
																<td >Balancesheet</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
											<br><br>
											<div>
												<h5>YOUR RESPONSES ARE CONFIDENTIAL</h5>
												<p>The responses to the voting is completely confidential. They are stored securely and only use to analyse the votes against each resolution.</p>
											</div>
											<div class="instruction">
												<h5>INSTRUCTION</h5>
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
													tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
													quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
													consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
													cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
												proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
											</div>
											<button type="button" class="btn btn-success btn-lg btn-block btn-next">Next <i class="fa fa-angle-right"></i></button>
										</div>
									</div>
								</div>
							</div>
						</fieldset>

						<fieldset>
							<h4>Voting Portal<span class="step">(Step 2 / 3)</span></h4>

							<div class="container">
								<div class="row">

									<div class="col-md-12">
										<div class="jumbotron">
											<h1 class="display-4">Resolution</h1>
											<div class="d-flex justify-content-between">
												<table class="table">    
													<tbody>
														<tr>
															<th>@{{ Name }}</th>
														</tr>
														<tr>
															<th>@{{ Address }}</th>
														</tr>
													</tbody>
												</table>

												<table class="table table-borderless">    
													<tbody>
														<tr>
															<th>@{{ Name }}</th>
														</tr>
														<tr>
															<th>@{{ Meeting ID }}</th>
														</tr>
														<tr>
															<th>@{{ Number of shares }}</th>
														</tr>
													</tbody>
												</table>

											</div>
										</div>
									</div>

									<div class="col">
										<div class="jumbotron ">
											<h1 class="display-4">Appointment of Proxy</h1>
											<div class="align-items-start">
												<input type="radio" name="chairman">
												Appointing to Chairman of the meeting
											</div>
											<div>
												<input type="radio" name="proxyname">
												Proxy Name
											</div>
										</div>
									</div>

									<div class="col">
										<div class="jumbotron">
											<h1 class="display-4">Resolution</h1>
											<div>
												<p>Re-election director</p>
											</div>
										</div>
									</div>

								</div>
							</div>

							<br>
							<button type="button" class="btn btn-previous btn-lg btn-secondary"><i class="fa fa-angle-left"></i> Previous</button>
							<button type="button" class="btn btn-next btn-lg btn-success">Next <i class="fa fa-angle-right"></i></button>
						</fieldset>

						<fieldset>
							<h4>Summary <span class="step">(Step 3 / 3)</span></h4>

							<h1>Finish to submit the vote!!</h1>

							<br>
							<button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
							<button type="submit" class="btn">Submit</button>
						</fieldset>

					</form>

				</div>
			</div>
		</div>
	</div>

@endsection

@section('sidebar')
@include('admin/partials/sidebar')
@endsection