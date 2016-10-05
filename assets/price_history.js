$(function () {
    var default_enddate = new Date(),
    default_startdate = new Date();
    default_startdate = new Date(default_startdate.setDate(default_startdate.getDate() - 7));

    function yyyymmdd(d) {
        var y = d.getFullYear(),
            m = d.getMonth()+1,
            _d = d.getDate();
        if (m < 10) { m = '0' + m; }

        if(_d<10){
            _d = '0' + _d;
        }

        return y + "-" + m + "-" + _d;
    }

    function date_his(d) {
        var hours = prefix_zero(d.getHours());
        var minutes = prefix_zero(d.getMinutes());
        var seconds = prefix_zero(d.getSeconds());
        return hours + ":" + minutes + ":" + seconds;
    }

    function prefix_zero(a) {
        if(a<10){
            return '0'+ a;
        }
        return a;
    }

    $('#startdate').val(yyyymmdd(default_startdate));
    $('#enddate').val(yyyymmdd(default_enddate));

    $("#pagination-wrap").on('click', 'li', function(event) {
        event.preventDefault();
        $this = $(this);
        if($this.hasClass('active')){
            return true;
        }

        var url = $this.find('a').attr('href');
        var page = $this.find('a').attr('data-ci-pagination-page');
        var startdate = $('#startdate').val();
        var enddate = $('#enddate').val();
        var company_id = $('#choose-company').val();

        history_ajaxaction(url,startdate,enddate,company_id,page);

        return false;

        /* Act on the event */
    });

    $('#btn-history').on('click', function() {
        var url = $("#history-form").attr('action');
        var startdate = $('#startdate').val();
        var enddate = $('#enddate').val();
        var company_id = $('#choose-company').val();
        var page = 0;
        history_ajaxaction(url,startdate,enddate,company_id,page);
    });

    function history_ajaxaction(url,startdate,enddate,company_id,page) {
        $('#history-tbody').empty();
        $('#pagination-wrap').empty();
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                'startdate': startdate,
                'enddate': enddate,
                'company_id': company_id,
                'page':page
            }
        })
        .done(function(response) {
            if(response && response.ok){
                var data = response.pricedata;
                var pagination = response.pagination;
                var trs = "";
                for (var i = 0; i < data.length; i++) {
                    var row = data[i];
                    var d = row['querytime'];
                    var dd = d.split(' ');
                    // d_ymd = yyyymmdd(d);
                    // d_his = date_his(d);
                    d_ymd = dd[0];
                    d_his = dd[1];


                    var tr = '<tr><td>' + row['shortname'] + '</td><td>' + d_ymd + '</td><td>' + d_his + '</td><td>' + row['state'] + '</td><td>' + row['weight'] + '</td><td>' + row['ip'] + '</td></tr>';
                    trs += tr;
                }

                $('#history-tbody').append(trs);
                $('#pagination-wrap').append(pagination);
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }
    
    
});