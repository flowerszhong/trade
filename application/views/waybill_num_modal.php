<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#num-modal">
  Launch demo modal
</button> -->

<!-- Modal -->
<style>
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

<div class="modal fade" data-url="<?php echo site_url('query/single'); ?>" id="num-modal" tabindex="-1" role="dialog" aria-labelledby="label2">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="label2">当成运单号状态</h4>
      </div>
      <div class="modal-body" id="statesbox">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <!-- <button type="button" class="btn btn-primary" id="btn-close-modal">确认选择</button> -->
      </div>
    </div>
  </div>
</div>