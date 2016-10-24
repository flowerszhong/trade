<style>
    #batch-query-text {
        width: 700px;
        height: 120px;
        display: block;
        margin-bottom: 10px;
        padding: 10px;
        font-size: 16px;
        color: #366da2;
    }

    #batch-wrap{
        padding-top: 10px;
    }

    #result-msg{
        padding-top: 10px;
    }

    .result-info2 { width: 100%;  }
    .result-info2 td { padding: 10px; color: #878787; border-bottom: 1px solid #d8d8d8 !important; background-color: #fbfbfb !important }
    .result-info2 .status { width: 40px; background: url("http://cdn.kuaidi100.com/images/ico_status.gif") -50px center no-repeat #fbfbfb }
    .result-info2 .status { width: 40px; background: url("http://cdn.kuaidi100.com/images/ico_status.gif") -50px center no-repeat #fbfbfb }
    .result-info2 .status-first { background: url("http://cdn.kuaidi100.com/images/ico_status.gif") 0px center no-repeat #fbfbfb }
    .result-info2 .status-check { background: url("http://cdn.kuaidi100.com/images/ico_status.gif") -150px center no-repeat #fbfbfb }
    .result-info2 .status-wait { background: url("http://cdn.kuaidi100.com/images/ico_status.gif") -100px center no-repeat #fbfbfb }
    .result-info2 .last td { color: #FF8c00; border-bottom: none; background-color: #ffffff !important }
    .result-info2 .row1 { width: 140px; text-align: right; }

    .case{
    }
    .case-summary{
        padding: 10px;
        border:1px solid #eee;
        background: #FFFAF0;
        cursor: pointer;
    }
    .case-summary dl{
        overflow: auto;
        margin-bottom: 0;
    }
    .case-summary dt,
    .case-summary dd{
        float: left;
        margin-right: 10px;
    }

    .case-summary dt{
        font-weight: bold;
    }
    
    .case-summary dt.d{
        clear: both;
    }

    .case-summary .show-detail{
        font-weight: bold;
        color:red;
    }

    .case-detail{
        display: none;
    }

</style>

<div class="batch-query-box">
    <form id="batch-query-form" action="http://www.szxtorun.com/query/waybill/" method="post">
        <textarea name="batches" id="batch-query-text">请输入要查询的运单号，每次最多同时查询10个，各运单号之间用换行隔开; </textarea>
        <a href="#" class="btn btn-danger" id="btn-batch">查询</a>
        <a href="#" class="btn btn-warning" id="clear-btn">清除</a>
    </form>
</div>        
<div class="result-msg" id="result-msg">

</div>
<div class="batch-wrap" id="batch-wrap">
    
</div>
    </div>
</div>

<script type="text/javascript">
    jQuery(function ($) {

        $("#btn-batch").on('click',function () {
            do_batches();
        });

        function isNotBatches (querystr) {
            if(querystr == ""){
                return true;
            }
            return /[^(0-9)(a-zA-Z)\n\s]+/.test(querystr);
        }

        function batches_filter(batches){
            var arr = [];

            for (var i = 0; i < batches.length; i++) {
                var b = batches[i];
                if(/[0-9A-Za-z]{4,}/.test(b)){
                   arr.push(b);
                }
            }
            return arr;
        }



        function do_batches () {
            var batches = "";
            var batches_array;
            batches = $.trim($("#batch-query-text").val());
            if(isNotBatches(batches)){
                return;
            }else{
                batches = batches.replace(/\n/g,',');
                batches = batches.replace(/\s/g,'');
            }

            batches_array = batches.split(',');

            if(batches_array.length){
                batches_array = batches_filter(batches_array);
                $('#result-msg').empty().html("正在查询....").show();
                $('#batch-wrap').empty();
                do_query(batches_array);
            }else{
                return false;
            }
        }  

        function querying_state(postid) {
            if(postid){
                $('#result-msg').empty().html("正在查询运单号:" + postid +"....").show();
            }else{
                $('#result-msg').empty().html("正在查询....").show();
            }
        }

        function checkType (querystr) {
            var len = querystr.length;
            var ups = "1ZA2X2406743675748",
                fedex = "643440921040",
                dhl = "4071380110";

            if(len == ups.length){
                return "ups";
            }

            if(len == fedex.length){
                return "fedex";
            }

            if(len == dhl.length){
                return "dhl";
            }

            return false;
        }     

        // do_batches();
        
        function do_query (batches,batch_index) {
            if(!batch_index){
                batch_index = 0;
            }

            var query_url = "<?php echo site_url('query/single'); ?>";
            
            if (!batches[batch_index]) {
                $("#result-msg").empty().html('查询已完成').delay(2000).hide();
                return;
            }

            var postid = batches[batch_index];

            var trade_type = checkType(postid);

            if(!trade_type){
                show_error(batches,batch_index);
            }else{
                querying_state(postid);
                $.ajax({
                    url: query_url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'postid': postid,
                        'type': trade_type
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
                })
                .always(function() {
                    do_query(batches,batch_index + 1);
                    window.console && console.log("complete");
                });
            }
           
        }

        function show_error (batches,batch_index) {
            var postid = batches[batch_index];
            showResult_error(postid);
            do_query(batches,batch_index + 1);
        }



        function doBatchQuery (keys) {
            var tmp = keys.split('\n');
            if(tmp.length){

            }else{
                alert("查询单号为空或")
            }
            
        }

        function checkCaseAvailable (key) {
            
        }


        function showResult (queryData) {

            var $case = $("<div class='case'></div>");
            var $summary = $("<div class='case-summary'></div>");
            var $detail = $("<div class='case-detail'></div>");

            makeSummary($summary,queryData);
            makeDetail($detail,queryData);

            $case.append($summary,$detail);

            $("#batch-wrap").append($case);

        }

        function showResult_error(postid) {
            var $case = $("<div class='case'></div>");
            var $summary = $("<div class='case-summary'></div>");

            $summary.append("运单号 <b>" + postid + "</b>：查询失败，请检查您的订单号是否正确！！！");
            $case.append($summary);
            $("#batch-wrap").append($case);
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

        $('#batch-wrap').on('click', '.case-summary', function(event) {
            event.preventDefault();
            $(this).next().toggle();
        });

        $('#clear-btn').on('click',function (e) {
            $('#batch-query-text').val("");
            $('#batch-wrap').empty();
            e.preventDefault();
        });

        $('#batch-query-text').on('focus',function  () {
           var text = $.trim(this.value);
           if(text=='请输入要查询的运单号，每次最多同时查询10个，各运单号之间用换行隔开;'){
                $(this).val('');
           }
        });

        $('#batch-query-text').on('blur',function  () {
            var text = $.trim(this.value);
           if(text==''){
                $(this).val('请输入要查询的运单号，每次最多同时查询10个，各运单号之间用换行隔开;');
           }
        });
    });

</script>
