<style>
    .date{

    }

    .date label{
        display: inline-block;
    }

    .date .form-control{
        display: inline-block;
    }
    .history-query{
        min-width: 500px;
        max-width: 700px;
    }

    .history-query td{
        padding: 5px;
    }

    #choose-company{
        min-width: 120px;
    }


    #history-records{
        max-width: 800px;
    }


</style>

<form class="form-horizontal" id="history-form" action="<?php echo site_url('price/historyquery'); ?>">
<table class="history-query">
    <tr>
        <td>
        <label for="">公司名称</label>
            <select name="company" id="choose-company" class="form-control">
            <option value="all">全选</option>
            <?php 
            foreach ($companies as $company) { ?>
                <option value="<?php echo $company['id'] ?>"><?php echo $company['shortname'] ?></option>
            <?php }
             ?>
            </select>
        </td>
            
        <td>
            <div class="date">
                <label for="startdate">开始时间</label>
                <input type="date" name="startdate" id="startdate" placeholder="开始时间" class="form-control">
            </div>
        </td>
        <td>
            <div class="date">
                <label for="enddate">结束时间</label>
                <input type="date" name="enddate" id="enddate" placeholder="结束时间" class="form-control">
            </div>
        </td>
        <td>
            <br>
            <input type="button" class="btn btn-primary" value="查询" id="btn-history">
        </td>
    </tr>
</table>
</form>

<table class="table table-hover" id="history-records">
    <thead>
        <th>
            公司简称
        </th>
        <th>
            日期
        </th>
        <th>
            时间
        </th>
        <th>
            国家
        </th>
        <th>
            重量
        </th>
        <th>
            查询IP地址
        </th>
    </thead>
    <tbody id="history-tbody">
    
    </tbody>

</table>


<script src="<?php echo asset_url() . 'price_history.js'; ?>"></script>
