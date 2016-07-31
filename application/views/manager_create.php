    
<div class="panel panel-success">

    <div class="panel-heading">添加客户经理
    </div>
    <div class="panel-body">


<?php echo validation_errors(); ?>
<?php 
$attributes = array('class'=>'','id'=>'create-manager');
?>
<?php echo form_open('manager/create',$attributes); ?>
    <div class="form-group">
        <label for="">姓名</label>
        <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="">操作员登录名</label>
        <input type="text" name="nickname" class="form-control">
    </div>    
    <div class="form-group">
        <label for="">默认密码</label>
        <input type="text" name="defaultpassword" placeholder="默认为：123456" class="form-control">
    </div>
    <div class="form-group">
        <label for="">可操作公司</label>
        <select name="company_id">
            <?php foreach ($agents as $row) { ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="">职务</label>
        <input type="text" name="title" id="office-phone" class="form-control" value="" />
    </div>
    <div class="form-group">
        <label for="">办公电话</label>
        <input type="text" name="office" id="office-phone" class="form-control" value="" />
    </div>
    <div class="form-group">
        <label for="">手机号码</label>
        <input type="text" name="mobile" id="mobile-phone" class="form-control" value="" />
    </div>
    <div class="form-group">
        <label for="">QQ</label>
        <input type="text" name="qq" id="mobile-phone" class="form-control" value="" />
    </div>
    <div class="form-group">
        <label for="">邮箱</label>
        <input type="text" value="" placeholder="邮箱" class="form-control" id="email" name='email' />
    </div>

    <div class="form-group">
        <input type="submit" value="提交" class="btn btn-submit">
    </div>
<?php form_close(); ?>

    </div>
    </div>

