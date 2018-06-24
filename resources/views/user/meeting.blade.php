@extends('user.layouts.app')

@section('mainpanel')
<div class="msf-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 msf-form">

				<form action="{{ route('vote.add.submit') }}" class="form-inline meetingForm">

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<fieldset>
						<h4>Introduction <span class="step">(Step 1 / 3)</span></h4>

						<div class="container">
							<div class="row">
								
								<div class="jumbotron">
									<div class="col-md-12">

										<img class="Meeting__logo" src="{{ $meeting_master->logo }}" alt="company logo">
										<h1 class="display-4">{{ $meeting_master->title }}</h1>
										<hr class="my-4">

										<p>Date: {{ $meeting_master->date_of_meeting->format('jS F, Y') }}</p>
										<p>Location: {{ $meeting_master->location }}</p>
										<p>Time: {{ $meeting_master->date_of_meeting->format('g:i a') }}</p>
										
										<hr class="my-4">
										<p>{!! $meeting_master->content !!}</p>
										<a class="btn btn-primary btn-lg btn-next" href="#" role="button">Start Now</a>
									</div>
								</div>

							</div>
						</div>

						<br>
						<button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
					</fieldset>

					<fieldset>
						<h4>Place and Date of Birth <span class="step">(Step 2 / 3)</span></h4>

						<div class="container">

							<div class="py-2 px-2 mb-1">
								<div class="row">
									<div class="col-md-6">
										<div class="table-responsive">
											<table class="table VoterDetail__table">
												<tbody class="">
													<tr class="ObjectRecord">
														<th class="tr_header">
															Name
														</th>
														<td class="">
															{{ $voterinfo->number_of_share }}
														</td>
													</tr>
													<tr class="ObjectRecord">
														<th class="tr_header">
															Address
														</th>
														
														<td class="text-body">
															@foreach ($addresses as $address)
															{{ $address }}	
															@endforeach
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>

									<div class="col-md-6">
										<div class="table-responsive">
											<table class="table MeetingEntry__table">
												<tbody class="">
													<tr class="ObjectRecord">
														<th class="tr_header">
															HIN/SRN
														</th>
														<td class="">
															{{ $voterinfo->username }}
															<input type="hidden" name="username" value="{{ $voterinfo->username }}">
														</td>
													</tr>
													<tr class="ObjectRecord">
														<th class="tr_header">
															Meeting ID
														</th>
														<td class="">
															{{ $meeting_master->meeting_uuid }}
															<input type="hidden" name="meeting_uuid" value="{{ $meeting_master->meeting_uuid }}">
														</td>
													</tr>
													<tr class="ObjectRecord">
														<th class="tr_header">
															Number of shares
														</th>
														<td class="">
															{{ $voterinfo->number_of_share }}
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>

								</div>
							</div>

							<div class="row">

								<div class="col-md-6">
									<div class="jumbotron">

										<h1 class="display-4">Proxy</h1>
										<hr class="my-4">
										<!-- <div class="proxySelectionWrapper"> -->
											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="customControlValidation2" name="proxy" value="isAppointed">
												<label class="custom-control-label" for="customControlValidation2">Appointing to Chairman of the meeting.</label>
											</div>

											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input " id="customControlValidation3" name="proxy" value="proxyName">
												<label class="custom-control-label" for="customControlValidation3">Appointing to Proxy of the meeting.</label>
												<div class="proxyNameWrapper">
													<input type="text" class="form-control" name="proxyName">
												</div>
											</div>
											<!-- </div> -->

											<div class="content text-justify mt-3">
												<p class="text-body mt-3">
													Falling the individual or body corporate named, or if no individual or body corporate is named, the Chairman of the Meeting as my/our proxy is to act generally at the meeting on my/our behalf and to vote in accordance with the following directions, of if no directions have been given, as the proxy sees fit at the general meeting of (company name) to be held on (date of the meeting) and at any document of that meeting.
												</p>
												<p class="mt-3 text-body">
													<strong class="bg-warning p-1 mb-1 text-dark text-uppercase font-weight-bold"> Important Note:</strong> If the Chairman of the Meeting is (or becomes) your proxy, you can direct the chairman to vote for or against or abstain from voting on each resolution by marking the appropriate box below under voting directions.
													In the absence of any specific direction, the Chairman of the meeting intents to vote all proxies in favour of each item of business.
												</p>
												<p class="text-body">
													<strong class="bg-danger p-1 mb-1 text-dark text-uppercase font-weight-bold">Please Note:</strong> All undirected proxies received by the Chairman of the meeting will be voted either in favour/against for each resolution.
												</p>
											</div>
										</div>
									</div>

									<div class="col-md-6">
										<div class="jumbotron">
											<h1 class="display-4">Resolution</h1>
											<hr class="my-4 pt-3">

											@if ($role == "NOMINEE")
											@foreach ($resolutions as $index => $resolution)
											<div class="resoultionQuestionWrapper">
												<p class="p-3 mb-2 bg-dark text-white ">
													{{ $resolution }}
												</p>
												<div class="mb-2 resoultionRadioWrapper">
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="resolutionId1_{{ $index }}" name="resolutionRadio_{{ $index }}" class="custom-control-input" value="for">
														<label class="custom-control-label pl-4" for="resolutionId1_{{ $index }}">
														For</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="resolutionId2_{{ $index }}" name="resolutionRadio_{{ $index }}" class="custom-control-input" value="against">
														<label class="custom-control-label pl-4" for="resolutionId2_{{ $index }}">Against</label>
													</div>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="radio" id="resolutionId3_{{ $index }}" name="resolutionRadio_{{ $index }}" class="custom-control-input" value="obstain">
														<label class="custom-control-label pl-4" for="resolutionId3_{{ $index }}">Abstain</label>
													</div>
												</div>
											</div>


											@endforeach
											@else
											@foreach ($resolutions as $resolution)
											<div class="p-3 mb-2 bg-light text-dark">{{ $resolution }}</div>
											<div class="p-3 mb-2 bg-danger text-dark"></div>
											@endforeach
											@endif
										</div>
									</div>

								</div>
							</div>

							<br>
							<button type="button" class="btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
							<button type="button" class="btn btn-next">Next <i class="fa fa-angle-right"></i></button>
						</fieldset>


						<fieldset>
							<h4>Voting Summary <span class="step">(Step 3 / 3)</span></h4>

							<div class="container">
								<div class="row">

									<div class="jumbotron">
										<div class="col-md-12">
											<h1>Email: </h1>
										</div>
									</div>

								</div>
							</div>

							<br>
							<button type="button" class=" btn btn-previous"><i class="fa fa-angle-left"></i> Previous</button>
							<button type="submit" class="meetingFormBtn btn">Submit</button>
						</fieldset>

					</form>

				</div>
			</div>
		</div>
	</div>
	@endsection

	@section('execute_script')
	<script>
		jQuery(document).ready(function() {

	/*
		Multi Step Form
		*/
		var form = $('.msf-form form fieldset');
		$(form[0]).fadeIn();

	// next step
	$('.msf-form form .btn-next').on('click', function() {
		$(this).parents('fieldset').fadeOut(400, function() {
			$(this).next().fadeIn();
			DP.utils.scroll_to_class('.msf-form');
		});
	});
	
	// previous step
	$('.msf-form form .btn-previous').on('click', function() {
		console.log('pre clicked');
		$(this).parents('fieldset').fadeOut(400, function() {
			$(this).prev().fadeIn();
			DP.utils.scroll_to_class('.msf-form');
		});
	});

	// meetingFormBtn handler
	// $('.meetingForm').on('submit', DP.main.meetingFormSubmitHandler);

	// Proxy appoiting feature
	
	

	// 
});
</script>
@endsection
