<?php if(isset($msg)){ ?>
<div class="alert alert-success" role="alert">
    <?php echo $msg; ?>
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
$attributes = array('class'=>'','id'=>'create-manager');
?>
<?php echo form_open("configure/profile",$attributes); ?>
    <div class="form-group">
        <label for="">姓名</label><span class="hint">(<b>*</b>必填)</span>
        <input type="text"  value="<?php echo $name; ?>" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="">账号</label><span class="hint">请输入字母及数字</span><span class="hint">(<b>*</b>必填)</span>
        <input type="text" readonly="readonly" value="<?php echo $username; ?>" class="form-control">
    </div>    

    <div class="form-group">
        <label for="">职务</label>
        <input type="text" value="<?php echo $title; ?>" name="title" id="office-phone" class="form-control" value="" />
    </div>
    <div class="form-group">
        <label for="">办公电话</label>
        <input type="text" value="<?php echo $office; ?>" name="office" id="office-phone" class="form-control" value="" />
    </div>
    <div class="form-group">
        <label for="">手机号码</label><span class="hint">(<b>*</b>必填)</span>
        <input type="text" value="<?php echo $mobile; ?>" name="mobile" id="mobile-phone" class="form-control" value="" />
    </div>
    <div class="form-group">
        <label for="">QQ</label><span class="hint">(<b>*</b>必填)</span>
        <input type="text" value="<?php echo $qq; ?>" name="qq" id="mobile-phone" class="form-control" value="" />
    </div>
    <div class="form-group">
        <label for="">邮箱</label>
        <input type="text" value="<?php echo $email; ?>" placeholder="邮箱" class="form-control" id="email" name='email' />
    </div>

    <div class="form-group">
        <input type="submit" value="修改" class="btn btn-submit btn-primary">
    </div>
<?php form_close(); ?>

    </div>
    </div>

