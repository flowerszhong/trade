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

    $('#btn-history').on('click', function() {
        var url = $("#history-form").attr('action');
        var startdate = $('#startdate').val();
        var enddate = $('#enddate').val();
        var company_id = $('#choose-company').val();

        $('#history-tbody').empty();
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {
                'startdate': startdate,
                'enddate': enddate,
                'company_id': company_id
            }
        })
        .done(function(data) {
            if(data && data.length){
                var trs = "";
                for (var i = 0; i < data.length; i++) {
                    var row = data[i];
                    var d = row['querytime'];
                    d = new Date(d);
                    d_ymd = yyyymmdd(d);
                    d_his = date_his(d);


                    var tr = '<tr><td>' + row['shortname'] + '</td><td>' + d_ymd + '</td><td>' + d_his + '</td><td>' + row['state'] + '</td><td>' + row['weight'] + '</td><td>' + row['ip'] + '</td></tr>';
                    trs += tr;
                }

                $('#history-tbody').append(trs);
            }
            console.log(data);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        


        /* Act on the event */
    });
    
    
});