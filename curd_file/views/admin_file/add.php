<?php echo validation_errors(); ?>
<?php echo form_open('admin_file/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="name" class="col-md-4 control-label">Name</label>
		<div class="col-md-8">
			<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
		</div>
	</div>
	<div class="form-group">
		<label for="size" class="col-md-4 control-label">Size</label>
		<div class="col-md-8">
			<input type="text" name="size" value="<?php echo $this->input->post('size'); ?>" class="form-control" id="size" />
		</div>
	</div>
	<div class="form-group">
		<label for="comments" class="col-md-4 control-label">Comments</label>
		<div class="col-md-8">
			<textarea name="comments" class="form-control" id="comments"><?php echo $this->input->post('comments'); ?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); ?>