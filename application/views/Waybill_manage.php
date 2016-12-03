

<link rel="stylesheet" type="text/css" href="<?php echo asset_file_url('css/waybill.css'); ?>">

<?php if(isset($upload_error)){ ?>
<div class="alert alert-danger" role="alert">
    <?php echo $upload_error; ?>
</div>
<?php } ?>

<?php echo form_open_multipart('waybill/manage',array('class="waybill-upload-form')); ?>

<div class="form-group">
    <label for="">上传运单</label>
    <input type="file" name="waybillupload">
</div>
<div class="form-group">
	<input type="submit" name="uploaded" class="btn btn-primary" value="上传">
</div>

<?php echo form_close(); ?>

<hr>

<?php echo form_open('waybill/manage',array('class'=>'form-horizontal')); ?>
<table class="waybill-query-form">
    <tr>
        <td>
        <label for="">公司名称</label>
            <select name="company" id="choose-company" class="form-control">
            <option value="all">全选</option>
            <?php 
            foreach ($companies as $company) { ?>
                <option value="<?php echo $company['id'] ?>"><?php echo $company['shortname'] ?></option>
            <?php }
             ?>
            </select>
        </td>
        <td>
            <div class="date">
                <label for="starttime">开始时间</label>
                <input type="date" name="starttime" value="<?php echo $this->input->post('starttime'); ?>" id="starttime" placeholder="开始时间" class="form-control">
            </div>
        </td>
        <td>
            <div class="date">
                <label for="signedtime">结束时间</label>
                <input type="date" name="signedtime" value="<?php echo $this->input->post('signedtime'); ?>" id="signedtime" placeholder="结束时间" class="form-control">
            </div>
        </td>
        <td>
            <br>
            <input type="submit" name="query" class="btn btn-primary" value="查询" id="btn-waybill-query">
            <input type="submit" name="export" class="btn btn-danger" value="导出" id="btn-waybill-export">
        </td>
    </tr>
</table>
<?php echo form_close(); ?>


<?php $this->load->view('waybill_manage_upload'); ?>
<?php $this->load->view('waybill_manage_query'); ?>



<script src="<?php echo asset_file_url('waybill_manage.js'); ?>" type="text/javascript"></script>

