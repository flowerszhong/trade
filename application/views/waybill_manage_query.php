<?php if(isset($query_data)){ ?>

<table class="table table-hover" id="query-edit-table">
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
	<?php foreach ($query_data as $key => $row) { 
	?>
	<tr class="datarow">
		<td class="starttime"> <?php echo $row['starttime']; ?> </td>
		<td class="customer_com"> <?php echo $row['customer_com']; ?> </td>
		<td class="manager"> <?php echo $row['manager']; ?> </td>
		<td class="num"> <?php echo $row['num']; ?> </td>
		<td class="transport_num"> <?php echo $row['transport_num']; ?> </td>
		<td class="destination"> <?php echo $row['destination']; ?> </td>
		<td class="com"> <?php echo $row['com']; ?> </td>
		<td class="amount"> <?php echo $row['amount']; ?> </td>
		<td class="weight"> <?php echo $row['weight']; ?> </td>
		<td class="price"> <?php echo $row['price']; ?> </td>
		<td class="fee"> <?php echo $row['fee']; ?> </td>
		<td class="agent_com"> <?php echo $row['agent_com']; ?> </td>
		<td class="cost"> <?php echo $row['cost']; ?> </td>
		<td class="profit"> <?php echo $row['profit']; ?> </td>
		<td class="remarks"> <?php echo $row['remarks']; ?> </td>
		<td class="state"> <?php echo $row['state']; ?> </td>
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