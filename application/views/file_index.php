<?php 
if($this->manager_power>10){
 ?>
<a href="<?php echo site_url('file/add'); ?>" class="btn btn-success">上传文档</a> 
<?php 
}
 ?>

<table class="table table-hover">
    <tr>
		<th>文档</th>
		<th>大小</th>
		<th>备注</th>
		<th>操作</th>
    </tr>
	<?php foreach($admin_file as $a){ ?>
    <tr>
		<td><?php echo $a['name']; ?></td>
		<td><?php echo $a['size']; ?></td>
		<td><?php echo $a['comments']; ?></td>
		<td>
            <a href="<?php echo site_url('file/edit/'.$a['id']); ?>" class="btn btn-info">Edit</a> 
            <a href="<?php echo site_url('file/remove/'.$a['id']); ?>" class="btn btn-danger">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>