<?php 
if(isset($managers)){ ?>
    <select name="company_id" class="form-control company-select">
            <option value="<?php echo site_url('manager/index'); ?>">请选择公司</option>
        <?php foreach ($agents as $row) { ?>
            <option value="<?php echo site_url('manager/company/'. $row['id']); ?>"
            <?php if($row['id'] == $this->uri->segment(3)){
                echo 'selected';
                } ?>
            ><?php echo $row['shortname']; ?></option>
        <?php } ?>
    </select>
    <a href="<?php echo site_url( 'manager/create'); ?>" class="btn btn-primary">添加客户经理</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>人员代码</th>
                <th>姓名</th>
                <th>职务</th>
                <th>办公电话</th>
                <th>手机</th>
                <th>QQ</th>
                <th>操作公司</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($managers as $row) { 
                ?>
            <tr>
                <td>
                    <?php echo $row->username; ?>
                </td>
                <td>
                    <?php echo $row->name; ?>
                </td>
                <td>
                    <?php echo $row->title; ?>
                </td>
                <td>
                    <?php echo $row->office; ?>
                </td>
                <td>
                    <?php echo $row->mobile; ?>
                </td>

                <td>
                    <?php echo $row->qq; ?>
                </td>
                 <td>
                    <?php echo $row->company_name; ?>
                </td>
                <td>
                <a class="btn btn-warning btn-xs" href="<?php echo site_url('manager/edit/'.$row->id); ?>">编辑</a>
                <a class="btn btn-danger btn-xs btn-delete" href="<?php echo site_url('manager/delete/'.$row->id); ?>">删除</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php }
 ?>

<?php echo $this->pagination->create_links(); ?>

