<?php if(isset($query_data)){ ?>

<table class="table table-hover editable-table" id="editable-table">
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
	<tr class="datarow" data-id="<?php echo $row['id']; ?>">
		<td class="starttime" data-orig="<?php echo date('Y-m-d',strtotime($row['starttime'])); ?>"><?php echo date('Y-m-d',strtotime($row['starttime'])); ?> </td>
		<td class="customer_com disable_dblclick" data-id="<?php echo $row['customer_com_id']; ?>"><?php echo $row['customer_com']; ?></td>
		<td class="manager" data-orig="<?php echo $row['manager']; ?>"><?php echo $row['manager']; ?></td>
		<td class="num" data-orig="<?php echo $row['num']; ?>"> <?php echo $row['num']; ?> </td>
		<td class="transport_num" data-orig="<?php echo $row['transport_num']; ?>"> <?php echo $row['transport_num']; ?> </td>
		<td class="destination" data-orig="<?php echo $row['destination']; ?>"> <?php echo $row['destination']; ?> </td>
		<td class="com" data-orig="<?php echo $row['com']; ?>"> <?php echo $row['com']; ?> </td>
		<td class="amount" data-orig="<?php echo $row['amount']; ?>"> <?php echo $row['amount']; ?> </td>
		<td class="weight" data-orig="<?php echo $row['weight']; ?>"> <?php echo $row['weight']; ?> </td>
		<td class="price" data-orig="<?php echo $row['price']; ?>"> <?php echo $row['price']; ?> </td>
		<td class="fee" data-orig="<?php echo $row['fee']; ?>"> <?php echo $row['fee']; ?> </td>
		<td class="agent_com" data-orig="<?php echo $row['agent_com']; ?>"> <?php echo $row['agent_com']; ?> </td>
		<td class="cost" data-orig="<?php echo $row['cost']; ?>"> <?php echo $row['cost']; ?> </td>
		<td class="profit" data-orig="<?php echo $row['profit']; ?>"> <?php echo $row['profit']; ?> </td>
		<td class="remarks" data-orig="<?php echo $row['remarks']; ?>"> <?php echo $row['remarks']; ?> </td>
		<td class="state" data-orig="<?php echo $row['state']; ?>"> <?php echo $row['state']; ?> </td>
		<td> 
		<input type="button" class="btn btn-danger btn-delete-wb" data-url="<?php echo site_url('waybill/delete/'. $row['id'] ); ?>" value="删除" /> 

		<input type="button" class="btn btn-info btn-update-num" data-num="<?php echo $row['transport_num']; ?>" value="查看运单实时状态" data-toggle="modal" data-target="#num-modal" /> 
		</td>
	</tr>
		
	<?php } ?>

</table>

<input type="button" name="" id="btn-update" class="btn btn-danger btn-toback" data-url="<?php echo site_url('waybill/queryupdate'); ?>" value="提交到服务器" />

<?php 
	if($this->pagination){
		echo $this->pagination->create_links();
	}
} ?>


<?php $this->load->view('waybill_num_modal'); ?>

