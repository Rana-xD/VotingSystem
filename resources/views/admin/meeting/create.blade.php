@extends('admin.layouts.app')

@section('mainpanel')
<div class="content AddMeeting">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Create Metting</h4>
						<p class="card-category">Register a meeting for client</p>
					</div>
					<div class="card-body">
						<form class="custom-form AddMeeting__form" id="AddMeeting__form" action="{{ route('meeting.add.submit') }}">
							<div class="row">
								<div class="col-12 col-md-8">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="AddMeeting__label">Title</label>
												<input name="title" type="text" class="AddMeeting__input text form-control">
											</div>
										</div>
										<div class="col-md-12">
											<div data-error-for="title" class="AddMeeting__status-message status-message error">
												@if ($errors->has('title'))
												<span class="invalid-feedback uk-text-small">
													{{ $errors->first('title') }}
												</span>
												@endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="AddMeeting__label">Meeting's Date</label>
												<input id="meetingDate" type='date' class="AddMeeting__input date form-control" />
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="AddMeeting__label">Meeting's Time</label>
												<input id="meetingTime" type='time' class="AddMeeting__input time form-control" />
											</div>
										</div>
										<div class="col-md-12">
											<div data-error-for="date_of_meeting" class="AddMeeting__status-message status-message error">
												@if ($errors->has('date_of_meeting'))
												<span class="invalid-feedback uk-text-small">
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
												<input id="meetingCloseDate" type='date' class="AddMeeting__input date form-control" />
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
												<span class="invalid-feedback uk-text-small">
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
												<input type="text" name="location" class="AddMeeting__input text form-control">
											</div>
										</div>
										<div class="col-md-12">
											<div data-error-for="location" class="AddMeeting__status-message status-message error">
												@if ($errors->has('location'))
												<span class="invalid-feedback uk-text-small">
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
												<span class="invalid-feedback uk-text-small">
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
											<textarea name="content" class="richTextBox form-control AddMeeting__input textarea" rows="5"></textarea>
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

							<button type="submit" class="btn btn-primary pull-right">Submit</button>
							<div class="clearfix"></div>
						</form>
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
  	});
</script>
@endsection
