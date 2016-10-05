<style>
    .c-span{
        margin-right: 10px;
    }

    .hint{
        color: #999;
        font-size: 11px;
    }
    .hint b{
        color: red;
    }
</style>

<?php if(isset($errors)){ ?>
<div class="panel panel-danger">
<h3 class="panel-title panel-heading">上传出错，请重新上传</h3>
    <div class="panel-body">
<?php
   echo $errors;
?>
</div>
</div>
<?php } ?> 

<?php if(validation_errors()){ ?>
<div class="alert alert-danger" role="alert">
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<div class="panel panel-success">

    <div class="panel-heading"><?php echo $page_title; ?>
    </div>
    <div class="panel-body">
<?php 
$attributes = array('class'=>'','id'=>'edit-price');
?>
<?php echo form_open_multipart("price/edit/$id",$attributes); ?>
    <div class="form-group">
        <label for="">报价名称<span class="hint">(<b>*</b>)</span></label>
        <input type="text" name="cname" class="form-control check-duplicate" value="<?php echo $cname; ?>" data-type="price" data-original="<?php echo $cname; ?>" data-url="<?php echo site_url('common/check_duplicate'); ?>">
        <label for="" class="dup-error info-danger">提示：报价名称有重复</label>
    </div>

    <div class="form-group">
        <label for="">关联公司</label>
        <input type="text" disabled name="" class="form-control" value="<?php echo $shortname; ?>">
    </div>

    <div class="form-group">
        <label for="">上传报价单</label> <a href="<?php echo asset_url() .'files/price_template.xlsx'; ?>" title="" class="hint">(点击下载报价单模板)</a>
        <input type="file" name="pricetable">
    </div>

    <div class="form-group">
        <input type="submit" value="提交" class="btn btn-submit btn-primary">
    </div>
<?php form_close(); ?>
    </div>
    </div>