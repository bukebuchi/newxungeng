<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:58:"C:\www\public/../application/admin\view\question\edit.html";i:1560769460;s:49:"C:\www\application\admin\view\layout\default.html";i:1560769460;s:46:"C:\www\application\admin\view\common\meta.html";i:1560769460;s:48:"C:\www\application\admin\view\common\script.html";i:1560769460;}*/ ?>
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
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Category_ids'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-category_ids" data-rule="required" data-source="auth/admin/selectpage" data-field="nickname" data-multiple="true" class="form-control selectpage" name="row[category_ids]" type="text" value="<?php echo htmlentities($row['category_ids']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Images'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-images" data-rule="required" class="form-control" size="50" name="row[images]" type="text" value="<?php echo htmlentities($row['images']); ?>">
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Carid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-carid" data-rule="required" class="form-control" name="row[carid]" type="text" value="<?php echo htmlentities($row['carid']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Cartype'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-cartype" data-rule="required" class="form-control" name="row[cartype]" type="text" value="<?php echo htmlentities($row['cartype']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Carcolor'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-carcolor" data-rule="required" class="form-control" name="row[carcolor]" type="text" value="<?php echo htmlentities($row['carcolor']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Carowname'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-carowname" data-rule="required" class="form-control" name="row[carowname]" type="text" value="<?php echo htmlentities($row['carowname']); ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Carownidentity'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-carownidentity" data-rule="required" class="form-control" name="row[carownidentity]" type="text" value="<?php echo htmlentities($row['carownidentity']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Carownertel'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-carownertel" data-rule="required" class="form-control" name="row[carownertel]" type="text" value="<?php echo htmlentities($row['carownertel']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Carownercity'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class='control-relative'><input id="c-carownercity" data-rule="required" class="form-control" data-toggle="city-picker" name="row[carownercity]" type="text" value="<?php echo htmlentities($row['carownercity']); ?>"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Questionname'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-questionname" data-rule="required" class="form-control" name="row[questionname]" type="text" value="<?php echo htmlentities($row['questionname']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Genderdata'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($genderdataList) || $genderdataList instanceof \think\Collection || $genderdataList instanceof \think\Paginator): if( count($genderdataList)==0 ) : echo "" ;else: foreach($genderdataList as $key=>$vo): ?>
            <label for="row[genderdata]-<?php echo $key; ?>"><input id="row[genderdata]-<?php echo $key; ?>" name="row[genderdata]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['genderdata'])?$row['genderdata']:explode(',',$row['genderdata']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Identity'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-identity" data-rule="required" class="form-control" name="row[identity]" type="text" value="<?php echo htmlentities($row['identity']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('City'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class='control-relative'><input id="c-city" data-rule="required" class="form-control" data-toggle="city-picker" name="row[city]" type="text" value="<?php echo htmlentities($row['city']); ?>"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Telphone'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-telphone" data-rule="required" class="form-control" name="row[telphone]" type="text" value="<?php echo htmlentities($row['telphone']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Addressname'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-addressname" data-rule="required" class="form-control" name="row[addressname]" type="text" value="<?php echo htmlentities($row['addressname']); ?>">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Activitytime'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-activitytime" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[activitytime]" type="text" value="<?php echo $row['activitytime']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-content" data-rule="required" class="form-control editor" rows="5" name="row[content]" cols="50"><?php echo htmlentities($row['content']); ?></textarea>
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>