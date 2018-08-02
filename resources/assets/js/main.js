/*! =========================================================
 *
 * =========================================================
 *
 *                       _oo0oo_
 *                      o8888888o
 *                      88" . "88
 *                      (| -_- |)
 *                      0\  =  /0
 *                    ___/`---'\___
 *                  .' \|     |// '.
 *                 / \|||  :  |||// \
 *                / _||||| -:- |||||- \
 *               |   | \\  -  /// |   |
 *               | \_|  ''\---/''  |_/ |
 *               \  .-\__  '-'  ___/-. /
 *             ___'. .'  /--.--\  `. .'___
 *          ."" '<  `.___\_<|>_/___.' >' "".
 *         | | :  `- \`.;`\ _ /`;.`/ - ` : | |
 *         \  \ `_.   \_ __\ /__ _/   .-` /  /
 *     =====`-.____`.___ \_____/___.-`___.-'=====
 *                       `=---='
 *
 *     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 *
 *               Buddha Bless:  "No Bugs"
 *
 * ========================================================= */
 var DP;
 if(!DP) DP = {};
 if(!DP.main) DP.main = {};

 (function($) {
 	var func = DP.main;

		/**
	 * Handle promise for form AJAX submit
	 * @return Promise
	 */
	 func.formSubmitPromise = function(url, formData, processData=false) {
	 	return new Promise(function(resolve, reject) {
	 		$.ajax({
	 			url: url,
	 			type: 'POST',
	 			dataType: 'json',
	 			processData: processData,
	 			contentType: false,
	 			data: formData,
	 			success: function(response) {
	 				resolve(response);
	 			},
	 			error: function(error) {
	 				console.log(error);
	 				reject(error);
	 			}
	 		}).always(function() {
	 			DP.utils.deactivateSpinner();
	 		});
	 	});
	 }

		/**
	 * Handle delete object
	 * @param  String url [url to delete an object]
	 * @return Promise
	 */
	 func.deleteObjectPromise = function(url) {
	 	return new Promise(function(resolve, reject) {
	 		$.ajax({
	 			url: url,
	 			type: 'DELETE',
	 			dataType: 'json',
	 			success: function(response) {
	 				resolve(response);
	 			},
	 			error: function(error) {
	 				reject(error);
	 			}
	 		}).always(function() {
	 			DP.utils.deactivateSpinner();
	 		});
	 	});
	 }

	 func.handlePromiseCatchError = function(error, defaultMessage) {
	 	DP.utils.deactivateSpinner();
	 	if(error.responseJSON && 
	 		typeof(error.responseJSON) == 'object' && 
	 		error.responseJSON.hasOwnProperty('message')) {

	 		swal('Oop!', error.responseJSON.message, 'error', {
	 			button: false
	 		});
	 } else {
	 	swal('Oop!', defaultMessage, 'error', {
	 		button: false
	 	});
	 }
	}

	func.handleFormSubmitionError = function(formEle, error, defaultMessage) {
		DP.utils.deactivateSpinner();
		if(error.responseJSON && 
			typeof(error.responseJSON) == 'object' && 
			error.responseJSON.hasOwnProperty('errors')){
			for(var key in error.responseJSON.errors){
				var fieldErrors = error.responseJSON.errors[key];
				switch(typeof(fieldErrors)){
					case 'string':
					$(formEle).find(`[data-error-for="${key}"]`)
					.html(`<span class="invalid-feedback uk-text-small">${fieldErrors}</span>`);
					break;
					case 'object':
					var errorsMessage = '';
					if(Array.isArray(fieldErrors)){
						fieldErrors.forEach(function(value, index){
							errorsMessage = errorsMessage + `<span class="invalid-feedback uk-text-small">${value}</span>`;
						});
					}
					$(formEle).find(`[data-error-for="${key}"]`)
					.html(errorsMessage);
					break;
					default:
					$(formEle).find(`[data-error-for="${key}"]`)
					.html(`<span class="invalid-feedback uk-text-small">${String(fieldErrors)}</span>`);
					break;
				}
			}
		}
		swal({
			title: 'Oop!',
			icon: 'error',
			text: error.responseJSON && error.responseJSON.message ? error.responseJSON.message : defaultMessage,
			button: false,
			className: 'custom-swal'
		});
	}

	func.handleFilemanagerUploadBtn = function(e){
		e.preventDefault();
		var type = $(this).attr('data-type'),
		iframe = $('#fileManagerIframe');
		switch(type){
			case 'sound':
			$(iframe).attr(
				'src',
				"/admins/filemanager/dialog.php?type=2&field_id=sound_url'&fldr=musics"
				);
			break;
			case 'document':
			$(iframe).attr(
				'src',
				"/admins/filemanager/dialog.php?type=2&field_id=txtMultiDocument'&fldr=documents"
				);
			break;
			case 'image':
			$(iframe).attr(
				'src',
				"/admins/filemanager/dialog.php?type=1&field_id=txtFeaturedImage'&fldr=images"
				);
			break;
			case 'multi_images':
			$(iframe).attr(
				'src',
				"/admins/filemanager/dialog.php?type=1&field_id=txtMultiImages'&fldr=images"
				);
			break;
			case 'video':
			$(iframe).attr(
				'src',
				"/admins/filemanager/dialog.php?type=3&field_id=video_url'&fldr=videos"
				);
			break;
			default:
			$(iframe).attr(
				'src',
				"/admins/filemanager/dialog.php?type=1&field_id=txtFeaturedImage'&fldr="
				);
		}
		$("#fileManagerModal").modal('show');
	}

	/**
	 * Handle add meeting form submit
	 */
	 func.addMeetingFormSubmitHandler = function(e) {
	 	e.preventDefault();
	 	var self = e.target;
	 	var formData = new FormData($(self).get(0)),
	 	meetingStartDate = $('#meetingDate').val();
	 	meetingStartTime = $('#meetingTime').val(),
	 	meetingCloseDate = $('#meetingCloseDate').val(),
	 	meetingCloseTime = $('#meetingCloseTime').val(),
	 	actionUrl = $(self).attr('action');
	 	var meetingStartDatetime = window.Moment(meetingStartDate +" "+ meetingStartTime).format('YYYY-MM-DD HH:MM:ss');
	 	var meetingCloseDatetime = window.Moment(meetingCloseDate +" "+ meetingCloseTime).format('YYYY-MM-DD HH:MM:ss');
	 	formData.append('date_of_meeting', meetingStartDatetime);
	 	formData.append('expired_date', meetingCloseDatetime);
	 	DP.utils.activateSpinner();
	 	var promise = DP.main.formSubmitPromise(actionUrl, formData);
	 	promise.then(function(response) {
	 		if(response.status.code == 200) {
	 			swal({
	 				title: 'Success',
	 				icon: 'success',
	 				text: response.status.message ? response.status.message : 'Successfully added a meeting.',
	 				button: false,
	 				timer: 10000,
				 }).then(okay => {
					  window.location = '/admin/meeting';
					
				  }); 
				 
	 		} else {
	 			swal({
	 				title: 'Warning',
	 				icon: 'warning',
	 				text: response.status.message ? response.status.message : 'Something went wrong, please retry',
	 				button: false,
	 				timer: 10000,
	 			});
	 		}
	 	}, function(error) {
	 		DP.main.handleFormSubmitionError(self, error, 'Unexpected error while adding meeting, please retry.');
	 	}).catch(function(error) {
	 		DP.main.handleFormSubmitionError(self, error, 'Unexpected error while adding meeting, please retry.');
	 	});
	 }

	/**
	 * Handle click on upload media files
	 */
	 func.initializeDOMEventListener = function() {
		// Upoad file dialog
		$('.uploadFile').on('click', DP.main.handleFilemanagerUploadBtn);
	}

	func.addResolutionQuestion = function(e) {
		e.preventDefault();
		console.log('resolutionQuestionEntry Clicked');
		// Upoad file dialog
		$('#resolutionQuestionEntry').append(`
			<div class="col-md-12 resolutionParent">
			<div class="form-group ">
			<label class="bmd-label-float">Resolution</label>
			<input type="text" class="form-control resolutionQuestionInput">
			<button type="button" class="close noChildEventPointer" aria-label="Close" onclick="DP.utils.removeSelfParentDOM(event, '.resolutionParent')">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>
			</div>
			`);
		$('.bmd-label-static').removeClass('bmd-label-static');
	}

	func.submitResolutionHandler = function(e){
		
		var resolutionInput = $(".resolutionQuestionInput");
		var meeting_uuid = $("#meeting_uuid").val();
		var resolutions = [];
		
		for(var i=0;i<resolutionInput.length;i++){
			var uuid = DP.utils.uuidv4();
			var exitedUUID = $(resolutionInput[i]).attr('data-uuid');
			var tempObj = {
				uuid: exitedUUID ? exitedUUID : uuid,
				question: $(resolutionInput[i]).val()
			};
			resolutions.push(tempObj);
		}
		console.log(resolutions);
		console.log(meeting_uuid);
		actionUrl = "/admin/meeting/details/resolution/add";
		formData = {
			meeting_uuid : meeting_uuid,
			resolutions : JSON.stringify(resolutions),

		};
		console.log(formData);
		$.ajax({
			url: actionUrl,
			type: 'POST',
			dataType: 'json',
			data: formData,
			success: function(response) {
				if(response.status.code == 200) {
					swal({
						title: 'Success',
						icon: 'success',
						text: response.status.message ? response.status.message : 'Successfully added a meeting.',
						button: false,
						timer: 7000,
					});
				} else {
					swal({
						title: 'Warning',
						icon: 'warning',
						text: response.status.message ? response.status.message : 'Something went wrong, please retry',
						button: false,
						timer: 10000,
					});
				}
			},
			error: function(error) {
				
			}
		});
		
		
	}

	func.addUserFormSubmitHandler = function(e){
		e.preventDefault();
		var self = e.target;
		var formData = new FormData($(self).get(0)),
		actionUrl = $(self).attr('action');
		DP.utils.activateSpinner();
		var promise = DP.main.formSubmitPromise(actionUrl, formData);
		promise.then(function(response) {
			console.log(response.status.code);
			if(response.status.code == 200) {
				swal({
					title: 'Success',
					icon: 'success',
					text: response.status.message ? response.status.message : 'Successfully added a user.',
					button: false,
					timer: 7000,
				}).then(okay=>{
					
					window.location.reload();
				});
			} else {
				swal({
					title: 'Warning',
					icon: 'warning',
					text: response.status.message ? response.status.message : 'Something went wrong, please retry',
					button: false,
					timer: 10000,
				});
			}
		});
	}
	
	func.meetingListClickedHandler = function(e){
		e.preventDefault();		
		var selected_meeting = $(e.currentTarget.children[0]);
		var meeting_uuid = selected_meeting[0].innerText;
		var url = "meeting/details/" + meeting_uuid;
		DP.utils.changeUrl(url);
	}

	func.getExistingResolutionHandler = function(e){
		console.log("HI RESOLUTION");
	}

	func.updateMeetingHandler = function(e){
		console.log("Update Meeting Btn Clicked");
	}

	func.meetingFormSubmitHandler = function(e){
		e.preventDefault();
		var resolution = JSON.parse($('#resolution').val());
		var vote = {};
		

		var self = e.target;
		var roleType = $(self).attr('data-role');
		if(roleType == 'SHARE_HOLDER') {
			var overallVote = $('.resolutionRadioContainer .resolutionChoiceInput:checked');
			for ( var i = 0; i<resolution.length; i++ ){	
				vote[resolution[i]] = overallVote[i].value;
			}
			$('#vote').val(JSON.stringify(vote));
		} else {

		}

		var formData = new FormData($(self).get(0)),
		actionUrl = $(self).attr('action');
		console.log(formData.get("proxy"));
		DP.utils.activateSpinner();
		var promise = DP.main.formSubmitPromise(actionUrl, formData);
		promise.then(function(response) {
			console.log(response.status.code);
			if(response.status.code == 200) {
				swal({
					title: 'Success',
					icon: 'success',
					text: response.status.message ? response.status.message : 'Successfully added a user.',
					button: false,
					timer: 7000,
				});
			} else {
				swal({
					title: 'Warning',
					icon: 'warning',
					text: response.status.message ? response.status.message : 'Something went wrong, please retry',
					button: false,
					timer: 10000,
				});
			}
		});
	}

	func.toggleVisibilityProxyNameInput = function(e) {
		var $self = $(e.target),
			value = $self.val();
		if(value == 0) {
			$('input.ProxyName__input')
			.removeClass('hide')
			.addClass('show')
			.prop('disabled', false)
			.focus();
		} else {
			$('input.ProxyName__input')
			.removeClass('show')
			.addClass('hide')
			.prop('disabled', true);
		}
	}

	func.emailNotifyFalseOnchange = function(e){
		if ($(e.target).is(':checked')){
			$('.voterEmail').prop('required', true);
		}else{
			$('.voterEmail').prop('required', false);
		}
	}

	func.onUpdateMeetingFormSubmitHandler = function(e) {
		e.preventDefault();
		var $self = $(e.target);
		var	formData = new FormData($self.get(0)),
			meetingStartDate = $('#meetingDate').val();
		 	meetingStartTime = $('#meetingTime').val(),
		 	meetingCloseDate = $('#meetingCloseDate').val(),
		 	meetingCloseTime = $('#meetingCloseTime').val(),
		 	actionUrl = $($self).attr('action');
		 	var meetingStartDatetime = window.Moment(meetingStartDate +" "+ meetingStartTime).format('YYYY-MM-DD HH:MM:ss');
		 	var meetingCloseDatetime = window.Moment(meetingCloseDate +" "+ meetingCloseTime).format('YYYY-MM-DD HH:MM:ss');
		 	formData.append('date_of_meeting', meetingStartDatetime);
		 	formData.append('expired_date', meetingCloseDatetime);

		DP.utils.activateSpinner();
		var promise = DP.main.formSubmitPromise(actionUrl, formData);
		promise.then(function(response){
			if(response.status.code == 200) {
				var message = response.status.message ? response.status.message : 'Successfully updated a meeting.'
				DP.utils.onShowSweetAlertSuccess(message);
			}
		}, function(error){
			DP.main.handleFormSubmitionError($self, error, 'Error occured while updating meeting, please retry.');
		}).catch(function(error){
			DP.main.handleFormSubmitionError($self, error, 'Error occured while updating meeting, please retry.');
		});
	}

	func.appendDocumentToFormUI = function() {
		var docArray = $('#documentHiddenInput').val(),
			docArray = JSON.parse(docArray);
		for(var i=0; i<docArray.length; i++) {
			var documentName = docArray[i].split('/').pop().split('#')[0].split('?')[0];
			$('#documentUploadPreviewDiv').append(`
				<li class="documentItem" data-document-url="${docArray[i]}">
				<a href="${docArray[i]}">
				<span class="icon"></span>
				<span class="filename">${documentName}</span>
				</a>
				<button type="button" class="close noChildEventPointer px-5" aria-label="Close" onclick="DP.utils.removeSelfParentDOM(event, '.documentItem', DP.utils.renderDocumentInput)">
				<span aria-hidden="true">&times;</span>
				</button>
				</li>`
			);
		}
	}


	func.appendDocumentToUserUI = function() {
		var docArray = $('#documentHiddenInput').val(),
			docArray = JSON.parse(docArray);
		for(var i=0; i<docArray.length; i++) {
			var documentName = docArray[i].split('/').pop().split('#')[0].split('?')[0];
			$('#documentUploadPreviewDiv').append(`
				<li class="documentItem" data-document-url="${docArray[i]}">
				<a href="${docArray[i]}">
				<span class="icon"></span>
				<span class="filename">${documentName}</span>
				</a>
				</li>`
			);
		}
	}

	func.removeLabelStatic = function(){
		var docIntervalState;
		docIntervalState = setInterval(function(){
			if(document.readyState == 'complete'){
				$('.bmd-label-static').removeClass('bmd-label-static');
				console.log("clearing setInterval");
				clearInterval(docIntervalState);
			}
			console.log(docIntervalState);
		}, 1000);
	}

	// getErrorStatus&MessageFromLogin
	func.getLoginErrorStatus = function()
	{
		var status = "<?= $phpVar ?>";
		console.log(status);

	}

})(jQuery);

jQuery(document).ready(function($) {
	DP.main.initializeDOMEventListener();
});