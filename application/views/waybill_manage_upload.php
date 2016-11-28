<?php if(isset($xls)){ ?>

<table class="table table-hover" id="upload-edit-table">
<tr>
	<td>日期</td>	
	<td>客户</td>	
	<td>业务员</td>	
	<td>原单号</td>	
	<td>转单号</td>	
	<td>目的地</td>	
	<td>渠道</td>	
	<td>件数</td>	
	<td>重量</td>	
	<td>单价</td>	
	<td>运费</td>	
	<td>代理</td>	
	<td>运费成本</td>	
	<td>利润</td>	
	<td>备注</td>	
	<td>当前状态</td>
	<td>操作</td>	
</tr>
	<?php foreach ($xls as $key => $row) { 
	?>
	<tr class="datarow">
		<?php 
		$keys = array(
			'A' =>'starttime',
			'B' =>'customer_com',
			'C' => 'manager',
			'D' => 'num',
			'E' => 'transport_num',
			'F' => 'destination',
			'G' => 'com',
			'H' => 'amount',
			'I' => 'weight',
			'J' => 'price',
			'K' => 'fee',
			'L' => 'agent_com',
			'M' => 'cost',
			'N' => 'profit',
			'O' => 'remarks',
			'P' => 'state',
		);
		foreach ($row as $key => $td) { ?>
			<td class="<?php echo $keys[$key];  ?>"><?php echo $td; ?></td>
		<?php } ?>
		<td> 
		<input type="button" class="btn btn-danger btn-remove" value="删除" /> 
		</td>
	</tr>
		
	<?php } ?>

</table>

<input type="button" name="" id="btn-push2back" class="btn btn-danger" value="提交到服务器" />

<script type="text/javascript">
	window.upload_ajax_handle_url = '<?php echo site_url('waybill/upload_ajax_handle'); ?>';
</script>


<?php } ?>