$(function () {
		String.prototype.capitalize = function() {
		    return this.charAt(0).toUpperCase() + this.slice(1);
		}
		var $select_tool = $('#area-select-tool');
		var $remote_country = $('#remote-country');
		var $group_header = $('#group-header');
		var $group_body = $('#group-body');
		// var $btn_close = $('#btn-close');
		
		$remote_country.on('click', function(event) {
			event.preventDefault();
			event.stopPropagation();
			var url = $(this).attr('action');
			var offset = $(this).offset();
			$select_tool.css({
				'top' : offset.top + $(this).outerHeight() +  'px',
				'left': offset.left + 'px'
			}).slideDown();
			
		});
		// $remote_country.keydown(false);

		$group_body.on('click','span',function(event) {
			event.preventDefault();
			var state = $(this).attr('data-state');
			var state_en = $(this).attr('data-en');
			$remote_country.attr('data-state',state);
			$remote_country.attr('data-en',state_en);
			$remote_country.val(state_en);
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
})