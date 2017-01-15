$(function () {
	function label_state(state) {
		var zt = state || 1;
		var states = [
			['1','已提货'],
			['3','暂扣'],
			['5','已上网'],
			['7','已提取'],
			['9','在途中'],
			['11','派送中'],
			['13','已签收']
		];


		var label = "已提货";
		for (var i = 0; i < states.length; i++) {
			var option_data = states[i];
			if(zt == option_data[0] || zt == option_data[1]){
				label = option_data[1];
			}
		}
		return label;
	}

	$('#state-slt').val($('#state-slt').attr('data-option'));

	$('td.state').each(function(index, el) {
		var zt = $.trim($(el).text());
		$label = label_state(zt);
		$(el).empty().append($label);
	});
})