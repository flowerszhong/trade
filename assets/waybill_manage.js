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
				'customer_com_id':$tr.find('.customer_com').attr('data-id'),
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

		var is_complete = check_data_complete(upload_data);

		if(!is_complete){
			alert('数据不完整，部分运单未关联公司');
			return;
		}

		$.ajax({
			url: handle_url,
			type: 'POST',
			dataType: 'json',
			data: {'waybill_data': upload_data},
		})
		.done(function() {
			alert('数据推送至后台成功！');
			window.location.href = window.location.href;
		})
		.fail(function() {
			alert('数据推送至后台出错！');
		})
		.always(function() {
			window.console && console.log("complete");
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


	function check_data_complete(data) {
		if(data && data.length){
			for (var i = 0; i < data.length; i++) {
				var item = data[i];
				if(!item['customer_com_id']){
					return false;
				}
			}
			return true;
		}else{
			return false;
		}
	}



	$('#btn-waybill-export').on('click', function(event) {
		var url = $(this).attr('data-url');
		var company = $('#choose-company').val();
		var starttime = $('#starttime').val();
		var signedtime = $('#signedtime').val();
		var label = "确认导出excel文件?";
		if($.trim(company) =='' && $.trim(starttime)=='' && $.trim(signedtime)== ''){
			label = "默认导出第1页，是否导出？";
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
				'customer_com_id':$tr.find('.customer_com').attr('data-id'),
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
				window.console && console.log("error");
			})
			.always(function() {
				window.console && console.log("complete");
			});
		}
		
		event.preventDefault();
		/* Act on the event */
	});

	$('.btn-update-num').on('click', function(event) {
		$('#num-modal').modal('show',$(this));
	});


	$('#num-modal').on('show.bs.modal', function (e) {
		$this = $(this);
		var $rt = e.relatedTarget;
		var num = $.trim($rt.attr('data-num'));
		var query_url = $this.attr('data-url');
		$("#statesbox").empty().append('正在加载...');
		$.ajax({
		    url: query_url,
		    type: 'POST',
		    dataType: 'json',
		    data: {
		        'postid': num
		    },
		})
		.done(function(response) {
		    if(response && response.message == "ok" ){
                showResult(response);
            }else{
                showResult_error(postid);
            }
		})
		.fail(function() {
		    window.console && console.log("error");
        	$("#statesbox").empty().append('查询出错！！！');
		})
		.always(function() {

		});


	});

	$('#statesbox').on('click', '.case-summary', function(event) {
	    event.preventDefault();
	    $(this).next().toggle();
	});


	    function checkCaseAvailable (key) {
	        
	    }


    function showResult (queryData) {

        var $case = $("<div class='case'></div>");
        var $summary = $("<div class='case-summary'></div>");
        var $detail = $("<div class='case-detail'></div>");

        makeSummary($summary,queryData);
        makeDetail($detail,queryData);

        $case.append($summary,$detail);

        $("#statesbox").empty().append($case);

    }

    function showResult_error(postid) {
        var $case = $("<div class='case'></div>");
        var $summary = $("<div class='case-summary'></div>");

        $summary.append("运单号 <b>" + postid + "</b>：查询失败，请检查您的订单号是否正确！！！");
        $case.append($summary);
        $("#statesbox").append($case);
    }

	function makeSummary ($summary,data) {
	    var departure = data['departure']?data['departure']:"未知";
	    var destination = data['destination']?data['destination']:"未知";
	    var signedtime = data['signedtime']?data['signedtime']:"未知";

	    var signname = data['signname'];
	    var states= {
	        '0':'在途',
	        '1':'揽件',
	        '2':'疑难',
	        '3':'签收',
	        '4':'退签',
	        '5':'派件',
	        '6':'退回'
	    };

	    var state = data['state'];
	    state = signname || states[state];
	    var com = companyName(data['com']);
	    var str = "<dl>";
	        str += "<dt>运单号:</dt>";
	        str += "<dd>"+ data['nu']+"</dd>";
	        str += "<dt>承运商:</dt>";
	        str += "<dd>"+ com +"</dd>";
	        str += "<dt class='d'>起运地:</dt>";
	        str += "<dd>"+ departure +"</dd>";
	        str += "<dt>目的地:</dt>";
	        str += "<dd>"+destination+"</dd>";
	        str += "<dt class='d'>最新状态:</dt>";
	        str += "<dd>"+state+"</dd>";
	        str += "<dt class='d'>更新时间:</dt>";
	        str += "<dd>"+signedtime+"</dd>";
	        str += "<dd><a class='show-detail'>点击显示详情 &#x21d3;</a></dd>";
	        str += "</dl>";
	    $summary.append(str);
	}

	function companyName (name) {
	    var company = {
	        'fedex':'Fedex',
	        'ups' : 'UPS',
	        'dhl' : 'DHL'
	    }

	    return company[name]?company[name]:name;
	}

	function makeDetail($detail,data) {
	    var ischeck = parseInt(data['ischeck']);
	    $table = makeCheckpoints(data['data'],ischeck);
	    $detail.append($table);
	}


	function makeCheckpoints (checkpoints,ischeck) {
	    var strs = "<table class='result-info2 result-border'>";
	    var len = checkpoints.length;
	    for (var i = len - 1; i >= 0; i--) {
	        var checkpoint = checkpoints[i]; 
	        var str = "<tr>";
	        str += "<td class='row1'>" + checkpoint['time'] + "</td>";
	        if(i == 0){
	            if(ischeck){
	                str += "<td class='status status-check'>&nbsp;&nbsp;</td>";
	            }else{
	                str += "<td class='status status-wait'>&nbsp;&nbsp;</td>";
	            }
	        } else if(i == len-1 ){
	            str += "<td class='status status-first'>&nbsp;&nbsp;</td>";
	        }else{
	            str += "<td class='status'>&nbsp;&nbsp;</td>";
	        }

	        str += "<td>" + checkpoint['context'] + "</td>";
	        str += "</tr>";
	        strs += str;
	        
	    };

	    strs += "</table>";

	    return strs;
	    

	}


	$('#state-slt').val($('#state-slt').attr('data-option'));


	$('#company-modal').on('show.bs.modal', function (e) {
		$this = $(this);
		var $rt = e.relatedTarget;
		var rt_id = $rt.id;
		$this.attr('data-rt',rt_id);
		var $rt_td = $($rt).parent();
		var company_id = $rt_td.attr('data-id');
		if(company_id){
			$this.find('#com-item-' + company_id).addClass('selected').siblings().removeClass('selected');
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
			var id = $selected.attr('data-id'),
				name = $selected.text();
			$('#' + rt).parent().removeClass('com_dismatch').addClass('com_match').attr('data-id',id).find('span').text(name);
		}

		$('#company-modal').modal('hide');
	});


})