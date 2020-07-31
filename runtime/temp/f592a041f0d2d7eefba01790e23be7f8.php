<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:60:"C:\www\public/../application/admin\view\disputetest\add.html";i:1570635012;s:49:"C:\www\application\admin\view\layout\default.html";i:1595838839;s:46:"C:\www\application\admin\view\common\meta.html";i:1560769460;s:48:"C:\www\application\admin\view\common\script.html";i:1560769460;}*/ ?>
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
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Admin_ids'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-admin_ids" data-rule="required" data-source="auth/admin/selectpage" data-multiple="true" data-field="nickname" class="form-control selectpage" name="row[admin_ids]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('City'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class='control-relative'><input id="c-city" data-rule="required" class="form-control" data-toggle="city-picker" name="row[city]" type="text" value=""></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Addressname_ids'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-addressname_ids" data-rule="required" data-source="category/selectpage" data-params='{"custom[type]":"test"}' data-order-by="id desc" data-multiple="true" class="form-control selectpage" name="row[addressname_ids]" type="text" value="">
        </div>
    </div>
     <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Mesh_ids'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-mesh_ids" data-rule="required" data-source="category/selectpage" data-params='{"custom[type]":"mesh"}' data-order-by="id desc" data-multiple="true" class="form-control selectpage" name="row[mesh_ids]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Activitytime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-activitytime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[activitytime]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Images'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-images" data-rule="required" class="form-control" size="50" name="row[images]" type="text" value="">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-images" class="btn btn-danger plupload" data-input-id="c-images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-images" class="btn btn-primary fachoose" data-input-id="c-images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-images"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-images"></ul>
        </div>
    </div>
    
   
    
     <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Information'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <dl class="fieldlist" data-name="row[information]" data-template="customtpl">
                <dd>
                    <ins>纠纷人员姓名</ins>
                    <ins>纠纷人员身份证</ins>
                    <ins>纠纷人员性别</ins>
                    <ins>纠纷人员电话</ins>
                </dd>
                <dd><a href="javascript:;" class="btn btn-sm btn-success btn-append"><i class="fa fa-plus"></i> <?php echo __('Append'); ?></a></dd>
                <textarea id="c-information" data-rule="required" name="row[information]" cols="30" rows="5" class="hide" value="row[information]"></textarea>
            </dl>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Addcontent'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-addcontent" data-rule="required" class="form-control" name="row[addcontent]" type="text">
        </div>
    </div>
    
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>
<script type="text/html" id="customtpl">
    <dd class="form-inline">
    <input type="text" name="<%=name%>[<%=index%>][Name]" class="form-control" value="<%=row.Name%>" size="10"> 
    <input type="text" name="<%=name%>[<%=index%>][Id]" class="form-control" value="<%=row.Id%>" size="10">
    <input type="text" name="<%=name%>[<%=index%>][Sex]" class="form-control" value="<%=row.Sex%>" size="10"> 
    <input type="text" name="<%=name%>[<%=index%>][Telephone]" class="form-control" value="<%=row.Telephone%>" size="10"> 
    <span class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></span> 
    <span class="btn btn-sm btn-primary btn-dragsort"><i class="fa fa-arrows"></i></span>
    </dd>
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