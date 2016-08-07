<style>
    .c-span{
        margin-right: 10px;
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

<div class="panel panel-success">

    <div class="panel-heading"><?php echo $page_title; ?>
    </div>
    <div class="panel-body">
<?php 
$attributes = array('class'=>'','id'=>'create-manager');
?>
<?php echo form_open_multipart('price/create',$attributes); ?>
    <div class="form-group">
        <label for="">报价名称</label>
        <input type="text" name="cname" class="form-control">
    </div>
    <div class="form-group">
        <label for="">渠道类型</label>
        <select name="ctype">
            <option value="0">DHL</option>
            <option value="1">Fedex</option>
            <option value="2">UPS</option>
        </select>
    </div>    

    <div class="form-group">
        <label for="">关联公司</label><br>
        <?php 
        foreach ($agents as $key => $row) { ?>
            <span class="c-span">
                <input type="checkbox" name="company_id[]" id="<?php echo 'company_' . $row->id; ?>" value="<?php echo $row->id; ?>"> <label for="<?php echo 'company_' . $row->id; ?>"><?php echo $row->name; ?></label>
            </span>
            
        <?php }

         ?>

    </div>

    <div class="form-group">
        <label for="">上传报价单</label> <a href="<?php echo asset_url() .'files/price_template.xlsx'; ?>" title="">点击下载报价单</a>
        <input type="file" name="pricetable">
    </div>

    <div class="form-group">
        <input type="submit" value="提交" class="btn btn-submit">
    </div>
<?php form_close(); ?>
    </div>
    </div>