<?php echo form_open('query/remote', array('class'=>'remote-form','id'=>'remote-form')); ?>
<table>
	<tbody>
		<tr>
		<td width="60" class="th">
			国家：
		</td>
			<td><input type="text" name="country" id="remote-country" class="form-control" value="<?php echo $this->input->post('country') ?>">
			</td>
			<td width="60" class="th">
				邮编：
			</td>
			<td>
				<input type="text" id="remote-code" name="code" class="form-control" value="<?php echo $this->input->post('code'); ?>">
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

<?php if(validation_errors()){ ?>
<div class="alert alert-danger" role="alert">
    <?php echo validation_errors(); ?>
</div>
<?php } ?>

<?php if(isset($remotes) and sizeof($remotes)>0){ ?>
<h3>查询结果</h3>
<table class="table table-hover" id="remote-table">
	<tbody>
		<tr>
			<th>快递类型</th>
			<th>邮编偏远</th>
			<th>城市偏远</th>
			<th>查询结果</th>
		</tr>
	</tbody>
	<?php 
	foreach ($remotes as $remote) { ?>
	<tr>
		<td><?php echo $remote['type']; ?></td>
		<td><?php echo $remote['startcode'] .'~' . $remote['endcode']; ?></td>
		<td><?php echo $remote['city']; ?></td>
		<td><?php echo '是偏远'; ?></td>

	</tr>
	<?php }

	 ?>
</table>



<?php }else{ 

if($this->input->post('country')){
	?>
<h3>
	无查询结果，非偏远地区
</h3>
<?php }} ?>


<div class="pycx-guide">
<hr>
    <p>提示：不同的快递类型,不同的国家检测方式是不一样的.选择国家后,输入邮编,城市,点击偏远查询，如下图所示：</p>
    <p>
        <img src="http://www.szxtorun.com/wp-content/themes/torun/images/pycx.png" alt="">
    </p>
    <p class="tip">
    【本网数据仅供参考，以DHL、UPS、Fedex最终确认是否产生该费用为准，我司三个月内通知有效。
            <a href="http://www.fedex.com/cn/rates/surcharge_otherinfo.html" target="_blank">Fedex查询</a>  |
            <a href="http://raslist.dhl.com/jsp/first.jsp" target="_blank">DHL查询</a>  |
            <a href="http://www.ups.com/content/cn/zh/shipping/cost/zones/area_surcharge.html" target="_blank">UPS查询</a>
            】
    </p>
 </div>


<link rel="stylesheet" type="text/css" href="<?php  asset_file_url('css/price_query.css');  ?>" >

<?php $this->load->view('country_select'); ?>

<script src="<?php asset_file_url('area.js'); ?>"></script>
<script src="<?php asset_file_url('remote_query.js'); ?>"></script>

