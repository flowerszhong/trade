$(function () {
	$('#btn-push2back').on('click', function() {
		if(confirm('确认提交到服务器端？')){
			var url = $(this).attr('data-url');
			pushback(url);
		}else{
			return false;
		}
	});


	function get_upload_data() {
		var $trs = $('#upload-edit-table').find('tr.datarow');
		var data = [];
		$trs.each(function(index, el) {
			$tr = $(el);
			var tr_data = {
				'starttime': $tr.find('.starttime').text(),
				'customer_com':$tr.find('.customer_com').text(),
				'manager':$tr.find('.manager').text(),
				'num':$tr.find('.num').text(),
				'transport_num':$tr.find('.transport_num').text(),
				'destination':$tr.find('.destination').text(),
				'com':$tr.find('.com').text(),
				'amount':$tr.find('.amount').text(),
				'weight':$tr.find('.weight').text(),
				'price':$tr.find('.price').text(),
				'fee':$tr.find('.fee').text(),
				'agent_com':$tr.find('.agent_com').text(),
				'cost':$tr.find('.cost').text(),
				'profit':$tr.find('.profit').text(),
				'remarks':$tr.find('.remarks').text(),
				'state':1
			};
			data.push(tr_data);	
		});
		console.log(data);
		return data;
	}

	function pushback(handle_url) {
		var upload_data = get_upload_data();
		$.ajax({
			url: handle_url,
			type: 'POST',
			dataType: 'json',
			data: {'waybill_data': upload_data},
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	}



	$('#btn-waybill-export').on('click', function(event) {
		var url = $(this).attr('data-url');
		var company = $('#choose-company').val();
		var starttime = $('#starttime').val();
		var signedtime = $('#signedtime').val();
		var label = "确认导出excel文件?";
		if($.trim(company) =='' && $.trim(starttime)=='' && $.trim(signedtime)== ''){
			label = "未选择过滤条件，是要全部导出吗？";
		}


		if(confirm(label)){

			return true;
			$.ajax({
				url: url,
				type: 'POST',
				data: {'company': company,'starttime':starttime,'signedtime':signedtime},
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			
		}else{
			return false;
		}

	});



	$('#query-edit-table').on('dblclick', 'td', function(event) {
		var $td = $(this);
		if($td.find('input').length || $td.find('select').length){

		}else{
			quitedit();
			$td.addClass('editing');
			var text = $.trim($td.text());
			$input = $('<input type="text">').val(text);
			$td.empty().append($input);
		}
		event.preventDefault();
		/* Act on the event */
	});

	function quitedit() {
		var $tds = $('#query-edit-table').find('td.editing');
		$tds.each(function(index, el) {
			$(el).removeClass('editing');
			var val = $(el).find('input').val();
			$(el).empty().text(val);
		});
	}

	$('#query-edit-table').on('click', function(event) {
		quitedit();
		event.preventDefault();
		/* Act on the event */
	});


	$('#query-edit-table').on('click','input', function(event) {
		event.stopPropagation();
		event.preventDefault();
		/* Act on the event */
	});






	function select_state(state) {
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

		$select = $('<select></select>');

		var options = "";
		for (var i = 0; i < states.length; i++) {
			var option_data = states[i];
			var option = "<option value='" + option_data[0] + "'>" + option_data[1] + "</option>";
			options += option;
		}
		$select.append(options);
		$select.val(zt);
		return $select;
	}

	$('td.state').each(function(index, el) {
		var zt = $.trim($(el).text());
		$select = select_state(zt);
		$(el).empty().append($select);
	});

})