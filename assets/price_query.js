if (!Array.prototype.filter) {
  Array.prototype.filter = function(fun/*, thisArg*/) {
    'use strict';

    if (this === void 0 || this === null) {
      throw new TypeError();
    }

    var t = Object(this);
    var len = t.length >>> 0;
    if (typeof fun !== 'function') {
      throw new TypeError();
    }

    var res = [];
    var thisArg = arguments.length >= 2 ? arguments[1] : void 0;
    for (var i = 0; i < len; i++) {
      if (i in t) {
        var val = t[i];

        // NOTE: Technically this should Object.defineProperty at
        //       the next index, as push can be affected by
        //       properties on Object.prototype and Array.prototype.
        //       But that method's new, and collisions should be
        //       rare, so use the more-compatible alternative.
        if (fun.call(thisArg, val, i, t)) {
          res.push(val);
        }
      }
    }

    return res;
  };
}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}


$(function () {

	var $select_tool = $('#area-select-tool');
	var $input_area = $('#input-area');
	var $input_weight = $('#input-weight');
	var $btn_query = $('#btn-query');
	var $group_header = $('#group-header');
	var $group_body = $('#group-body');
	var $price_result = $('#price-result');
	// var $btn_close = $('#btn-close');

	$btn_query.on('click', function(event) {
		event.preventDefault();
		var url = $('#query-form').attr('action');
        var area = $input_area.val();
		var weight = $input_weight.val();
        if(!(area && weight)){
            alert('查询条件不完整，请输入国家或重量！');
            return false;
        }
        var state= $input_area.attr('data-state') || area;
        var state_en= $input_area.attr('data-en');
		var company_id = $('#choose-company').val();
		if(!company_id && $('#choose-company').length){
			alert('请选择查询公司');
			return;
		}

		$price_result.find('#price-tbody').empty();
		/* Act on the event */
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: {
				'state':state,
				'state_en':state_en,
				'weight': weight,
				'company_id': company_id
			}
		})
		.done(function(response) {
			if(response.ok){
				var data = response.data;
				data.sort(function (a,b) {
					return a.price - b.price;
				});
				var state = response.state + '(' + response['state_en'] + ')';
				var w = response.weight;
				w = math_round(w);
				var trs = '';
				for (var i = 0; i < data.length; i++) {
					var _d = data[i];
					var single = _d.price;
					var sum = (single * w).toFixed(2);
					if(w<=20.5){
						single = '';
						sum = _d.price;
					}
					var tr = "<tr><td>"+ _d.cname+"</td><td>"+ state + '</td><td>'+ w +'KG </td><td>' + single + '</td><td>'+ sum +'</td></tr>';
					trs += tr;
				}
				$price_result.find('#price-tbody').empty().append(trs);
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});

	function math_round(w) {
		if(w<21){
			var w_floor = Math.floor(w);
			if(w_floor<w){
				if(w> w_floor+ 0.5){
					return Math.ceil(w);
				}else{
					return w_floor+0.5;
				}
			}else{
				return w;
			}
		}else{
			return Math.ceil(w);
		}
		
	}


	$input_area.on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		var url = $(this).attr('action');
		var offset = $(this).offset();
		$select_tool.css({
			'top' : offset.top + $(this).outerHeight() +  'px',
			'left': offset.left + 'px'
		}).slideDown();
		
	});
	$input_area.keydown(false);

	$group_body.on('click','span',function(event) {
		event.preventDefault();
		var state = $(this).attr('data-state');
		var state_en = $(this).attr('data-en');
		var $input = $('#input-area');
		$input.attr('data-state',state);
		$input.attr('data-en',state_en);
		$input.val($(this).text());
        $(this).addClass('selected').siblings().removeClass('selected');
		$select_tool.hide();
	});

	$group_header.on('click', 'b', function(event) {
		event.preventDefault();
		var key = $(this).text();
        $(this).addClass('current').siblings().removeClass('current');
        var filter_result = [];
        if(key == '常用国家'){
            filter_result = window.common_counties;
        }else{
            var area_json = window.areajson;
            filter_result = area_json.filter(function (area) {
                var state_en = area['state_en'];
                if(state_en.capitalize().charAt(0)==this){
                    return true;
                }
            },key);
        }
		

		var group = "";
		var group_title = "<h3>" + key + '</h3>';

		for (var i = filter_result.length - 1; i >= 0; i--) {
			var area = filter_result[i];
			var area_id = area['area_id'];
			var state = area['state'];
			var state_en = area['state_en'];
			group += '<span data-state="'+state+'" data-en="'+state_en+'">' + state + '(' + state_en + ')' + '</span>';
		}
		$("#group-body").empty().append(group_title,group);
	});

	$select_tool.on('click', function(event) {
		event.preventDefault();
		event.stopPropagation();
		/* Act on the event */
	});

	$(document).on('click', function(event) {
		$select_tool.hide();
		/* Act on the event */
	});

	// $btn_close.on('click', function(event) {
	// 	event.preventDefault();
	// 	$select_tool.hide();
	// });

	$group_header.find('b:first').trigger('click');
	
});