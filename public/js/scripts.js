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
	func.formSubmitPromise = function(url, formData) {
		return new Promise(function(resolve, reject) {
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				processData: false,
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
	            "/admins/filemanager/dialog.php?type=2&field_id=documentTxtField'&fldr=documents"
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
	                <label >Resolution</label>
	                <input type="text" class="form-control resolutionQuestionInput">
	                <button type="button" class="close noChildEventPointer" aria-label="Close" onclick="DP.utils.removeSelfParentDOM(event, '.resolutionParent')">
	                	  <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	        </div>
		`);
	}

	

})(jQuery);

jQuery(document).ready(function($) {
	DP.main.initializeDOMEventListener();
});
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
if(!DP.utils) DP.utils = {};

(function($) {
	var func = DP.utils;

		/**
	 * Deactivate loading spinner
	 * @return void
	 */
	func.deactivateSpinner = function() {
		$('.spinner').removeClass('active');
		$('.spinner-wrapper').removeClass('active');
		$('body').removeClass('spinner-loading');
	}

	/**
	 * Activate loading spinner
	 * @return {[type]} [description]
	 */
	func.activateSpinner = function() {
		$('body').addClass('spinner-loading');
		$('.spinner-wrapper').addClass('active');
		$('.spinner').addClass('active');
	}

	/**
	 * Open new tab
	 */
	func.openInNewTab = function(url) {
	  	var win = window.open(url, '_blank');
	  	win.focus();
	}

	/**
	 * Change window tab url
	 */
	func.changeUrl = function(url) {
		window.location.replace(url);
	}

	func.closeFilemanagerDialog = function(e) {
		e.preventDefault();
		console.log("clicked");
		$("#fileManagerModal").modal('hide');
	}

	func.removeSelfParentDOM = function(e, parentSelector) {
		e.preventDefault();
		var $parent = $(e.target).parents(parentSelector)[0]
		if($parent){
			$parent.remove();
		}
	}
	
})(jQuery);