<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#company-modal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="company-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">请选择公司</h4>
      </div>
      <div class="modal-body com-items">
      <?php 
      if(!empty($companies)){
        foreach ($companies as $index => $com) { ?>
          <span id="com-item-<?php echo $com['id']; ?>" data-id="<?php echo $com['id']; ?>"><?php echo $com['shortname']; ?></span>
      <?php }
      }
       ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary" id="btn-close-modal">确认选择</button>
      </div>
    </div>
  </div>
</div>