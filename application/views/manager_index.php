<?php 
if(isset($managers)){ ?>
    <a href="<?php echo site_url( 'manager/create'); ?>" class="btn btn-primary">添加客户经理</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>序号</th>
                <th>客户姓名</th>
                <th>公司名称</th>
                <th>办公电话</th>
                <th>移动电话</th>
                <th>邮箱</th>
                <th>注册时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($managers as $row) { 
                ?>
            <tr>
                <td>
                    <?php echo $row->id; ?>
                </td>
                <td>
                    <?php echo $row->name; ?>
                </td>
                <td>
                    <?php echo $row->company_name; ?>
                </td>
                <td>
                    <?php echo $row->office; ?>
                </td>
                <td>
                    <?php echo $row->mobile; ?>
                </td>
                <td>
                    <?php echo $row->email; ?>
                </td>
                <td>
                    <?php echo $row->regdate; ?>
                </td>
                <td>
                <a class="btn btn-warning btn-xs" href="<?php echo base_url('admin/detail/'.$row->id); ?>">查看</a>
                <a class="btn btn-danger btn-delete btn-xs" href="<?php echo base_url('admin/delete/'. $row->id); ?>">删除</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php }
 ?>
