<?php echo form_open('waybill/index',array('class'=>'form-horizontal')); ?>
<table class="waybill-query-form">
    <tr>
        <td>
        <label for="">公司名称</label>
            <?php if($this->manager_power > 10){?>
                <select name="company" id="choose-company" class="form-control">
                <option value="">全选</option>
                <?php 
                foreach ($companies as $company) { ?>
                    <option value="<?php echo $company['id'] ?>"><?php echo $company['shortname'] ?></option>
                <?php }
                 ?>
                </select>
                <?php }else{
                    echo '<br>';
                    echo $this->company_name;
                } ?>
        </td>
        <td>
            <div class="date">
                <label for="starttime">开始时间</label>
                <input type="date" name="starttime" value="<?php echo $this->input->post('starttime'); ?>" id="starttime" placeholder="开始时间" class="form-control">
            </div>
        </td>
        <td>
            <div class="date">
                <label for="signedtime">结束时间</label>
                <input type="date" name="signedtime" value="<?php echo $this->input->post('signedtime'); ?>" id="signedtime" placeholder="结束时间" class="form-control">
            </div>
        </td>
        <td>
            <br>
            <input type="submit" name="query" class="btn btn-primary" value="查询" id="btn-waybill-query">
        </td>
    </tr>
</table>
<?php echo form_close(); ?>


<?php $this->load->view('waybill_index_list'); ?>
