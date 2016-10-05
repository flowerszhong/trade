$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }


    $('.btn-delete').on('click', function(event) {
        event.preventDefault();
        if(window.confirm('确定删除该记录?')){
            window.location.href = this.href;
        }
        /* Act on the event */
    });

    $('.check-duplicate').on('focus', function(event) {
        $(this).next('.dup-error').hide();
        /* Act on the event */
    });

    $('.check-duplicate').on('blur', function(event) {
        var $this = $(this);
        var url = $this.attr('data-url');
        var type = $this.attr('data-type');
        var field = $(this).attr('name');
        var value = $.trim($(this).val());
        var original = $(this).attr('data-original');
        if(value == original){
            return true;
        }
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                type: type,
                field : field,
                value : value,
            },
        })
        .done(function(data) {
            if(data && data.length){
                var d = data[0];
                var count = d['count'];
                var count = parseInt(count);
                if(count>0){
                    // alert('该字段值与系统某条记录有重复');
                    $this.next('.dup-error').show();
                }
            }
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
    });


    $('.company-select').on('change', function(event) {
        var url = $(this).val();
        window.location.href = url;
    });


});
