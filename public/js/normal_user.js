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
	
	func.onResolutionChoiceChangeHandler = function(e) {
		e.preventDefault();
		var $self = $(e.target),
			value = $self.val(),
			answerSelector = $self.attr('data-answer-selector'),
			$answerElement = $(answerSelector),
			$numShareInput = $self.next('.numShareInput');
		if($self.is(':checked')) {
			if($answerElement.length) {
				var $answerDiv = $($answerElement[0]).find(`.resolutionAnswerTerm_${value} .resolutionAnswerTerm`);
				$answerDiv.html(value);

			}
			if($numShareInput) {
				var $answerDiv = $($answerElement[0]).find(`.resolutionAnswerTerm_${value} .resolutionShareAmountAnswer`);
				$answerDiv.html($numShareInput.val());
				$numShareInput.prop('disabled', false);
			}
		} else {
			if($answerElement.length) {
				var $answerDiv = $($answerElement[0]).find(`.resolutionAnswerTerm_${value} .resolutionAnswerTerm`);
				$answerDiv.html('');
			}
			if($numShareInput) {
				var $answerDiv = $($answerElement[0]).find(`.resolutionAnswerTerm_${value} .resolutionShareAmountAnswer`);
				$answerDiv.html('');
				$numShareInput.val('').prop('disabled', true);
			}
		}
			
	}

	func.onResolutionNumShareInputChangeHandler = function(e) {
		e.preventDefault();
		var $self = $(e.target),
			value = $self.val(),
			resolutionType = $self.attr('data-resolution-type'),
			answerSelector = $self.attr('data-answer-selector'),
			$answerElement = $(answerSelector);

		if($answerElement.length) {
			var $answerDiv = $($answerElement[0]).find(`.resolutionAnswerTerm_${resolutionType} .resolutionShareAmountAnswer`);
			$answerDiv.html(value);
		}
	}
	
})(jQuery);
