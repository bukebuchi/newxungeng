<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"C:\www\public/../application/admin\view\dashboard\index.html";i:1596014535;s:49:"C:\www\application\admin\view\layout\default.html";i:1595838839;s:46:"C:\www\application\admin\view\common\meta.html";i:1560769460;s:48:"C:\www\application\admin\view\common\script.html";i:1560769460;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <style type="text/css">
    .sm-st {
        background: #fff;
        padding: 20px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        margin-bottom: 20px;
        -webkit-box-shadow: 0 1px 0px rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 0px rgba(0, 0, 0, 0.05);
    }

    .sm-st-icon {
        width: 60px;
        height: 60px;
        display: inline-block;
        line-height: 60px;
        text-align: center;
        font-size: 30px;
        background: #eee;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        float: left;
        margin-right: 10px;
        color: #fff;
    }

    .sm-st-info {
        font-size: 12px;
        padding-top: 2px;
    }

    .sm-st-info span {
        display: block;
        font-size: 24px;
        font-weight: 600;
    }

    .orange {
        background: #fa8564 !important;
    }

    .tar {
        background: #45cf95 !important;
    }

    .sm-st .green {
        background: #86ba41 !important;
    }

    .pink {
        background: #AC75F0 !important;
    }

    .yellow-b {
        background: #fdd752 !important;
    }

    .stat-elem {

        background-color: #fff;
        padding: 18px;
        border-radius: 40px;

    }

    .stat-info {
        text-align: center;
        background-color: #fff;
        border-radius: 5px;
        margin-top: -5px;
        padding: 8px;
        -webkit-box-shadow: 0 1px 0px rgba(0, 0, 0, 0.05);
        box-shadow: 0 1px 0px rgba(0, 0, 0, 0.05);
        font-style: italic;
    }

    .stat-icon {
        text-align: center;
        margin-bottom: 5px;
    }

    .st-red {
        background-color: #F05050;
    }

    .st-green {
        background-color: #27C24C;
    }

    .st-violet {
        background-color: #7266ba;
    }

    .st-blue {
        background-color: #23b7e5;
    }

    .stats .stat-icon {
        color: #28bb9c;
        display: inline-block;
        font-size: 26px;
        text-align: center;
        vertical-align: middle;
        width: 50px;
        float: left;
    }

    .stat {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
        margin-right: 10px;
    }

    .stat .value {
        font-size: 20px;
        line-height: 24px;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 500;
    }

    .stat .name {
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .stat.lg .value {
        font-size: 26px;
        line-height: 28px;
    }

    .stat.lg .name {
        font-size: 16px;
    }

    .stat-col .progress {
        height: 2px;
    }

    .stat-col .progress-bar {
        line-height: 2px;
        height: 2px;
    }

    .item {
        padding: 30px 0;
    }
</style>

<div class="panel panel-default panel-intro">
    
    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">

             

                <div class="row">
                    
                   
                
                   
                    
                    
                   
                                        
                           
                    <div class="col-xs-12 col-md-3" >
                       
                        <div class="panel bg-purple-gradient" >
                           
                            <div class="panel-body" >

                                <div class="ibox-title">
                                    <span class="label label-primary pull-right"><?php echo __('Real time'); ?></span>
                                    
                                    <h1 class="no-margins">
                                    <a href="/admin/disputetest?ref=addtabs" style="color: #ffffff" class="btn-addtabs"><?php echo __('Contradictions disputes'); ?></a> 
                                     </h1>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h1>
                                                <?php echo $dispute_count; ?>
                                            </h1>
                                            <div class="font-bold"><i class="fa fa-commenting"></i>
                                                <small>纠纷次数</small>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                

                    <div class="col-xs-12 col-md-3">
                        <div class="panel bg-olive">
                            <div class="panel-body">
                                <div class="ibox-title">
                                    <span class="label label-primary pull-right"><?php echo __('Real time'); ?></span>
                                   
                                     <h1 class="no-margins">
                                    <a href="/admin/society?ref=addtabs" style="color: #ffffff" class="btn-addtabs"><?php echo __('Social conditions'); ?></a> 
                                     </h1>
                                </div>
                                <div class="ibox-content">

                                    
                                            <h1><?php echo $society_count; ?></h1>
                                            <div class="font-bold"><i class="fa fa-commenting"></i>
                                                <small><?php echo __('Message Review'); ?></small>
                                            </div>
                                     
                                </div>
                            </div>
                        </div>
                    </div>


                    
 					<div class="col-xs-12 col-md-3">
                        <div class="panel bg-yellow">
                            <div class="panel-body">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right"><?php echo __('Real time'); ?></span>
                                   
                                    <h1 class="no-margins">
                                    <a href="/admin/flow/start?ref=addtabs" style="color: #ffffff" class="btn-addtabs">风险防控</a> 
                                     </h1>
                                </div>
                                <div class="ibox-content">
                                    <h1><?php echo $risk_count; ?></h1>
                                    <div class="font-bold"><i class="fa fa-commenting"></i>
                                    <small>风险防控</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="panel bg-aqua-gradient">
                            <div class="panel-body">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right"><?php echo __('Real time'); ?></span>
                                    
                                    <h1 class="no-margins">
                                    <a href="/admin/policy?ref=addtabs" style="color: #ffffff" class="btn-addtabs"><?php echo __('Membership statistics'); ?></a> 
                                     </h1>
                                </div>
                                <div class="panel-content">
                                    
                                            <h1>
                                                <?php echo $policy_count; ?>
                                            </h1>
                                             <div class="font-bold"><i class="fa fa-commenting"></i>
                                            <small>宣传次数</small>
                                            </div>
                                     
                                </div>
                            </div>
                        </div>
                    </div>
 				</div>
 					<!--第三行-->                
                <div class="row">            
                   <div class="col-xs-12 col-md-3">
                        <div class="panel bg-blue">
                            <div class="panel-body">
                                <div class="panel-title">
                                    <span class="label label-success pull-right"><?php echo __('Real time'); ?></span>
                                     <h1 class="no-margins">
                                    <a href="/admin/traffic?ref=addtabs" style="color: #ffffff" class="btn-addtabs"><?php echo __('Traffic safety'); ?></a> 
                                     </h1>
                                </div>
                                <div class="panel-content">
                                   
                                    <h1><?php echo $traffic_count; ?></h1>
                                    <div class="font-bold"><i class="fa fa-commenting"></i>
                                    <small><?php echo __('Traffic state'); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                   		</div>

                    <div class="col-xs-12 col-md-3">
                        <div class="panel bg-red">
                            <div class="panel-body">
                                <div class="panel-title">
                                    <span class="label label-success pull-right"><?php echo __('Real time'); ?></span>                                   
                                    <h1 class="no-margins">
                                    <a href="/admin/relief?ref=addtabs" style="color: #ffffff" class="btn-addtabs"><?php echo __('Capture situation'); ?></a> 
                                     </h1>
                                </div>
                                <div class="panel-content">                                
                                        
                                        
                                            <h1>
                                                <?php echo $relief_people; ?>
                                            </h1>
                                            <div class="font-bold"><i class="fa fa-user"></i>
                                                <small>救灾人数</small>
                                            </div>
                                 
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    
                   
                   
                     <div class="col-xs-12 col-md-3">
                        <div class="panel bg-green-active">
                            <div class="panel-body">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right"><?php echo __('Real time'); ?></span>
                                   
                                    <h1 class="no-margins">
                                    <a href="/admin/service?ref=addtabs" style="color: #ffffff" class="btn-addtabs"><?php echo __('Serving masses'); ?></a> 
                                     </h1>
                                </div>
                                <div class="ibox-content">
                                    <h1><?php echo $service_count; ?></h1>
                                    <div class="font-bold"><i class="fa fa-commenting"></i>
                                    <small><?php echo __('Serving state'); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-xs-12 col-md-3">
                        <div class="panel bg-aqua-gradient">
                            <div class="panel-body">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right"><?php echo __('Real time'); ?></span>
                                   
                                    <h1 class="no-margins">
                                    <a href="http://114.115.146.220:9080/manager.html" style="color: #ffffff" class="btn-addtabs">位置查询</a> 
                                     </h1>
                                </div>
                                <div class="ibox-content">
                                    <h1><?php echo $service_count; ?></h1>
                                    <div class="font-bold"><i class="fa fa-commenting"></i>
                                    <small><?php echo __('Serving state'); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                   
                      
                     
                  
             

            	</div>    
            	<div class="row">
            	 <div class="col-xs-12 col-md-3">
                        <div class="panel bg-blue">
                            <div class="panel-body">
                                <div class="panel-title">
                                    <span class="label label-success pull-right"><?php echo __('Real time'); ?></span>
                                     <h1 class="no-margins">
                                    <a href="/admin/voice?ref=addtabs" style="color: #ffffff" class="btn-addtabs">警情语音</a> 
                                     </h1>
                                </div>
                                <div class="panel-content">
                                   
                                    <h1><?php echo $traffic_count; ?></h1>
                                    <div class="font-bold"><i class="fa fa-commenting"></i>
                                    <small>警情上报下发数量</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                   		</div>	
            	</div>
            </div>
            <div class="tab-pane fade" id="two">
                <div class="row">
                    <div class="col-xs-12">
                        <?php echo __('Custom zone'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var Orderdata = {
        column: <?php echo json_encode(array_keys($paylist)); ?>,
        paydata: <?php echo json_encode(array_values($paylist)); ?>,
        createdata: <?php echo json_encode(array_values($createlist)); ?>,
    };
</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>