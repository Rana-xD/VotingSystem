@extends('admin.layouts.app')

@section('mainpanel')

<div class="container">
	<div>
		<button type="button" class="btn btn-dark">Edit</button>
	</div>

	<div class="content AddMeeting">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-header card-header-primary">
							<h4 class="card-title">Detail Meeting</h4>
							<p class="card-category">Register a meeting for client</p>
						</div>
						<div class="card-body">
							@if ( isset($meeting) && $meeting->count() > 0 )
							<form class="custom-form AddMeeting__form" id="AddMeeting__form" action="{{ route('meeting.add.submit') }}">
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
													<input id="meetingDate" type='date' class="AddMeeting__input date form-control" value="{{ isset($meeting->date_of_meeting) ? $meeting->date_of_meeting : __('----') }}"/>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="AddMeeting__label">Meeting's Time</label>
													<input id="meetingTime" type='time' class="AddMeeting__input time form-control" value="10:10"/>
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
													<input id="meetingCloseDate" type='date' class="AddMeeting__input date form-control" value="04.20.2014"/>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="AddMeeting__label">Close Voting Time</label>
													<input id="meetingCloseTime" type='time' class="AddMeeting__input time form-control" />
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
													<input type="hidden" id="txtFeaturedImage" name="logo">
												</div>
											</div>
											<div class="col-md-12">
												<div id="imagePreviewDiv"></div>
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

								<button type="submit" class="btn btn-primary pull-right">Save</button>
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

<div class="content">
	<div class="container">
		<div class="card">
			<ul class="nav nav-pills nav-justified pt-4">
				<li class="nav-item ">
					<a class="nav-link active show" href="#userTab" data-toggle="tab">User</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#resolutionTab" data-toggle="tab">Resolution</a>
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
								</thead>
								<tbody class="MeetingEntry__tbody">
									@if(isset($usersMeeting) && $usersMeeting->count() > 0)
									@foreach($usersMeeting as $user)
									<tr class="MeetingEntry__record MeetingEntry__tr ObjectRecord">
										<td class="UserEntry__td">
											{{ isset($user->username) ? $user->username : __('Unknown') }}
										</td>
										<td class="MeetingEntry__td">
											{{ isset($user->role) ? $user->role : __('Unknown') }}

										</td>
									</tr>
									@endforeach
									@endif
								</tbody>
							</table>
						</div>
						
						<button type="submit" class="btn btn-danger pull-right">
							Save
						</button>

						<button type="button" class="btn btn-outline-primary pull-right" data-toggle="modal" data-target="#addUserForm">
							Add User
						</button>
					</div>

					<div class="tab-pane" id="resolutionTab">
						<div class="row" id="resolutionQuestionEntry">

							<div class="col-md-12 resolutionParent">
								<div class="form-group">
									<label >Resolution</label>
									<input type="text" name="resolution_0" class="form-control resolutionQuestionInput">
								</div>
							</div>
						</div>

						<br/><br/>
						<div class="row">
							<div class="col">
								<button type="button" id="btnSubmitResolution" class="btn btn-danger pull-right" data-dismiss="modal">Save</button>
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
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="AddUser__label">HIN/SRN</label>
																	<input type="text" name="username" class="form-control AddUser__input" autofocus>
																</div>
															</div>
															<div class="col-md-6">
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
																	<label class="AddUser__label" >Security</label>
																	<input type="text" name="security" class="AddUser__input form-control">
																</div>
															</div>
															<div class="col-md-6">
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
																	<label class="AddUser__label">Postal Code</label>
																	<input type='text' name="postal_code" class=" AddUser__input form-control" />
																</div>
															</div>
															<div class="col-md-6">
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
																	<label class="AddUser__label">Address 1</label>
																	<input type='text' name="address1" class=" AddUser__input form-control" />
																</div>
															</div>
															<div class="col-md-6">
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
																	<label class="AddUser__label">Address 2</label>
																	<input type='text' name="address2" class="AddUser__input form-control" />
																</div>
															</div>
															<div class="col-md-6">
																<div data-error-for="address2" class="AddUser__status-message status-message error">
																	@if ($errors->has('address2'))
																	<span class="invalid-form-validation text-small">
																		{{ $errors->first('address2') }}
																	</span>
																	@endif
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label class="AddUser__label">Type</label>
																	<select class="form-control AddUser__input" name="role">
																		<option selected>Unknown</option>
																		<option>NOMINEE</option>
																		<option>SHARE_HOLDER</option>
																	</select>
																</div>
															</div>
															<div class="col-md-6">
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
		imgArr = [],
		domain = "{{ URL('/') }}";
		switch(field_id){
			case 'txtFeaturedImage':
			imageUrl = $('#'+field_id).val();
			imageUrl = imageUrl.replace(domain,'');
			$('#imagePreviewDiv').empty().append(
				'<img src="'+imageUrl+'" style="width:100%; margin-bottom:10px;">'
				);
			break;
			case 'txtMultiImages':
			imageUrl = $('#'+field_id).val();
			imageUrl = imageUrl.replace(domain,'');
			imgArr.push(imageUrl);
			$('#slideImagesPreviewDiv img').each(function(i,k,v){
				var imgSrc = $(this).attr('src');
				imgArr.push(imgSrc);
			});
			$('#slideImgs').val(JSON.stringify(imgArr));
			$('#slideImagesPreviewDiv').append(''+
				'<div class="img_slide__outer">'+
				'<img src="'+imageUrl+'" style="width:100%; margin-bottom:10px;">'+
				'<span class="btnRmSlideImg">'+
				'<i class="fa fa-remove"></i>'+
				'</span>'+
				'</div>'+
				'');
			break;
			case 'txtMultiImages':
			imageUrl = $('#'+field_id).val();
			imageUrl = imageUrl.replace(domain,'');
			imgArr.push(imageUrl);
			$('#slideImagesPreviewDiv img').each(function(i,k,v){
				var imgSrc = $(this).attr('src');
				imgArr.push(imgSrc);
			});
			$('#slideImgs').val(JSON.stringify(imgArr));
			$('#slideImagesPreviewDiv').append(''+
				'<div class="img_slide__outer">'+
				'<img src="'+imageUrl+'" style="width:100%; margin-bottom:10px;">'+
				'<span class="btnRmSlideImg">'+
				'<i class="fa fa-remove"></i>'+
				'</span>'+
				'</div>'+
				'');
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

		// $('#input-tags').selectize({
		// 	persist: false,
		// 	createOnBlur: true,
		// 	create: true
		// });
	});
</script>
@endsection