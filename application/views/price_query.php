<form action="<?php echo site_url('price/ajax'); ?>" id="query-form">
    <table>
        <tr>
            <td>

            <?php if($this->manager_power > 10){ ?>
            <select name="company" id="choose-company" class="form-control">
                <option value="<?php echo $this->company_id; ?>">请选择公司</option>
            <?php 
            foreach ($companies as $company) { ?>
                <option value="<?php echo $company['id'] ?>"><?php echo $company['shortname'] ?></option>
            <?php }

             ?>
            </select>

            <?php }else{ ?>

            <label for=""> <?php echo $this->company_name; ?> </label>

            <?php } ?>
                


            </td>
            <td>深圳市[SHENZHEN]</td>
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
                <th>区域</th>
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

<link rel="stylesheet" type="text/css" href="<?php echo asset_url() . 'css/price_query.css' ?>" >

<div id="area-select-tool">
    <div id="group-header">
        <b>常用国家</b>
        <b>A</b>
        <b>B</b>
        <b>C</b>
        <b>D</b>
        <b>E</b>
        <b>F</b>
        <b>G</b>
        <b>H</b>
        <b>I</b>
        <b>J</b>
        <b>K</b>
        <b>L</b>
        <b>M</b>
        <b>N</b>
        <b>O</b>
        <b>P</b>
        <b>Q</b>
        <b>R</b>
        <b>S</b>
        <b>T</b>
        <b>U</b>
        <b>V</b>
        <b>W</b>
        <b>X</b>
        <b>Y</b>
        <b>Z</b>
        <div class="clearfix"></div>
    </div>
    <div id="group-body">
        
    </div>
    <div class="clearfix"></div>
</div>

<!-- jQuery -->
<!-- Custom Theme JavaScript -->
<script src="<?php echo asset_url() . 'area.js'; ?>"></script>
<script src="<?php echo asset_url() . 'price_query.js'; ?>"></script>
