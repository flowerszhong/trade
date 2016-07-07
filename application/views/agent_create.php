    
<div class="panel panel-success">

    <div class="panel-heading">录入新公司信息
    </div>
    <div class="panel-body">


<?php echo validation_errors(); ?>
<?php 
$attributes = array('class'=>'','id'=>'create-agent');
?>
<?php echo form_open('agent/create',$attributes); ?>
    <div class="form-group">
        <label for="">公司名称</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="">公司描述</label>
        <textarea name="description" id="richeditor" class="form-control content-editor"></textarea>
    </div>
    <div class="form-group">
        <label for="sticky">备注说明</label>
        <textarea name="comments" class="form-control content-editor"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="提交" class="btn btn-submit">
    </div>
<?php form_close(); ?>

    </div>
    </div>

