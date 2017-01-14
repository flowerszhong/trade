<?php if(isset($query_data)){ ?>

<style>
	.waybill-tab-header{
		margin:10px 0 20px;
	}
</style>

<ul class="nav nav-tabs waybill-tab-header" role="tablist">
   <li class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">全部</a></li>
   <li><a href="#error" aria-controls="error" role="tab" data-toggle="tab">异常件</a></li>
   <li><a href="#signed" aria-controls="signed" role="tab" data-toggle="tab">已签收</a></li>
   <li><a href="#unsigned" aria-controls="unsigned" role="tab" data-toggle="tab">未签收</a></li>
   <li><a href="#return" aria-controls="return" role="tab" data-toggle="tab">退换货</a></li>
 </ul>


<table class="table table-hover editable-table" id="editable-table">
<tr>
	<td>日期</td>	
	<td>原单号</td>	
	<td>转单号</td>	
	<td>目的地</td>	
	<td>渠道</td>	
	<td>件数</td>	
	<td>重量</td>	
	<td>单价</td>	
	<td>运费</td>	
	<td>当前状态</td>
	<td>备注</td>	
</tr>
	<?php foreach ($query_data as $key => $row) { 
	?>
	<tr class="datarow" data-id="<?php echo $row['id']; ?>">
		<td class="starttime" data-orig="<?php echo date('Y-m-d',strtotime($row['starttime'])); ?>"><?php echo date('Y-m-d',strtotime($row['starttime'])); ?> </td>
		<td class="num" data-orig="<?php echo $row['num']; ?>"> <?php echo $row['num']; ?> </td>
		<td class="transport_num" data-orig="<?php echo $row['transport_num']; ?>"> <?php echo $row['transport_num']; ?> </td>
		<td class="destination" data-orig="<?php echo $row['destination']; ?>"> <?php echo $row['destination']; ?> </td>
		<td class="com" data-orig="<?php echo $row['com']; ?>"> <?php echo $row['com']; ?> </td>
		<td class="amount" data-orig="<?php echo $row['amount']; ?>"> <?php echo $row['amount']; ?> </td>
		<td class="weight" data-orig="<?php echo $row['weight']; ?>"> <?php echo $row['weight']; ?> </td>
		<td class="price" data-orig="<?php echo $row['price']; ?>"> <?php echo $row['price']; ?> </td>
		<td class="fee" data-orig="<?php echo $row['fee']; ?>"> <?php echo $row['fee']; ?> </td>
		<td class="state" data-orig="<?php echo $row['state']; ?>"> <?php echo $row['state']; ?> </td>
		<td class="remarks" data-orig="<?php echo $row['remarks']; ?>"> <?php echo $row['remarks']; ?> </td>
	</tr>
		
	<?php } ?>

</table>



<?php 

	if($this->pagination){
		echo $this->pagination->create_links();
	}



} ?>