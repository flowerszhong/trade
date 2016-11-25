

<?php echo form_open('query/remote', array('class'=>'remote-form','id'=>'remote-form')); ?>
<table>
	<tbody>
		<tr>
		<td width="60" class="th">
			国家：
		</td>
			<td><input type="text" name="country" class="form-control" value="<?php echo $this->input->post('country') ?>">
			</td>
			<td width="60" class="th">
				邮编：
			</td>
			<td>
				<input type="text" name="code" class="form-control" value="<?php echo $this->input->post('code'); ?>">
			</td>
			<td width="60" class="th">
				城市：
			</td>
			<td>
				<input type="text" name="city" class="form-control" value="<?php echo $this->input->post('city'); ?>">
			</td>
			<td>
				<input type="submit" class="btn btn-danger" value="查询">
			</td>
		</tr>
	</tbody>
</table>

<?php form_close(); ?>


<link rel="stylesheet" type="text/css" href="<?php  asset_file_url('css/price_query.css');  ?>" >

<?php $this->load->view('country_select'); ?>

