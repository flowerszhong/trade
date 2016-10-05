<style>
    .hint {
        color: #999;
        font-size: 11px;
    }
    .hint b{
        color: red;
    }
</style>

<?php if(isset($edit_result)){ ?>
<div class="alert alert-success" role="alert">
    <?php echo $edit_result; ?>
</div>
<?php } ?>
<div class="panel panel-success">

    <div class="panel-heading"><?php echo $page_title; ?>
    </div>
    <div class="panel-body">

<?php if(validation_errors()){ ?>
<div class="alert alert-danger" role="alert">
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php 
$attributes = array('class'=>'','id'=>'edit-agent');
?>
<?php echo form_open("agent/edit/$id",$attributes); ?>
    <div class="form-group">
        <label for="">公司名称</label><span class="hint">(<b>*</b>必填)</span>
        <input type="text" name="name" value="<?php echo $name; ?>" data-type="agent" data-original="<?php echo $name; ?>" data-url="<?php echo site_url('common/check_duplicate'); ?>" class="form-control check-duplicate">
        <label for="" class="dup-error info-danger">提示：公司名称有重复</label>

    </div>
    <div class="form-group">
        <label for="">简称</label><span class="hint">(<b>*</b>必填)</span>
        <input type="text" name="shortname" class="form-control check-duplicate" data-url="<?php echo site_url('common/check_duplicate'); ?>" data-original="<?php echo $shortname; ?>" data-type="agent" value="<?php echo $shortname; ?>">
        <label for="" class="dup-error info-danger">提示：公司简称有重复</label>

    </div>
    <div class="form-group">
        <label for="">公司代码</label><span class="hint">(<b>*</b>必填，非中文)</span>
        <input type="text" name="code" value="<?php echo $code; ?>" data-type="agent" data-original="<?php echo $code; ?>" data-url="<?php echo site_url('common/check_duplicate'); ?>" class="form-control check-duplicate">
        <label for="" class="dup-error info-danger">提示：公司代码有重复</label>

    </div>
    <div class="form-group">
        <label for="">公司地址</label><span class="hint">(<b>*</b>必填)</span>
        <textarea name="address" class="form-control content-editor"><?php echo $address; ?></textarea>
    </div>
    <div class="form-group">
        <label for="">联系电话</label><span class="hint">(<b>*</b>必填)</span>
        <input type="text" name="officephone" class="form-control" value="<?php echo $officephone; ?>">
    </div>
    <div class="form-group">
        <label for="">公司描述</label>
        <textarea name="description" class="form-control content-editor"><?php echo $description; ?></textarea>
    </div>
    <div class="form-group">
        <label for="sticky">备注说明</label>
        <textarea name="comments" class="form-control content-editor"><?php echo $comments; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="提交" class="btn btn-submit btn-primary">
    </div>
<?php form_close(); ?>

    </div>
    </div>

