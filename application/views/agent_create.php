<style>
    .hint {
        color: #999;
        font-size: 11px;
    }
    .hint b{
        color: red;
    }
</style>
<div class="panel panel-success">

    <div class="panel-heading">录入新公司信息
    </div>
    <div class="panel-body">


<?php if(validation_errors()){ ?>
<div class="alert alert-danger" role="alert">
    <?php echo validation_errors(); ?>
</div>
<?php } ?>
<?php 
$attributes = array('class'=>'','id'=>'create-agent');
?>
<?php echo form_open('agent/create',$attributes); ?>
    <div class="form-group">
        <label for="">公司名称</label><span class="hint">(<b>*</b>必填)</span>
        <input type="text" name="name" class="form-control check-duplicate" data-type="agent" data-url="<?php echo site_url('common/check_duplicate'); ?>">
        <label for="" class="dup-error info-danger">提示：公司名称有重复</label>
    </div>
    <div class="form-group">
        <label for="">简称</label><span class="hint">(<b>*</b>必填)</span>
        <input type="text" name="shortname" class="form-control check-duplicate" data-type="agent" data-url="<?php echo site_url('common/check_duplicate'); ?>">
        <label for="" class="dup-error info-danger">提示：公司简称有重复</label>
    </div>
    <div class="form-group">
        <label for="">公司代码</label><span class="hint">(<b>*</b>必填，非中文)</span>
        <input type="text" name="code" class="form-control check-duplicate" data-type="agent" data-url="<?php echo site_url('common/check_duplicate'); ?>">
        <label for="" class="dup-error info-danger">提示：公司代码有重复</label>
    </div>
    <div class="form-group">
        <label for="">公司地址</label><span class="hint">(<b>*</b>必填)</span>
        <textarea name="address" class="form-control content-editor"></textarea>
    </div>
    <div class="form-group">
        <label for="">联系电话</label><span class="hint">(<b>*</b>必填)</span>
        <input type="text" name="officephone" class="form-control">
    </div>
    <div class="form-group">
        <label for="">公司描述</label>
        <textarea name="description" class="form-control content-editor"></textarea>
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

