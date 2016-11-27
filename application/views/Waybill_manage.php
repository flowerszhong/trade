

<?php if(isset($upload_error)){ ?>
<div class="alert alert-danger" role="alert">
    <?php echo $upload_error; ?>
</div>
<?php } ?>

<?php echo form_open_multipart('waybill/manage',array('class="waybill-upload-form')); ?>

<div class="form-group">
    <label for="">上传运单</label>
    <input type="file" name="waybillupload">
</div>
<div class="form-group">
	<input type="submit" name="uploaded" class="btn btn-primary" value="上传">
</div>

<?php echo form_close(); ?>

<hr>

<form class="form-horizontal" id="history-form" action="<?php echo site_url('price/historyquery'); ?>">
<table class="history-query">
    <tr>
        <td>
        <label for="">公司名称</label>
            <select name="company" id="choose-company" class="form-control">
            <option value="all">全选</option>
            <?php 
            foreach ($companies as $company) { ?>
                <option value="<?php echo $company['id'] ?>"><?php echo $company['shortname'] ?></option>
            <?php }
             ?>
            </select>
        </td>
            
        <td>
            <div class="date">
                <label for="startdate">开始时间</label>
                <input type="date" name="startdate" id="startdate" placeholder="开始时间" class="form-control">
            </div>
        </td>
        <td>
            <div class="date">
                <label for="enddate">结束时间</label>
                <input type="date" name="enddate" id="enddate" placeholder="结束时间" class="form-control">
            </div>
        </td>
        <td>
            <br>
            <input type="button" class="btn btn-primary" value="查询" id="btn-history">
        </td>
    </tr>
</table>
</form>

<?php if(isset($xls)){ ?>

<table class="table table-hover">
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
</tr>
	<?php foreach ($xls as $key => $row) { 
	?>
	<tr>
		<?php foreach ($row as $td) { ?>
			<td><?php echo $td; ?></td>
		<?php } ?>
	</tr>
		
	<?php } ?>

</table>

<?php } ?>

