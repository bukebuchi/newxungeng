<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:62:"C:\www\public/../application/admin\view\disputetest\index.html";i:1596187138;s:49:"C:\www\application\admin\view\layout\default.html";i:1595838839;s:46:"C:\www\application\admin\view\common\meta.html";i:1560769460;s:48:"C:\www\application\admin\view\common\script.html";i:1560769460;}*/ ?>
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
                                <div class="panel panel-default panel-intro">
    <?php echo build_heading(); ?>
    <div class="panel-body">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="one">
                <div class="widget-body no-padding">
                    <div id="toolbar" class="toolbar">
                        <a href="javascript:;" class="btn btn-primary btn-refresh" title="<?php echo __('Refresh'); ?>"><i class="fa fa-refresh"></i> </a>
                        <a href="javascript:;" class="btn btn-success btn-add <?php echo $auth->check('disputetest/add')?'':'hide'; ?>" title="<?php echo __('Add'); ?>"><i class="fa fa-plus"></i> <?php echo __('Add'); ?></a>
                        <a href="javascript:;" class="btn btn-success btn-edit btn-disabled disabled <?php echo $auth->check('disputetest/edit')?'':'hide'; ?>" title="<?php echo __('Edit'); ?>"><i class="fa fa-pencil"></i> <?php echo __('Edit'); ?></a>
                        <a href="javascript:;" class="btn btn-danger btn-del btn-disabled disabled <?php echo $auth->check('disputetest/del')?'':'hide'; ?>" title="<?php echo __('Delete'); ?>"><i class="fa fa-trash"></i> <?php echo __('Delete'); ?></a>
                        <a href="javascript:;" class="btn btn-danger btn-import <?php echo $auth->check('disputetest/import')?'':'hide'; ?>" title="<?php echo __('Import'); ?>" id="btn-import-file" data-url="ajax/upload" data-mimetype="csv,xls,xlsx" data-multiple="false"><i class="fa fa-upload"></i> <?php echo __('Import'); ?></a>
                        <div class="dropdown btn-group <?php echo $auth->check('disputetest/multi')?'':'hide'; ?>">
                            <a class="btn btn-primary btn-more dropdown-toggle btn-disabled disabled" data-toggle="dropdown"><i class="fa fa-cog"></i> <?php echo __('More'); ?></a>
                            <ul class="dropdown-menu text-left" role="menu">
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=normal"><i class="fa fa-eye"></i> <?php echo __('Set to normal'); ?></a></li>
                                <li><a class="btn btn-link btn-multi btn-disabled disabled" href="javascript:;" data-params="status=hidden"><i class="fa fa-eye-slash"></i> <?php echo __('Set to hidden'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <table id="table" class="table table-striped table-bordered table-hover table-nowrap" data-operate-edit="<?php echo $auth->check('disputetest/edit'); ?>" data-operate-del="<?php echo $auth->check('disputetest/del'); ?>" width="100%">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script id="customformtpl" type="text/html">
    <!--form表单必须添加form-commsearch这个类-->
    <form action="" class="form-commonsearch">
        <div class="row">
           <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3"> 
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-6 col-md-4 col-lg-3"><?php echo __('Admin_ids'); ?>:</label>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <input type="hidden" class="operate" data-name="admin_ids" value="like"/>
                    <input id="c-category_ids" data-rule="required" data-source="auth/admin/selectpage"  data-field="nickname"  data-live-search="true" data-multiple="true" class="form-control selectpage" name="admin_ids" type="text" value="">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3"> 
            <div class="form-group">
                <label class="control-label col-xs-4"><?php echo __('Activitytime'); ?>:</label>

                <div class="col-xs-8">

                   <input type="hidden" class="operate" data-name="activitytime" value="RANGE"/>
                   <input type="text" class="form-control datetimerange" data-date-format="YYYY-MM-DD HH:mm:ss" name="activitytime" value="" />

               </div>

            </div>
        </div> 

   

    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3"> 
                <div class="form-group ">
                    <label class="control-label col-xs-4"><?php echo __('Information'); ?>:</label>
 <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <input class="operate" type="hidden" data-name="information" value="like"/>
                    <input id="c-information" data-rule="required" data-live-search="true" class="form-control" name="information" type="text" value=""/>
  </div>
                </div>

            </div>
    
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3"> 
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-6 col-md-4 col-lg-3"><?php echo __('Addressname_ids'); ?>:</label>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <input type="hidden" class="operate" data-name="addressname_ids" value="="/>
                 <input id="c-addressname_ids" data-rule="required" data-source="category/selectpage" data-params='{"custom[type]":"test"}' data-order-by="id desc" data-live-search="true" data-multiple="true" class="form-control selectpage" name="addressname_ids" type="text" value="">
                </div>
            </div>
        </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3"> 
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-6 col-md-4 col-lg-3"><?php echo __('Mesh_ids'); ?>:</label>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <input type="hidden" class="operate" data-name="mesh_ids" value="="/>
                 <input id="c-mesh_ids" data-rule="required" data-source="category/selectpage" data-live-search="true" data-params='{"custom[type]":"mesh"}' data-order-by="id desc" data-multiple="true" class="form-control selectpage" name="mesh_ids" type="text" value="">
                </div>
            </div>
        </div>
     <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">   
                    <div class="form-group">
                        <label class="control-label"></label>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="submit" class="btn btn-success btn-block" value="查询"/>
                            </div>
                            <div class="col-xs-6">
                                <input type="reset" class="btn btn-primary btn-block" value="重置"/>
                            </div>
                        </div>
                    </div>
                </div>
</div> 
</form>
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