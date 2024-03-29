@extends('admin.layouts.app')

@section('mainpanel')

<div class="container">
	<div class="content AddMeeting">
		<div class="">
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-header card-header-primary">
							<h4 class="card-title">Detail Meeting</h4>
							<input type="hidden" id="meeting_uuid" name="meeting_uuid" value="{{ $meeting->meeting_uuid }}">
							<p class="card-category">Register a meeting for client</p>
						</div>
						<div class="card-body">
							@if ( isset($meeting) && $meeting->count() > 0 )
							<form class="custom-form EditMeeting__form" id="EditMeeting__form" action="{{ route('meeting.edit.submit', ['uuid' => $meeting->meeting_uuid]) }}">
								<div class="row">
									<div class="col-12 col-md-8">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="AddMeeting__label">Title</label>
													<input name="title" type="text" class="AddMeeting__input text form-control" value="{{ $meeting->title }}">
												</div>
											</div>
											<div class="col-md-12">
												<div data-error-for="title" class="AddMeeting__status-message status-message error">
													@if ($errors->has('title'))
													<span class="invalid-form-validation text-small">
														{{ $errors->first('title') }}
													</span>
													@endif
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="AddMeeting__label">Company Name</label>
													<input type="text" name="company_name" class="AddMeeting__input text form-control" value="{{ isset($meeting->company_name) ? $meeting->company_name : __('Unknown') }}">
												</div>
											</div>
											<div class="col-md-12">
												<div data-error-for="company_name" class="AddMeeting__status-message status-message error">
													@if ($errors->has('company_name'))
													<span class="invalid-form-validation text-small">
														{{ $errors->first('company_name') }}
													</span>
													@endif
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="AddMeeting__label">Meeting's Date</label>
													<input id="meetingDate" type='date' class="AddMeeting__input date form-control" value="{{ isset($meeting->date_of_meeting) ? $meeting->date_of_meeting->format('Y-m-d') : __('---') }}"/>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="AddMeeting__label">Meeting's Time</label>
													<input id="meetingTime" type='time' class="AddMeeting__input time form-control" value="{{ isset($meeting->date_of_meeting) ? $meeting->date_of_meeting->format('H:i') : __('--') }}"/>
												</div>
											</div>
											<div class="col-md-12">
												<div data-error-for="date_of_meeting" class="AddMeeting__status-message status-message error">
													@if ($errors->has('date_of_meeting'))
													<span class="invalid-form-validation text-small">
														{{ $errors->first('date_of_meeting') }}
													</span>
													@endif
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="AddMeeting__label">Close Voting Date</label>
													<input id="meetingCloseDate" type='date' class="AddMeeting__input date form-control" value="{{ isset($meeting->date_of_meeting) ? $meeting->expired_date->format('Y-m-d') : __('--') }}"/>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="AddMeeting__label">Close Voting Time</label>
													<input id="meetingCloseTime" type='time' class="AddMeeting__input time form-control" value="{{ isset($meeting->date_of_meeting) ? $meeting->expired_date->format('H:i') : __('--') }}"/>
												</div>
											</div>
											<div class="col-md-12">
												<div data-error-for="expired_date" class="AddMeeting__status-message status-message error">
													@if ($errors->has('expired_date'))
													<span class="invalid-form-validation text-small">
														{{ $errors->first('expired_date') }}
													</span>
													@endif
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="AddMeeting__label">Location</label>
													<input type="text" name="location" class="AddMeeting__input text form-control" value="{{ isset($meeting->location) ? $meeting->location : __('Unknown') }}">
												</div>
											</div>
											<div class="col-md-12">
												<div data-error-for="location" class="AddMeeting__status-message status-message error">
													@if ($errors->has('location'))
													<span class="invalid-form-validation text-small">
														{{ $errors->first('location') }}
													</span>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-md-4">
										<div class="row">
											<div class="col-md-12">
												<div class="text-center">
													<button class="custom-btn btn btn-default uploadFile" data-type="image">
														Upload Company Logo
													</button>
													<input type="hidden" id="txtFeaturedImage" name="logo" value="{{ $meeting->logo }}">
												</div>
											</div>
											<div class="col-md-12">
												<div id="imagePreviewDiv">
												@if(isset($meeting->logo) && !empty($meeting->logo))
													<img src="{{ asset($meeting->logo) }}" style="width:100%; margin-bottom:10px;">
												@endif
												</div>
											</div>
											<div class="col-md-12">
												<div data-error-for="logo" class="AddMeeting__status-message status-message error">
													@if ($errors->has('logo'))
													<span class="invalid-form-validation text-small">
														{{ $errors->first('logo') }}
													</span>
													@endif
												</div>
											</div>
										</div>

										
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="AddMeeting__label">Introduction</label>
											<div class="form-group">
												<textarea name="content" class="richTextBox form-control AddMeeting__input textarea" rows="5" >
													{{ isset( $meeting->content) ? $meeting->content : __('Unknown') }}
												</textarea>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div data-error-for="content" class="AddMeeting__status-message status-message error">
											@if ($errors->has('content'))
											<span class="invalid-feedback uk-text-small">
												{{ $errors->first('content') }}
											</span>
											@endif
										</div>
									</div>
								</div>

								<div class="container">
									<div class="card">
										<div class="card-body">
											<!-- Document upload -->
											<div class="row">
												<div class="col-md-12">
													<div class="text-left">
														<button class="custom-btn btn btn-default uploadFile" data-type="document">
															Upload Document
														</button>
														<input type="hidden" id="txtMultiDocument">
														<input type="hidden" id="documentHiddenInput" name="document" @if(isset($meeting->document) && !empty($meeting->document)) value="{{$meeting->document}}" @endif>
													</div>
												</div>
												<div class="col-md-12">
													<div id="documentUploadPreviewDiv"></div>
												</div>
												<div class="col-md-12">
													<div data-error-for="document" class="AddMeeting__status-message status-message error">
														@if ($errors->has('document'))
														<span class="invalid-form-validation text-small">
															{{ $errors->first('document') }}
														</span>
														@endif
													</div>
												</div>
											</div>
											<!-- /Document upload -->
										</div>
									</div>
								</div>

								<button type="submit" id="btnSaveMeeting" class="btnSaveMeeting btn btn-primary pull-right">Update</button>
								<div class="clearfix"></div>
							</form>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col">
			<div class="card">
				<ul class="nav nav-pills nav-justified pt-4">
					<li class="nav-item ">
						<a class="nav-link active show" href="#userTab" data-toggle="tab">User</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#resolutionTab" data-toggle="tab" id="resolution">Resolution</a>
					</li>
				</ul>

				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane active" id="userTab">
							<div class="table-responsive">
								<table class="table UserEntry__table">
									<thead class=" text-primary">
										<th class="UserEntry__th">
											HIN/SRN
										</th>
										<th class="UserEntry__th">
											Role
										</th>
										<th class="UserEntry__th">
											PIN
										</th>
									</thead>
									<tbody class="MeetingEntry__tbody">
										@if(isset($usersBelongToMeeting) && $usersBelongToMeeting->count() > 0)
										@foreach($usersBelongToMeeting as $user)
										<tr class="MeetingEntry__record MeetingEntry__tr ObjectRecord">
											<td class="UserEntry__td">
												{{ isset($user->username) ? $user->username : __('Unknown') }}
											</td>
											<td class="MeetingEntry__td">
												{{ isset($user->role) ? $user->role : __('Unknown') }}

											</td>
											<td class="MeetingEntry__td">
												{{ isset($user->pin) ? $user->pin : __('Unknown') }}

											</td>

										</tr>
										@endforeach
										@endif

									</tbody>
								</table>
							</div>

							{{-- <button type="submit" class="btn btn-danger pull-right">
								Save
							</button> --}}
							
							<button type="button" class="btn btn-outline-primary pull-right" ><a href="/admin/meeting/pdf/{{ $meeting->meeting_uuid }}">
								Download PDF</a></button>
								<button type="button" class="btn btn-outline-primary pull-right" data-toggle="modal" data-target="#addUserForm">
								Add User
							</button>		
						</div>

						<div class="tab-pane" id="resolutionTab">
							@if(isset($vote->vote_setting))
							<div class="row" id="resolutionQuestionEntry">
							@foreach(json_decode($vote->vote_setting, true) as $vote_resolution)
								<div class="col-md-12 resolutionParent">
									<div class="form-group">
										<label >Resolution</label>
										<input type="text" data-uuid="{{ $vote_resolution['uuid'] }}" value="{{ $vote_resolution['question'] }}" name="resolution_0" class="form-control resolutionQuestionInput">
										<button type="button" class="close noChildEventPointer" aria-label="Close" onclick="DP.utils.removeSelfParentDOM(event, '.resolutionParent')">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								</div>
							@endforeach
							</div>
							@else   
							<div class="row" id="resolutionQuestionEntry">

								<div class="col-md-12 resolutionParent">
									<div class="form-group">
										<label >Resolution</label>
										<input type="text" name="resolution_0" class="form-control resolutionQuestionInput">
									</div>
								</div>
							</div>
							@endif

							<br/><br/>
							<div class="row">
								<div class="col">
									<button type="button" id="btnSubmitResolution" class="btn btn-danger pull-right" >Save</button>
									<button id="btnAddResolution" type="button" class="btn btn-primary pull-right">Add more</button>
								</div>
							</div>

							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>  
	</div>
</div>

<div class="modal fade" id="addUserForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				<div class="container"> 
					<ul class="p-4 nav nav-pills nav-justified">
						<li class="nav-item ">
							<a class="nav-link active show" href="#addNewUser" data-toggle="tab">Add New User</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#addExistingUser" data-toggle="tab">Add Existing User</a>
						</li>
					</ul>

					<div class="tab-content ">
						<div class="tab-pane active" id="addNewUser">
							<div class="content" id="addUserForm">
								<div class="container AddUser">
									<div class="row">
										<div class="col">
											<div class="card">
												<div class="card-body">
													<form class="custom-form AddUser__form" id="AddUser__form" action="{{ route('user.add.submit') }}">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="meeting_uuid" value="{{ $meeting->meeting_uuid }}">
														<div class="row">

															<div class="col-md-6">
																<div class="form-group">
																	<label class="AddUser__label">Name</label>
																	<input type="text" name="name" class="form-control AddUser__input" autofocus>
																</div>
																<div data-error-for="name" class="AddUser__status-message status-message error">
																	@if ($errors->has('name'))
																	<span class="invalid-form-validation text-small">
																		{{ $errors->first('name') }}
																	</span>
																	@endif
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="AddUser__label">Address 1</label>
																	<input type='text' name="address1" class=" AddUser__input form-control" />
																</div>
																<div data-error-for="address1" class="AddUser__status-message status-message error">
																	@if ($errors->has('address1'))
																	<span class="invalid-form-validation text-small">
																		{{ $errors->first('address1') }}
																	</span>
																	@endif
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="AddUser__label">HIN/SRN</label>
																	<input type="text" name="username" class="form-control AddUser__input" >
																</div>
																<div data-error-for="HIN/SRN" class="AddUser__status-message status-message error">
																	@if ($errors->has('username'))
																	<span class="invalid-form-validation text-small">
																		{{ $errors->first('username') }}
																	</span>
																	@endif
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="AddUser__label">Address 2</label>
																	<input type='text' name="address2" class="AddUser__input form-control" />
																</div>
																<div data-error-for="address2" class="AddUser__status-message status-message error">
																	@if ($errors->has('address2'))
																	<span class="invalid-form-validation text-small">
																		{{ $errors->first('address2') }}
																	</span>
																	@endif
																</div>
															</div>
															
															<div class="col-md-6">
																<div class="form-group">
																	<label class="AddUser__label" >Security</label>
																	<input type="text" name="security" class="AddUser__input form-control">
																</div>
																<div data-error-for="security" class="AddUser__status-message status-message error">
																	@if ($errors->has('security'))
																	<span class="invalid-form-validation text-small">
																		{{ $errors->first('security') }}
																	</span>
																	@endif
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="AddUser__label">Address 3</label>
																	<input type='text' name="address3" class="AddUser__input form-control" />
																</div>
																<div data-error-for="address3" class="AddUser__status-message status-message error">
																	@if ($errors->has('address3'))
																	<span class="invalid-form-validation text-small">
																		{{ $errors->first('address3') }}
																	</span>
																	@endif
																</div>
															</div>
															
															<div class="col-md-6">
																<div class="form-group">
																	<label class="AddUser__label">Postal Code</label>
																	<input type='text' name="postal_code" class=" AddUser__input form-control" />
																</div>
																<div data-error-for="postal_code" class="AddUser__status-message status-message error">
																	@if ($errors->has('postal_code'))
																	<span class="invalid-form-validation text-small">
																		{{ $errors->first('postal_code') }}
																	</span>
																	@endif
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="AddUser__label">Address 4</label>
																	<input type='text' name="address4" class="AddUser__input form-control" />
																</div>
																<div data-error-for="address4" class="AddUser__status-message status-message error">
																	@if ($errors->has('address4'))
																	<span class="invalid-form-validation text-small">
																		{{ $errors->first('address4') }}
																	</span>
																	@endif
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="AddUser__label">Type</label>
																	<select class="form-control AddUser__input" name="role">
																		<option selected>Unknown</option>
																		<option>NOMINEE</option>
																		<option>SHARE_HOLDER</option>
																	</select>
																</div>
																<div data-error-for="type" class="AddUser__status-message status-message error">
																	@if ($errors->has('type'))
																	<span class="invalid-form-validation text-small">
																		{{ $errors->first('type') }}
																	</span>
																	@endif
																</div>
															</div>
														
														</div>
														<br/><br/>

														<button type="submit" class="btn btn-danger pull-right">Save</button>
															<!-- <button type="submit" class="btn btn-warning pull-right" >Save &#38; New</button>
															-->
															<div class="clearfix"></div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="addExistingUser">
								<div class="table-responsive">
									<table class="table UserEntry__table">
										<thead class=" text-primary">
											<th class="UserEntry__th">
												HIN/SRN
											</th>
											<th class="UserEntry__th">
												Role
											</th>
										</thead>
										<tbody class="MeetingEntry__tbody">
											@if(isset($users) && $users->count() > 0)
											@foreach($users as $user)
											<tr class="UserEntry__record UserEntry__tr ObjectRecord">
												<td class="UserEntry__td">
													<!-- {{ isset($user->username) ? $user->username : __('Unknown') }} -->
													{{ $user->username }}
												</td>
												<td class="MeetingEntry__td">
													{{ isset($user->role) ? $user->role : __('Unknown') }}
													<button class="btn btn-sm btn-outline-secondary pull-right" type="button">Add to Meeting</button>
												</td>
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@includeIf('admin.partials.filemanager_dialog') 
@endsection
@section('execute_script')
<script type="text/javascript" src="{{ asset('/admins/plugins/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/admins/plugins/tinymce/tinymce-config.js') }}"></script>
<script>
	function responsive_filemanager_callback(field_id){
		var imageUrl="",
		docArray = [],
		domain = "{{ URL('/') }}";
		switch(field_id){
			case 'txtFeaturedImage':
			imageUrl = $('#'+field_id).val();
			imageUrl = imageUrl.replace(domain,'');
			$('#imagePreviewDiv').empty().append(
				'<img src="'+imageUrl+'" style="width:100%; margin-bottom:10px;">'
				);
			break;
			case 'txtMultiDocument':
			var documentUrl = $('#'+field_id).val(),
			documentUrl = documentUrl.replace(domain,''),
			documentName = documentUrl.split('/').pop().split('#')[0].split('?')[0];
			docArray.push(documentUrl);
			$('#documentUploadPreviewDiv li').each(function(i,k,v){
				var docUrl = $(this).attr('data-document-url');
				docArray.push(docUrl);
			});
			$('#documentHiddenInput').val(JSON.stringify(docArray));
			$('#documentUploadPreviewDiv').append(`
				<li class="documentItem" data-document-url="${documentUrl}">
				<a href="${documentUrl}">
				<span class="icon"></span>
				<span class="filename">${documentName}</span>
				</a>
				<button type="button" class="close noChildEventPointer px-5" aria-label="Close" onclick="DP.utils.removeSelfParentDOM(event, '.documentItem', DP.utils.renderDocumentInput)">
				<span aria-hidden="true">&times;</span>
				</button>
				</li>`
			);
			break;
			case 'sound_url':
			var playing = false,
			audioEle = $('#audioEle').bind('play', function () {
				playing = true;
			}).bind('pause', function () {
				playing = false;
			}).bind('ended', function () {
				audio.pause();
			}).get(0);
			var supportsAudio = !!document.createElement('audio').canPlayType;
			if (supportsAudio){
				$(audioEle).attr('src', $('#'+field_id).val());
			}
			break;
			default:
			return;
		}
		$("#fileManagerModal").modal('hide');
	}
	jQuery(document).ready(function($) {
		$('#AddMeeting__form').on('submit', DP.main.addMeetingFormSubmitHandler);
		// Add Resolution handler
		$('#btnAddResolution').on('click', DP.main.addResolutionQuestion);
		// Onsubmit add user form handler
		$('#AddUser__form').on('submit', DP.main.addUserFormSubmitHandler);
		// Add resolution submit form handler
		$('#btnSubmitResolution').on('click', DP.main.submitResolutionHandler);
		// Autofocus setup for modal
		$('.modal').on('shown.bs.modal', DP.utils.modalFormAutofocus);
		//Retrieve existing resolution 
		$("#resolution").on('click',DP.main.getExistingResolutionHandler);
		// editOrSaveBtn
		// $('form').on('change', function(){
		//  var btn = $('#editOrSaveBtn');
		//  btn.removeClass('disabled');
		//  console.log(this);
		// });
		$('.btnSaveMeeting').on('click', DP.main.updateMeetingHandler);
		// $('#input-tags').selectize({
		//  persist: false,
		//  createOnBlur: true,
		//  create: true
		// });

		/**
		 * Update meeting
		 */
		$('#EditMeeting__form').on('submit', DP.main.onUpdateMeetingFormSubmitHandler);

		/**
		 * Append document to UI
		 */
		DP.main.appendDocumentToFormUI();
		// Remove bmd-label-static when document complete
		DP.main.removeLabelStatic();
	});
</script>
@endsection