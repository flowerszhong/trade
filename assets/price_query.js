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

$(function () {

	var $select_tool = $('#area-select-tool');
	var $input_area = $('#input-area');
	var $input_weight = $('#input-weight');
	var $btn_query = $('#btn-query');
	var $group_header = $('#group-header');
	var $group_body = $('#group-body');
	var $price_result = $('#price-result');

	$btn_query.on('click', function(event) {
		event.preventDefault();
		var url = $('#query-form').attr('action');
		var area_id= $input_area.attr('data-id');
		var state = $input_area.val();
		var weight = $input_weight.val();
		/* Act on the event */
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: {
				'area':area_id,
				'weight': weight,
				'state' : state 
			}
		})
		.done(function(data) {
			if(data.ok){
				var tr = "<tr><td>" + data.area + "</td><td>"+ data.state + '</td><td>'+ data.weight +'KG </td><td>' + data.price + '</td></tr>';
				$price_result.find('#price-tbody').empty().append(tr);
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});


	$input_area.on('click', function(event) {
		event.preventDefault();
		var url = $(this).attr('action');
		var offset = $(this).offset();
		$select_tool.css({
			'top' : offset.top + $(this).outerHeight() +  'px',
			'left': offset.left + 'px'
		}).slideDown();
		
	});

	$group_body.on('click','span',function(event) {
		event.preventDefault();
		var area_id = $(this).attr('data-id');
		var $input = $('#input-area');
		$input.attr('data-id',area_id);
		$input.val($(this).text());
		$select_tool.hide();
	});

	$group_header.on('click', 'b', function(event) {
		event.preventDefault();
		var key = $(this).text();
		var area_json = window.areajson;

		$(this).addClass('current').siblings().removeClass('current');

		var filter_result = area_json.filter(function (area) {
			var state_en = area['state_en'];
			if(state_en.toUpperCase().charAt(0)==this){
				return true;
			}
		},key);

		var group = "";
		var group_title = "<h3>" + key + '</h3>';

		for (var i = filter_result.length - 1; i >= 0; i--) {
			var area = filter_result[i];
			var area_id = area['area_id'];
			var state = area['state'];
			var state_en = area['state_en'];
			group += '<span data-id="'+area_id+'">' + state + '(' + state_en + ')' + '</span>';
		}
		$("#group-body").empty().append(group_title,group);
	});

	$group_header.find('b:first').trigger('click');
	
});