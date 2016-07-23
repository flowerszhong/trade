


<?php 

if(isset($agents)){ ?>

    <a href="<?php echo site_url( 'agent/create'); ?>" class="btn btn-primary">新增公司</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>公司代码</th>
                <th>公司简称</th>
                <th>地址</th>
                <th>电话</th>
                <th>价格表</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agents as $row) { 
                ?>
            <tr>

                <td>
                    <?php echo $row->id; ?>
                </td>
                <td>
                    <?php echo $row->name; ?>
                </td>

                <td>
                    <?php echo $row->description; ?>
                </td>
                
                <td>
                    <?php echo $row->regdate; ?>
                </td>
                <td>
                    <?php echo $row->available; ?>
                </td>
                <td>
                <a class="btn btn-warning btn-xs" href="<?php echo base_url('admin/detail/'.$row->id); ?>">更新</a>
                <a class="btn btn-warning btn-xs" href="<?php echo base_url('admin/detail/'.$row->id); ?>">交结</a>
                <a class="btn btn-danger btn-delete btn-xs" href="<?php echo base_url('admin/delete/'. $row->id); ?>">删除</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php }
 ?>
