<a href="<?php echo site_url( 'price/create'); ?>" class="btn btn-primary">新增报价</a>
<?php 
if(isset($prices)){ ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>报价名称</th>
                <th>渠道类型</th>
                <th>公司名称</th>
                <th>最后更新日期</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prices as $row) { 
                ?>
            <tr>
                <td>
                    <?php echo $row->cname; ?>
                </td>
                <td>
                    <?php echo $row->channel; ?>
                </td>
                <td>
                    <?php echo $row->update_date; ?>
                </td>
                <td>
                <a class="btn btn-warning btn-xs" href="<?php echo site_url('price/detail/'.$row->id); ?>">查看</a>
                <a class="btn btn-danger btn-delete btn-xs" href="<?php echo site_url('admin/delete/'. $row->id); ?>">删除</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php }
 ?>




