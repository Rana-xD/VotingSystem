@extends('user.layouts.app')

@section('mainpanel')
<div class="msf-container">
	<input type="hidden" id="resolution" value="{{ json_encode($resolutions,TRUE) }}">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 msf-form">

				<form action="{{ route('vote.add.submit') }}" class="form-inline meetingForm">

					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" id="vote" name="vote">
					<fieldset class="step-1">
						<h4>Introduction <span class="step">(Step 1 / 3)</span></h4>

						<div class="container">
							<div class="row">
								
								<div class="introduction jumbotron custom-box-shadow-small bg-white">
									<div class="col-md-12">

										<img class="Meeting__logo" src="{{ $meeting_master->logo }}" alt="company logo">
										<h1 class="display-4">{{ $meeting_master->title }}</h1>
										<hr class="my-4">

										<p>Date: {{ $meeting_master->date_of_meeting->format('jS F, Y') }}</p>
										<p>Location: {{ $meeting_master->location }}</p>
										<p>Time: {{ $meeting_master->date_of_meeting->format('g:i a') }}</p>
										
										<hr class="my-4">

										<div class="Meeting__content">
											<div class="Meeting__content-title">
												<h3>Introduction</h3>
											</div>
											{!! $meeting_master->content !!}
										</div>
										
										<div class="Meeting__document pt-3">
											<div class="Meeting__doc-title">
												<h3>Reference Documents</h3>
											</div>
											<input type="hidden" id="documentHiddenInput" name="document" @if(isset($meeting_master->document) && !empty($meeting_master->document)) value="{{$meeting_master->document}}" @endif>
											<div id="documentUploadPreviewDiv" class="pt-3"></div>
										</div>
										<div class="pt-5">
											<a class="btn btn-primary btn-lg btn-next" href="#" role="button">Start Now</a>
										</div>
									</div>
								</div>

							</div>
						</div>
					</fieldset>

					<fieldset class="step-2">
						<h4>Place and Date of Birth <span class="step">(Step 2 / 3)</span></h4>

						<div class="container-fluid">

							<div class="VoterInfo py-2 px-2 mb-1">
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
													@foreach ($addresses as $index => $address)
													<tr class="ObjectRecord">
														<th class="tr_header">
															Address{{ $index+1 }}
														</th>
														<td class="text-body">
															{{ $address }}
														</td>
													</tr>
													@endforeach
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

							<div class="row meetingForm__proxy">
								<div class="col-md-6 Proxy__col">
									<div class="jumbotron custom-box-shadow-small bg-white Proxy__card">
										<h1 class="display-4">Proxy</h1>
										<hr class="my-4">
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="customControlValidation2" name="proxy" value="1" checked>
											<label class="flex_label custom-control-label" for="customControlValidation2">Appointing to Chairman of the meeting.</label>
										</div>

										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input proxyname_radio" id="customControlValidation3" name="proxy" value="0">
											<label class="flex_label custom-control-label" for="customControlValidation3">Appointing to Proxy of the meeting.</label>
											<div class="proxyNameWrapper">
												<input type="text" class="hide form-control ProxyName__input" name="proxyName" placeholder="Proxy Name">
											</div>
										</div>

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

								<div class="ResolutionBox col-md-6 Proxy__col">
									<div class="jumbotron custom-box-shadow-small bg-white Proxy__card">
										<h1 class="display-4">Resolution</h1>
										<hr class="my-4 pt-3">
										
										@if ($role == "SHARE_HOLDER")
										@foreach (array_slice($resolutions,0,4) as $index => $resolution)
										<div class="resoultionQuestionWrapper">
											<p class="p-3 mb-2 bg-dark text-white ">
												{{ $resolution }}
											</p>
											<div class="mb-2 resoultionRadioWrapper">
												<div class="resolutionRadioContainer custom-control custom-radio custom-control-inline">
													<input type="radio" id="resolutionId1_{{ $index }}" name="resolutionRadio_{{ $index }}" class="custom-control-input resolutionFor resolutionChoiceInput" value="for" data-answer-selector="#resolutionAnswerTerm{{ $index }}">
													<label class="custom-control-label pl-4" for="resolutionId1_{{ $index }}">
													For</label>
												</div>
												<div class="resolutionRadioContainer custom-control custom-radio custom-control-inline">
													<input type="radio" id="resolutionId2_{{ $index }}" name="resolutionRadio_{{ $index }}" class="custom-control-input resolutionAgaint resolutionChoiceInput" value="against" data-answer-selector="#resolutionAnswerTerm{{ $index }}">
													<label class="custom-control-label pl-4" for="resolutionId2_{{ $index }}">Against</label>
												</div>
												<div class="resolutionRadioContainer custom-control custom-radio custom-control-inline">
													<input type="radio" id="resolutionId3_{{ $index }}" name="resolutionRadio_{{ $index }}" class="custom-control-input resolutionAbstain resolutionChoiceInput" value="abstain" data-answer-selector="#resolutionAnswerTerm{{ $index }}">
													<label class="custom-control-label pl-4" for="resolutionId3_{{ $index }}">Abstain</label>
												</div>
												<div class="resolutionRadioContainer custom-control custom-radio custom-control-inline" hidden>
													<input type="radio" id="resolutionId4_{{ $index }}" name="resolutionRadio_{{ $index }}" class="custom-control-input resolutionOpenVote resolutionChoiceInput" value="OpenVote" data-answer-selector="#resolutionAnswerTerm{{ $index }}" checked>
													<label class="custom-control-label pl-4" for="resolutionId4_{{ $index }}">OpenVote</label>
												</div>
											</div>
										</div>
										@endforeach
										@else
										
										{{-- <div class="p-3 mb-2 bg-light text-dark">{{ $resolution }}</div> --}}
										<div class="p-3 mb-2">
											<table class="table resolutionForNomineeTable">
												<thead>
													<tr>
														<th scope="col"></th>
														<th scope="col">For</th>
														<th scope="col">Against</th>
														<th scope="col">Abstain</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($resolutions as $index => $resolution)
													<tr>
														<th scope="row">{{ $resolution }}</th>
														<td>
															<input type="checkbox" name="">

														</td>
														<td>
															<input type="checkbox" name="">
															
														</td>
														<td>
															<input type="checkbox" name="">
															
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>

										@endif
									</div>
								</div>
							</div>

							<br>
							<button type="button" class="btn btn-previous">
								<i class="fa fa-angle-left"></i> Previous
							</button>
							<button type="button" class="btn btn-next">
								Next <i class="fa fa-angle-right"></i>
							</button>
						</div>
					</fieldset>


					<fieldset class="step-3">
						<h4>Voting Summary <span class="step">(Step 3 / 3)</span></h4>

						<div class="container">

							<div class="VoterInfo py-2 px-2 mb-1">
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
													@foreach ($addresses as $index => $address)
													<tr class="ObjectRecord">
														<th class="tr_header">
															Address{{ $index+1 }}
														</th>
														<td class="text-body">
															{{ $address }}
														</td>
													</tr>
													@endforeach
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
								<div class="summaryWrapper jumbotron custom-box-shadow-small bg-white">
									<div class="">
										<h1>Vote Summary </h1>
										<hr>
										@if($role == 'NOMINEE')
										@foreach ($resolutions as $index => $resolution)
										<div class="border-bottom">
											<p class="p-3 mb-2 text-white text-left bg-dark">
												{{ $resolution }}
											</p>
											<p class="p-3 mb-2 text-black text-left">
												Answer: 
												<span class="resolutionAnswerTerm" id="resolutionAnswerTerm{{$index}}"></span>
											</p>
										</div>
										@endforeach
										@else
										@foreach ($resolutions as $index => $resolution)
										<div class="border-bottom">
											<p class="p-3 mb-2 text-white text-left bg-dark">
												{{ $resolution }}
											</p>
											<p class="p-3 mb-2 text-black text-left">
												Answer: 
												<span class="resolutionAnswerTerm" id="resolutionAnswerTerm{{$index}}"></span>
												<span class="resolutionShareAmountAnswer" id="resolutionShareAmountAnswer{{$index}}"></span>
											</p>
										</div>
										@endforeach
										@endif
									</div>

									<div class="promteEmail mt-4 text-left">
										<span>
											Ecomms Approval: <input type="checkbox" name="dontNotify" class="emailNotifyFalse" checked>
										</span>	
										<span class="ml-4">
											Email:  <input type="email" name="voterEmail" class="voterEmail" required autofocus="true">
										</span>
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

@section('include_script')
<script src="{{ asset('js/normal_user.js') }}" type="text/javascript" charset="utf-8"></script>
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
		$('.meetingForm').on('submit', DP.main.meetingFormSubmitHandler);

		// Proxy appoiting feature
		$('input[name="proxy"]').on('change', DP.main.toggleVisibilityProxyNameInput);

		// remove form-control from input in resolutionForNomineeTable
		//$('.resolutionForNomineeTable tbody input').removeClass('form-control');

		// voterEmail promte handler
		$('.emailNotifyFalse').on('change', DP.main.emailNotifyFalseOnchange);

		/**
		 * Append document to UI
		 */
		 DP.main.appendDocumentToUserUI();

		/**
		 * Bind on change event on resolution choice input
		 */
		$(".resolutionChoiceInput").on("change", DP.main.onResolutionChoiceChangeHandler);

		// Initial resolutionChoiceInput to OpenVote.
		$('.resolutionChoiceInput').trigger('change');

		});
	</script>
	@endsection
