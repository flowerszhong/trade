$(function () {
    var default_enddate = new Date(),
    default_startdate = new Date();
    default_startdate = new Date(default_startdate.setDate(default_startdate.getDate() - 7));

    function yyyymmdd(d) {
        var y = d.getFullYear(),
            m = d.getMonth(),
            _d = d.getDate();
        if (m < 10) { m = '0' + m; }

        if(_d<10){
            _d = '0' + _d;
        }

        return y + "-" + m + "-" + _d;
    }

    $('#startdate').val(yyyymmdd(default_startdate));
    $('#enddate').val(yyyymmdd(default_enddate));


    
    
});