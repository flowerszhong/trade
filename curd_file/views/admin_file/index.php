<div class="pull-right">
	<a href="<?php echo site_url('admin_file/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Name</th>
		<th>Size</th>
		<th>Comments</th>
		<th>Actions</th>
    </tr>
	<?php foreach($admin_file as $a){ ?>
    <tr>
		<td><?php echo $a['id']; ?></td>
		<td><?php echo $a['name']; ?></td>
		<td><?php echo $a['size']; ?></td>
		<td><?php echo $a['comments']; ?></td>
		<td>
            <a href="<?php echo site_url('admin_file/edit/'.$a['id']); ?>" class="btn btn-info">Edit</a> 
            <a href="<?php echo site_url('admin_file/remove/'.$a['id']); ?>" class="btn btn-danger">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>