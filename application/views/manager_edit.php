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
$attributes = array('class'=>'','id'=>'create-manager');
?>
<?php echo form_open("manager/edit/$id",$attributes); ?>
    <div class="form-group">
        <label for="">姓名</label><span class="hint">(<b>*</b>必填)</span>
        <input type="text"  value="<?php echo $name; ?>" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="">账号</label><span class="hint">请输入字母及数字</span><span class="hint">(<b>*</b>必填)</span>
        <input type="text" value="<?php echo $username; ?>" name="username" class="form-control">
    </div>    
    <div class="form-group">
        <label for="">密码</label>
        <input type="text" name="pwd" placeholder="不填写默认为：123456" class="form-control">
    </div>
    <div class="form-group">
        <label for="">可操作公司</label><span class="hint">(<b>*</b>必填)</span> <br>
        <select name="company_id" class="form-control">
                <option value="">请选择公司</option>
            <?php foreach ($agents as $row) { ?>
                <option value="<?php echo $row['id']; ?>" 
                <?php if($company_id==$row['id']){echo "selected"; } ?>
                ><?php echo $row['shortname']; ?></option>
            <?php } ?>
        </select>
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
        <input type="submit" value="编辑" class="btn btn-submit btn-primary">
    </div>
<?php form_close(); ?>

    </div>
    </div>

