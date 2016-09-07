<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        
                        <?php if( $this->manager_power > 10){ ?>
                        <li>
                            <a href="<?php echo site_url('price/history'); ?>"><i class="fa fa-table fa-fw"></i> 报价记录</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo site_url( 'agent/index'); ?>"><i class="fa fa-dashboard fa-fw"></i> 客户管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('agent/index'); ?>">公司列表</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('manager/index'); ?>">人员管理</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('price/index'); ?>">报价列表</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li class="active">
                            <a href="<?php echo site_url('price/index'); ?>"><i class="fa fa-bar-chart-o fa-fw"></i> 财务查询<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="http://www.szxtorun.com/query/waybill" target="_blank">运单查询</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('price/query'); ?>">报价查询</a>
                                </li>
                
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> 资料查询<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" aria-expanded="true">
                                <li>
                                    <a href="http://www.szxtorun.com/query/remoteareas" target="_blank">偏远查询</a>
                                </li>
                                <li>
                                    <a href="http://www.szxtorun.com/query/hscode" target="_blank">商品编码</a>
                                </li>
                                <li>
                                    <a href="http://www.szxtorun.com/services/files" target="_blank">文档模板</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li class="">
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> 系统设置<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" aria-expanded="true">
                                <li>
                                    <a href="<?php echo site_url('configure/changepwd'); ?>">更改密码</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('configure/profile') ?>">资料更新</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->

