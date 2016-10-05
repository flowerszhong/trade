<?php if($this->manager_power > 10){ 
$create_url = "price/create/";
if($this->uri->segment(3)){
    $create_url = $create_url . $this->uri->segment(3);
}
    ?>

<a href="<?php echo site_url($create_url); ?>" class="btn btn-primary">新增报价</a>

<?php } ?>


<select name="company_id" class="form-control company-select">
            <option value="<?php echo site_url('price/index'); ?>">请选择公司</option>
        <?php foreach ($agents as $row) { ?>
            <option value="<?php echo site_url('price/company/'. $row['id']); ?>"
            <?php if($row['id'] == $this->uri->segment(3)){
                echo 'selected';
                } ?>
            ><?php echo $row['shortname']; ?></option>
        <?php } ?>
    </select>

<?php 
if(isset($prices)){ ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>报价名称</th>
                <th>公司名称</th>
                <th>更新日期</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $ctype = array('DHL','Fedex','UPS','TNT');
            foreach ($prices as $row) { 
                ?>
            <tr>
                <td>
                    <?php echo $row->cname; ?>
                </td>
                <td>
                    <?php echo $row->shortname; ?>
                </td>
                <td>
                    <?php echo $row->update_date? $row->update_date : $row->create_time; ?>
                </td>
                <td>

                <a class="btn btn-warning btn-xs" href="<?php echo site_url('price/download/'. $row->id);?>">下载</a>
                <a class="btn btn-warning btn-xs" href="<?php echo site_url('price/detail/'.$row->id); ?>">查看</a>

                <?php if($this->manager_power > 10){ ?>
                    <a class="btn btn-danger btn-xs" href="<?php echo site_url('price/edit/'.$row->id); ?>">编辑</a>
                <a class="btn btn-danger btn-delete btn-xs" href="<?php echo site_url('price/delete/'.$row->id); ?>">删除</a>

                <?php } ?>



                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php }
 ?>
<?php echo $this->pagination->create_links(); ?>



