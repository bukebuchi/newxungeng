<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:43:"C:\www\addons\cms\view\default\channel.html";i:1565495865;s:49:"C:\www\addons\cms\view\default\common\layout.html";i:1565460317;}*/ ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=""> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="renderer" content="webkit">
    <title><?php echo \think\Config::get("cms.title"); ?> - <?php echo \think\Config::get("cms.sitename"); ?></title>
    <meta name="keywords" content="<?php echo \think\Config::get("cms.keywords"); ?>"/>
    <meta name="description" content="<?php echo \think\Config::get("cms.description"); ?>"/>

    <link rel="stylesheet" media="screen" href="/assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" media="screen" href="/assets/libs/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" media="screen" href="/assets/libs/fastadmin-layer/dist/theme/default/layer.css"/>
    <link rel="stylesheet" media="screen" href="/assets/addons/cms/css/swiper.min.css">
    <link rel="stylesheet" media="screen" href="/assets/addons/cms/css/common.css?v=<?php echo \think\Config::get("site.version"); ?>"/>

    <link rel="stylesheet" href="//at.alicdn.com/t/font_1104524_z1zcv22ej09.css">

    {__STYLE__}

    <!--[if lt IE 9]>
    <script src="/libs/html5shiv.js"></script>
    <script src="/libs/respond.min.js"></script>
    <![endif]-->

</head>
<body class="group-page">

<header class="header">
    <!-- S 导航 -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo \think\Config::get("cms.indexurl"); ?>"><img src="/assets/addons/cms/img/logo.png" width="180" alt=""></a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <!--如果你需要自定义NAV,可使用channellist标签来完成,这里只设置了2级,如果显示无限级,请使用cms:nav标签-->
                    <?php $__g5ICXaPjZk__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","condition"=>"1=isnav"]); if(is_array($__g5ICXaPjZk__) || $__g5ICXaPjZk__ instanceof \think\Collection || $__g5ICXaPjZk__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__g5ICXaPjZk__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
                    <!--判断是否有子级或高亮当前栏目-->
                    <li class="<?php if($nav['has_child']): ?>dropdown<?php endif; if($nav->is_active): ?> active<?php endif; ?>">
                        <a href="<?php echo $nav['url']; ?>" <?php if($nav['has_child']): ?> data-toggle="dropdown" <?php endif; ?>><?php echo $nav['name']; if($nav['has_child']): ?> <b class="caret"></b><?php endif; ?></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php $__8dA9YcP5R1__ = \addons\cms\model\Channel::getChannelList(["id"=>"sub","type"=>"son","typeid"=>$nav['id'],"condition"=>"1=isnav"]); if(is_array($__8dA9YcP5R1__) || $__8dA9YcP5R1__ instanceof \think\Collection || $__8dA9YcP5R1__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__8dA9YcP5R1__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub): $mod = ($i % 2 );++$i;?>
                            <li><a href="<?php echo $sub['url']; ?>"><?php echo $sub['name']; ?></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__8dA9YcP5R1__; ?>
                        </ul>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__g5ICXaPjZk__; ?>
                </ul>
                <ul class="nav navbar-right hidden">
                    <ul class="nav navbar-nav">
                        <li><a href="javascript:;" class="addbookbark"><i class="fa fa-star"></i> 加入收藏</a></li>
                        <li><a href="javascript:;" class=""><i class="fa fa-phone"></i> 联系我们</a></li>
                    </ul>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form class="form-inline navbar-form" action="<?php echo addon_url('cms/search/index'); ?>" method="get">
                            <div class="form-search hidden-sm hidden-md">
                                <input class="form-control typeahead" name="search" data-typeahead-url="<?php echo addon_url('cms/search/typeahead'); ?>" type="text" id="searchinput" placeholder="搜索">
                            </div>
                        </form>
                    </li>
                    <li class="dropdown">
                        <?php if($user): ?>
                        <a href="<?php echo url('index/user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 10px;height: 50px;">
                            <span class="avatar-img"><img src="<?php echo cdnurl($user['avatar']); ?>" style="width:30px;height:30px;border-radius:50%;" alt=""></span>
                        </a>
                        <?php else: ?>
                        <a href="<?php echo url('index/user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown">社员<span class="hidden-sm">中心</span> <b class="caret"></b></a>
                        <?php endif; ?>
                        <ul class="dropdown-menu">
                            <?php if($user): ?>
                            <li><a href="<?php echo url('index/user/index'); ?>"><i class="fa fa-user fa-fw"></i>社员中心</a></li>
                            <li><a href="<?php echo url('index/cms.archives/my'); ?>"><i class="fa fa-list fa-fw"></i>我发布的文章</a></li>
                            <li><a href="<?php echo url('index/cms.archives/post'); ?>"><i class="fa fa-pencil fa-fw"></i>发布文章</a></li>
                            <li><a href="<?php echo url('index/user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i>注销</a></li>
                            <?php else: ?>
                            <li><a href="<?php echo url('index/user/login'); ?>"><i class="fa fa-sign-in fa-fw"></i>登录</a></li>
                            <li><a href="<?php echo url('index/user/register'); ?>"><i class="fa fa-user-o fa-fw"></i>注册</a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- E 导航 -->

</header>



<div class="container" id="content-container">
    <h1 class="category-title">
        <?php echo $__CHANNEL__['name']; ?>
        <div class="more pull-right">
            <ol class="breadcrumb">
                <!-- S 面包屑导航 -->
                <?php $__YDC9ouGedg__ = \addons\cms\model\Channel::getBreadcrumb(isset($__CHANNEL__)?$__CHANNEL__:[], isset($__ARCHIVES__)?$__ARCHIVES__:[], isset($__TAGS__)?$__TAGS__:[], isset($__PAGE__)?$__PAGE__:[]); if(is_array($__YDC9ouGedg__) || $__YDC9ouGedg__ instanceof \think\Collection || $__YDC9ouGedg__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__YDC9ouGedg__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__YDC9ouGedg__; ?>
                <!-- E 面包屑导航 -->
            </ol>
        </div>
    </h1>

    <div class="row">
        <div class="col-xs-12 col-md-7">
            <div id="news-focus" class="carousel slide carousel-focus" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php $__z6oOrMbWtB__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"newsfocus","row"=>"2"]); if(is_array($__z6oOrMbWtB__) || $__z6oOrMbWtB__ instanceof \think\Collection || $__z6oOrMbWtB__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__z6oOrMbWtB__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                    <li data-target="#carousel-focus-captions" data-slide-to="<?php echo $i-1; ?>" class="<?php if($i==1): ?>active<?php endif; ?>"></li>
                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__z6oOrMbWtB__; ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php $__twfamYgQj4__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"newsfocus","row"=>"2"]); if(is_array($__twfamYgQj4__) || $__twfamYgQj4__ instanceof \think\Collection || $__twfamYgQj4__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__twfamYgQj4__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                    <div class="item <?php if($i==1): ?>active<?php endif; ?>">
                        <a href="<?php echo $block['url']; ?>">
                            <div class="carousel-img" style="background-image:url('<?php echo $block['image']; ?>');"></div>
                            <div class="carousel-caption">
                                <h3><?php echo $block['title']; ?></h3>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__twfamYgQj4__; ?>
                </div>
                <a class="left carousel-control" href="#news-focus" role="button" data-slide="prev">
                    <span class="icon-prev fa fa-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#news-focus" role="button" data-slide="next">
                    <span class="icon-next fa fa-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-xs-12 col-md-5 focus-img">
            <div class="row">
                <?php $__IbE4m0tYG1__ = \addons\cms\model\Block::getBlockList(["id"=>"item","name"=>"newsfocus","limit"=>"2,4"]); if(is_array($__IbE4m0tYG1__) || $__IbE4m0tYG1__ instanceof \think\Collection || $__IbE4m0tYG1__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__IbE4m0tYG1__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                <div class="col-xs-6">
                    <a href="<?php echo $item['url']; ?>">
                        <span class="embed-responsive embed-responsive-16by9 img-zoom">
                            <img src="<?php echo $item['image']; ?>" class="embed-responsive-item" alt="">
                            <div class="intro"><?php echo $item['title']; ?></div>
                        </span>
                    </a>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__IbE4m0tYG1__; ?>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <main class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="channel-list">
                        <div class="row">
                            <!-- S 栏目列表 -->
                            <?php $__HSIpCMvi0O__ = \addons\cms\model\Channel::getChannelList(["id"=>"channel","type"=>"son","typeid"=>$__CHANNEL__['id']]); if(is_array($__HSIpCMvi0O__) || $__HSIpCMvi0O__ instanceof \think\Collection || $__HSIpCMvi0O__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__HSIpCMvi0O__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;?>
                            <div class="col-xs-12 col-sm-6">
                                <h3><?php echo $channel['textlink']; ?> <em><a href="<?php echo $channel['url']; ?>"><?php echo __('More'); ?></a></em></h3>
                                <?php $__BIpTYsX78D__ = \addons\cms\model\Archives::getArchivesList(["id"=>"row","channel"=>$channel['id'],"limit"=>"0,1"]); if(is_array($__BIpTYsX78D__) || $__BIpTYsX78D__ instanceof \think\Collection || $__BIpTYsX78D__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__BIpTYsX78D__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
                                <div class="media">
                                    <div class="media-left">
                                        <a href="<?php echo $row['url']; ?>">
                                            <div class="embed-responsive embed-responsive-square img-zoom">
                                                <img class="embed-responsive-item media-object" width="64" height="64" src="<?php echo $row['image']; ?>">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="media-heading"><?php echo $row['textlink']; ?></h3>
                                        <p><?php echo mb_substr($row['description'],0,40); ?>
                                      
                                        </p>
                                          <span class="pull-right"><?php echo date('m-d',$row['publishtime']); ?></span>
                                    </div>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__BIpTYsX78D__; ?>

                                <ul class="list-unstyled inner-list">
                                    <?php $__ilteqKQdur__ = \addons\cms\model\Archives::getArchivesList(["id"=>"row","channel"=>$channel['id'],"limit"=>"1,5"]); if(is_array($__ilteqKQdur__) || $__ilteqKQdur__ instanceof \think\Collection || $__ilteqKQdur__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__ilteqKQdur__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
                                    <li>
                                        <?php echo $row['textlink']; ?>
                                        <span class="pull-right"><?php echo date('m-d',$row['publishtime']); ?></span>
                                    </li>
                                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__ilteqKQdur__; ?>
                                </ul>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__HSIpCMvi0O__; ?>
                            <!-- E 栏目列表 -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>


<!-- <footer>
    <div class="container-fluid" id="footer">
        <div class="container">
            <div class="row footer-inner">
                
            </div>
        </div>
    </div>
</footer> -->

<div id="floatbtn">
    <!-- S 浮动按钮 -->

    <?php if(isset($config['wxapp'])&&$config['wxapp']): ?>
    <a href="javascript:;">
        <i class="iconfont icon-wxapp"></i>
        <div class="floatbtn-wrapper">
            <div class="qrcode"><img src="<?php echo cdnurl($config['wxapp']); ?>"></div>
            <p>微信小程序</p>
            <p>微信扫一扫体验</p>
        </div>
    </a>
    <?php endif; ?>

    <a class="hover" href="<?php echo url('index/cms.archives/post'); ?>" target="_blank">
        <i class="iconfont icon-pencil"></i>
        <em>立即<br>投稿</em>
    </a>

    <?php if($config['qrcode']): ?>
    <a href="javascript:;">
        <i class="iconfont icon-qrcode"></i>
        <div class="floatbtn-wrapper">
            <div class="qrcode"><img src="<?php echo cdnurl($config['qrcode']); ?>"></div>
            <p>微信公众账号</p>
            <p>微信扫一扫加关注</p>
        </div>
    </a>
    <?php endif; if(isset($__ARCHIVES__)): ?>
    <a id="feedback" class="hover" href="#comments">
        <i class="iconfont icon-feedback"></i>
        <em>发表<br>评论</em>
    </a>
    <?php endif; ?>

    <a id="back-to-top" class="hover" href="javascript:;">
        <i class="iconfont icon-backtotop"></i>
        <em>返回<br>顶部</em>
    </a>
    <!-- E 浮动按钮 -->
</div>


<script type="text/javascript" src="/assets/libs/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/libs/fastadmin-layer/dist/layer.js"></script>
<script type="text/javascript" src="/assets/libs/art-template/dist/template-native.js"></script>
<script type="text/javascript" src="/assets/addons/cms/js/bootstrap-typeahead.min.js"></script>
<script type="text/javascript" src="/assets/addons/cms/js/swiper.min.js"></script>
<script type="text/javascript" src="/assets/addons/cms/js/cms.js?r=<?php echo $site['version']; ?>"></script>
<script type="text/javascript" src="/assets/addons/cms/js/common.js?r=<?php echo $site['version']; ?>"></script>

{__SCRIPT__}

</body>
</html>