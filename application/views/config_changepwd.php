
<style>
    .config-table th{
        width: 150px;
    }
</style>

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
$attributes = array('class'=>'','id'=>'change-password');
?>
<?php echo form_open('configure/changepwd',$attributes); ?>
    <table class="table table-hover config-table">
            <tr>
                <th>旧密码：</th>
                <td><input type="password" name="oldpwd" class="form-control pwd"></td>
            </tr>
            <tr>
                <th>新密码：</th>
                <td><input type="password" name="pwd" class="form-control pwd"></td>
            </tr>
            <tr>
                <th>再次输入新密码：</th>
                <td><input type="password" name="pwd1" class="form-control pwd"></td>
            </tr>
            <tr>
                <th>
                </th>
                <td>
                    <input type="submit" value="提交" class="btn btn-submit btn-primary">
                </td>
            </tr>
    </table>
<?php form_close(); ?>

    </div>
    </div>

