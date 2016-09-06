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

                        <li class="active">
                            <a href="<?php echo site_url( 'agent/index'); ?>"><i class="fa fa-dashboard fa-fw"></i> 人员管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('agent/index'); ?>">公司列表</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('manager/index'); ?>">人员管理</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li class="active">
                            <a href="<?php echo site_url('price/index'); ?>"><i class="fa fa-table fa-fw"></i> 报价查询<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('price/index'); ?>">报价列表</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('price/query'); ?>">报价查询</a>
                                </li>
                                <?php 
                                if($this->manager_power > 10 ){
                                 ?>
                                <li>
                                    <a href="<?php echo site_url('price/history'); ?>">报价查询记录</a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> 资料查询<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" aria-expanded="true">
                                <li>
                                    <a href="#">偏远查询</a>
                                </li>
                                <li>
                                    <a href="#">商品编码</a>
                                </li>
                                <li>
                                    <a href="#">文档模板</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li class="">
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> 系统配置<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse" aria-expanded="true">
                                <li>
                                    <a href="<?php echo site_url('configure/changepwd'); ?>">修改密码</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('configure/profile') ?>">个人资料</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->

