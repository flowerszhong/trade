    
<div class="panel panel-success">

    <div class="panel-heading">添加渠道
    </div>
    <div class="panel-body">


<?php echo validation_errors(); ?>
<?php 
$attributes = array('class'=>'','id'=>'create-manager');
?>
<?php echo form_open_multipart('price/create',$attributes); ?>
    <div class="form-group">
        <label for="">渠道名称</label>
        <input type="text" name="cname" class="form-control">
    </div>
    <div class="form-group">
        <label for="">渠道类型</label>
        <select name="ctype">
            <option value="DHL">DHL</option>
            <option value="Fedex">Fedex</option>
            <option value="UPS">UPS</option>
        </select>
    </div>    

    <div class="form-group">
        <label for="">关联公司</label><br>
        <select name="company_id[]" multiple style="width:120px;">
            <?php foreach ($agents as $row) { ?>
                <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="">上传报价单</label>
        <input type="file" name="pricetable">
    </div>

    <div class="form-group">
        <input type="submit" value="提交" class="btn btn-submit">
    </div>
<?php form_close(); ?>

    </div>
    </div>

