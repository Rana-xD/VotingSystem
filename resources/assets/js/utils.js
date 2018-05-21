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
