$(function () {
	$('#btn-push2back').on('click', function() {
		if(confirm('确认提交到服务器端？')){
			pushback();
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

	function pushback() {
		var upload_data = get_upload_data();
		$.ajax({
			url: window.upload_ajax_handle_url,
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

})