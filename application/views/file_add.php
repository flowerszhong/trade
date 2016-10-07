<?php if(validation_errors()){ ?>
<div class="alert alert-danger" role="alert">
    <?php echo validation_errors(); ?>
</div>
<?php } ?>


<div class="panel panel-success">

    <div class="panel-heading"><?php echo $page_title; ?>
    </div>
    <div class="panel-body">
<?php echo form_open_multipart('file/add',array("class"=>"")); ?>

	<div class="form-group">
		<label for="name">文档名称</label>
		<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
	</div>

	<div class="form-group">
	    <label for="">上传文档</label>
	    <input type="file" name="uploadfile">
	</div>
	<div class="form-group">
		<label for="comments">备注</label>
		<textarea name="comments" class="form-control" id="comments"><?php echo $this->input->post('comments'); ?></textarea>
	</div>
	
	<div class="form-group">
		<button type="submit" class="btn btn-success">上传</button>
	</div>

<?php echo form_close(); ?>
</div>
</div>