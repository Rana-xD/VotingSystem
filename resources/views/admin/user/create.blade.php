<div class="container AddUser">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body">
					<form class="custom-form AddUser__form" id="AddUser__form" action="{{ route('user.add.submit') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-6" hidden>
								<div class="form-group">
									<label class="AddUser__label">Meeting UUID</label>
									<input type="hidden" name="meeting_uuid" class="form-control AddUser__input" value="{{ $meeting_uuid }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="AddUser__label">HIN/SRN</label>
									<input type="text" name="username" class="form-control AddUser__input">
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
							<!-- <div class="col-md-6">
								<div class="form-group">
									<label AddUser__label>Shareholder Name</label>
									<input type="text" name="shareholder_name" class="AddUser__input form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div data-error-for="Shareholder_name" class="AddUser__status-message status-message error">
									@if ($errors->has('shareholder_name'))
									<span class="invalid-form-validation text-small">
										{{ $errors->first('shareholder_name') }}
									</span>
									@endif
								</div>
							</div> -->
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

						<button type="submit" class="btn btn-danger pull-right">Save &#38; Close</button>
						<!-- <button type="submit" class="btn btn-warning pull-right" >Save &#38; New</button>
 -->
						<div class="clearfix"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@section('execute_script')
<script>
	jQuery(document).ready(function($) {
		$('#AddMeeting__form').on('submit', DP.main.addMeetingFormSubmitHandler);
		// Add Resolution handler
		$('#btnAddResolution').on('click', DP.main.addResolutionQuestion);
		// Onsubmit add user form handler
		$('#AddUser__form').on('submit', DP.main.addUserFormSubmitHandler);
	});

</script>
@endsection
