<form action="<?php echo site_url('price/ajax'); ?>" id="query-form">
    <table>
        <tr>

            <?php if($this->manager_power > 10){ ?>
            <td>
            <select name="company" id="choose-company" class="form-control">
                <option value="">请选择公司</option>
            <?php 
            foreach ($companies as $company) { ?>
                <option value="<?php echo $company['id'] ?>"><?php echo $company['shortname'] ?></option>
            <?php }

             ?>
            </select>
            </td>
            <?php }else{ ?>

            <!-- <label for=""> <?php echo $this->company_name; ?> </label> -->

            <?php } ?>
                


            <td>
            <select name="" class="form-control">
                <option value="深圳市[ShenZhen]" selected>深圳市[ShenZhen]</option>
            </select>
            
            </td>
            <td>
                <input type="text" id="input-area" name="s" class="form-control" placeholder="请输入目标国家" action="<?php echo site_url('price/ajax_area'); ?>">
            </td>
            <td>
                <input type="text" name="weight" class="form-control" id="input-weight" placeholder="请输入包裹重量">
            </td>
            <td>
                <input type="button" name="" value="查询" id="btn-query" class="btn btn-primary">
            </td>
        </tr>
    </table>
</form>

<div id="price-result">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>报价名称</th>
                <th>国家（地区）</th>
                <th>重量</th>
                <th>单价</th>
                <th>运费</th>
            </tr>
        </thead>
        <tbody id="price-tbody">
            
        </tbody>
    </table>
</div>

<link rel="stylesheet" type="text/css" href="<?php  asset_file_url('css/price_query.css');  ?>" >

<?php $this->load->view('country_select'); ?>

<!-- jQuery -->
<!-- Custom Theme JavaScript -->
<script src="<?php asset_file_url('area.js'); ?>"></script>
<script src="<?php asset_file_url('price_query.js'); ?>"></script>
