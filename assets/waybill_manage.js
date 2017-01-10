$(function () {
	$('#btn-push2back').on('click', function() {
		if(confirm('确认提交到服务器端?')){
			var url = $(this).attr('data-url');
			pushback(url);
		}else{
			return false;
		}
	});


	$("#btn-update").on('click', function(event) {
		event.preventDefault();
		if(confirm('确认修改数据?')){
			var url = $(this).attr('data-url');
			update(url);
		}else{
			return false;
		}
	});


	function get_upload_data() {
		var $trs = $('#editable-table').find('tr.datarow');
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
				'state':$tr.find('.state').find('select').val()
			};
			data.push(tr_data);	
		});
		window.console && console.log(data);
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
			alert('数据推送至后台成功！');
			window.location.reload(true);
		})
		.fail(function() {
			alert('数据推送至后台出错！');
		})
		.always(function() {
			console.log("complete");
		});
		
	}


	function update(update_url) {
		var update_data = get_update_data();
		$.ajax({
			url: update_url,
			type: 'POST',
			dataType: 'json',
			data: {'waybill_data': update_data},
		})
		.done(function() {
			alert('数据推送至后台成功！');
			window.location.reload(true);
		})
		.fail(function() {
			alert('数据推送至后台出错！');
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



	function get_update_data() {
		var $trs = $('#editable-table').find('tr.datarow');
		var data = [];
		$trs.each(function(index, el) {
			$tr = $(el);
			var tr_data = {
				'id' : $tr.attr('data-id'),
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
				'state':$tr.find('.state').find('select').val()
			};
			data.push(tr_data);	
		});
		window.console && console.log(data);
		return data;
	}



	$('#editable-table').on('dblclick', 'td', function(event) {
		var $td = $(this);
		if($td.hasClass('disable_dblclick')){
			return;
		}
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
		var $tds = $('#editable-table').find('td.editing');
		$tds.each(function(index, el) {
			$(el).removeClass('editing');
			var val = $(el).find('input').val();
			$(el).empty().text(val);
		});
	}

	$('#editable-table').on('click', function(event) {
		quitedit();
		event.preventDefault();
		/* Act on the event */
	});


	$('#editable-table').on('click','input', function(event) {
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
			if(zt == option_data[0] || zt == option_data[1]){
				option = "<option value='" + option_data[0] + "' selected>" + option_data[1] + "</option>";
			}
			options += option;
		}
		$select.append(options);
		// $select.val(zt);
		return $select;
	}

	$('td.state').each(function(index, el) {
		var zt = $.trim($(el).text());
		$select = select_state(zt);
		$(el).empty().append($select);
	});



	// remove 
	// remove upload data row
	$('.btn-remove').on('click', function(event) {
		if(confirm('确认删除该条记录?')){
			$(this).parents('tr').remove();
		}
		event.preventDefault();
		/* Act on the event */
	});

	$('.btn-delete-wb').on('click', function(event) {
		if(confirm('确认删除该条记录?')){
			$this = $(this);
			var url = $this.attr('data-url');
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json'
			})
			.done(function() {
				$this.parents('tr').remove();
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}
		
		event.preventDefault();
		/* Act on the event */
	});


	$('.icon-com').on('click', function(event) {
		$('#company-modal').attr('data-id','ddddddff');
		event.preventDefault();
		/* Act on the event */
	});


	$('#company-modal').on('show.bs.modal', function (e) {
		$this = $(this);
		var $rt = e.relatedTarget;
		var rt_id = $rt.id;
		$this.attr('data-rt',rt_id);
		var $rt_td = $($rt).parent();
		var company_id = $rt_td.attr('data-id');
		if(company_id){
			$this.find('#com-item' + company_id).addClass('selected').siblings().removeClass('selected');
		}else{
			$this.find('.com-items span').removeClass('selected');
		}
	});


	$('#company-modal').on('hidden.bs.modal', function (e) {
		$(this).removeAttr('data-rt');
	});


	$('.com-items').on('click', 'span', function(event) {
		$(this).addClass('selected').siblings().removeClass('selected');
		event.preventDefault();
	});

	$('#btn-close-modal').on('click', function() {
		$m = $('#company-modal');
		var rt = $m.attr('data-rt');
		if(rt && $('#' + rt).length){
			var $selected = $m.find('.selected');
			var id = $selected.attr('id'),
				name = $selected.text();
			$('#' + rt).parent().removeClass('com_dismatch').addClass('com_match').attr('data-id',id).find('span').text(name);
		}

		$('#company-modal').modal('hide');
	});


})