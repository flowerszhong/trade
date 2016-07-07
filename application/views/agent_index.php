

<?php 

if(isset($agents)){ ?>

    <a href="<?php echo site_url( 'agent/create'); ?>" class="btn btn-primary">创建新账号</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>序号</th>
                <th>公司名称</th>
                <th>描述</th>
                <th>加入时间</th>
                <th>合作状态</th>
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
                <a class="btn btn-warning btn-xs" href="<?php echo base_url('admin/detail/'.$row->id); ?>">查看</a>
                <a class="btn btn-danger btn-delete btn-xs" href="<?php echo base_url('admin/delete/'. $row->id); ?>">删除</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php }
 ?>
