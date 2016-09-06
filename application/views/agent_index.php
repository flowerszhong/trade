<a href="<?php echo site_url( 'agent/create'); ?>" class="btn btn-primary">新增公司</a>
<?php 
if(isset($agents) && is_array($agents)){ ?>
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
                    <?php echo $row->code; ?>
                </td>
                <td>
                    <?php echo $row->shortname; ?>
                </td>

                <td>
                    <?php echo $row->address; ?>
                </td>
                <td>
                    <?php echo $row->officephone; ?>
                </td>
                <td>
                <a class="btn btn-warning btn-xs" href="<?php echo site_url('price/company/'.$row->id); ?>">查看</a>
                <a class="btn btn-danger btn-xs" href="<?php echo site_url('price/create/'. $row->id); ?>">新增</a>
                </td>
                <td>
                <a class="btn btn-warning btn-xs" href="<?php echo site_url('agent/edit/'.$row->id); ?>">编辑</a>
                <a class="btn btn-danger btn-delete btn-xs" href="<?php echo site_url('agent/delete/'.$row->id); ?>">删除</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>





<?php }
 ?>


<?php 
echo $links;
 ?>